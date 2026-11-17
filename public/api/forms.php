<?php
declare(strict_types=1);

use AltchaOrg\Altcha\Altcha;
use AltchaOrg\Altcha\Algorithm\Pbkdf2;
use AltchaOrg\Altcha\VerifySolutionOptions;
use PHPMailer\PHPMailer\PHPMailer;

$root = dirname(__DIR__, 2);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function respond(int $status, array $data): never
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

$configFile = $root . '/private/config.php';
$autoloadFile = $root . '/backend/vendor/autoload.php';

if (!is_file($configFile) || !is_file($autoloadFile)) {
    error_log(
        'Form backend misconfigured: private/config.php or ' .
        'backend/vendor/autoload.php is missing.'
    );

    respond(500, [
        'success' => false,
        'message' => 'Der Formularversand ist momentan nicht verfügbar. Bitte versuche es später erneut.',
    ]);
}

$config = require $configFile;
require $autoloadFile;

function cleanField(mixed $value, int $maxLength = 1000): string
{
    if (!is_string($value)) {
        return '';
    }

    return mb_substr(trim($value), 0, $maxLength);
}

function requireFields(array $data, array $fields): void
{
    foreach ($fields as $field) {
        if ($data[$field] === '') {
            respond(422, [
                'success' => false,
                'message' => 'Bitte fülle alle Pflichtfelder aus.',
            ]);
        }
    }
}

function enforceRateLimit(array $config): void
{
    $directory = $config['rate_limit_dir'];

    if (
        !is_dir($directory) &&
        !mkdir($directory, 0700, true) &&
        !is_dir($directory)
    ) {
        throw new RuntimeException('Could not create rate limit directory');
    }

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key = hash_hmac('sha256', $ip, $config['altcha_secret']);
    $file = $directory . '/' . $key . '.json';

    $handle = fopen($file, 'c+');

    if (!$handle) {
        throw new RuntimeException('Could not access rate limit file');
    }

    try {
        flock($handle, LOCK_EX);

        $contents = stream_get_contents($handle);
        $timestamps = json_decode($contents ?: '[]', true);

        if (!is_array($timestamps)) {
            $timestamps = [];
        }

        $now = time();

        $timestamps = array_values(
            array_filter(
                $timestamps,
                fn($time) => is_int($time) && $time > $now - 600
            )
        );

        if (count($timestamps) >= 5) {
            respond(429, [
                'success' => false,
                'message' => 'Zu viele Anfragen. Bitte versuche es später erneut.',
            ]);
        }

        $timestamps[] = $now;

        rewind($handle);
        ftruncate($handle, 0);
        fwrite($handle, json_encode($timestamps));
        fflush($handle);

    } finally {
        flock($handle, LOCK_UN);
        fclose($handle);
    }
}

function verifyAltcha(array $config): void
{
    $payload = $_POST['altcha'] ?? '';

    if (!is_string($payload) || $payload === '') {
        respond(403, [
            'success' => false,
            'message' => 'Bitte schließe die Sicherheitsprüfung ab.',
        ]);
    }

    $altcha = new Altcha(
        hmacSignatureSecret: $config['altcha_secret']
    );

    $verification = $altcha->verifySolution(
        new VerifySolutionOptions(
            algorithm: new Pbkdf2(),
            payload: $payload,
        )
    );

    if (!$verification->verified) {
        respond(403, [
            'success' => false,
            'message' => 'Die Sicherheitsprüfung ist fehlgeschlagen. Bitte versuche es erneut.',
        ]);
    }
}

function sendEmail(
    array $config,
    string $subject,
    string $body,
    string $replyEmail,
    string $replyName
): void {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = $config['smtp_host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['smtp_username'];
    $mail->Password = $config['smtp_password'];
    $mail->SMTPSecure = ($config['smtp_secure'] ?? 'starttls') === 'ssl'
        ? PHPMailer::ENCRYPTION_SMTPS
        : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $config['smtp_port'];
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($config['sender_email'], $config['sender_name']);
    $mail->addAddress($config['recipient_email']);

    $mail->addReplyTo($replyEmail, $replyName);

    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, [
        'success' => false,
        'message' => 'Method not allowed',
    ]);
}

// Honeypot
if (!empty($_POST['website'])) {
    respond(200, [
        'success' => true,
        'message' => 'Vielen Dank für deine Nachricht.',
    ]);
}

// Identify form
$form = cleanField($_POST['_form'] ?? '', 50);

if (!in_array($form, ['eierabo', 'chinderhof'], true)) {
    respond(400, [
        'success' => false,
        'message' => 'Unbekanntes Formular.',
    ]);
}

try {
    enforceRateLimit($config);
    verifyAltcha($config);

    // Shared contact data
    $data = [
        'vorname' => cleanField($_POST['vorname'] ?? '', 100),
        'nachname' => cleanField($_POST['nachname'] ?? '', 100),
        'email' => cleanField($_POST['email'] ?? '', 254),
    ];

    requireFields($data, ['vorname', 'nachname', 'email']);

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        respond(422, [
            'success' => false,
            'message' => 'Bitte gib eine gültige E-Mail-Adresse ein.',
        ]);
    }

    $replyName = trim($data['vorname'] . ' ' . $data['nachname']);

    if ($form === 'eierabo') {
        $data += [
            'telefon' => cleanField($_POST['telefon'] ?? '', 50),
            'strasse' => cleanField($_POST['strasse'] ?? '', 200),
            'plz' => cleanField($_POST['plz'] ?? '', 20),
            'ort' => cleanField($_POST['ort'] ?? '', 100),
            'abo' => cleanField($_POST['abo'] ?? '', 50),
            'nachricht' => cleanField($_POST['nachricht'] ?? '', 5000),
        ];

        requireFields($data, [
            'strasse',
            'plz',
            'ort',
        ]);

        $allowedAbos = ['', '500er', '450er', '300er', '250er', '150er'];

        if (!in_array($data['abo'], $allowedAbos, true)) {
            respond(422, [
                'success' => false,
                'message' => 'Ungültige Abo-Auswahl.',
            ]);
        }

        $labels = [
            'vorname' => 'Vorname',
            'nachname' => 'Nachname',
            'email' => 'E-Mail',
            'telefon' => 'Telefon',
            'strasse' => 'Strasse',
            'plz' => 'PLZ',
            'ort' => 'Ort',
            'abo' => 'Gewähltes Abo',
            'nachricht' => 'Nachricht',
        ];

        $body = "Neue Eierabo-Anfrage\n\n";

        foreach ($labels as $field => $label) {
            $value = $data[$field] !== '' ? $data[$field] : '-';
            $body .= $label . ":\n" . $value . "\n\n";
        }

        sendEmail(
            $config,
            'Neue Eierabo-Anfrage',
            $body,
            $data['email'],
            $replyName
        );

        respond(200, [
            'success' => true,
            'message' => 'Vielen Dank für deine Anfrage. Wir melden uns so bald wie möglich bei dir.',
        ]);
    }

    if ($form === 'chinderhof') {
        $data += [
            'adresse' => cleanField($_POST['adresse'] ?? '', 200),
            'telPrivat' => cleanField($_POST['telPrivat'] ?? '', 50),
            'natel' => cleanField($_POST['natel'] ?? '', 50),
            'geburtsdatum' => cleanField($_POST['geburtsdatum'] ?? '', 10),
            'allergien' => cleanField($_POST['allergien'] ?? '', 3000),
            'bemerkungen' => cleanField($_POST['bemerkungen'] ?? '', 3000),
            'fotoerlaubnis' => isset($_POST['fotoerlaubnis']) ? 'Ja' : 'Nein',
        ];

        requireFields($data, [
            'adresse',
            'telPrivat',
            'natel',
            'geburtsdatum',
        ]);

        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $data['geburtsdatum']);

        if (
            !$date ||
            $date->format('Y-m-d') !== $data['geburtsdatum'] ||
            $date > new DateTimeImmutable('today')
        ) {
            respond(422, [
                'success' => false,
                'message' => 'Bitte gib ein gültiges Geburtsdatum an.',
            ]);
        }

        $labels = [
            'vorname' => 'Vorname',
            'nachname' => 'Nachname',
            'email' => 'E-Mail',
            'adresse' => 'Adresse',
            'telPrivat' => 'Telefon privat',
            'natel' => 'Natel',
            'geburtsdatum' => 'Geburtsdatum',
            'allergien' => 'Allergien',
            'bemerkungen' => 'Bemerkungen',
            'fotoerlaubnis' => 'Fotoerlaubnis',
        ];

        $body = "Neue Chinderhof-Anmeldung\n\n";

        foreach ($labels as $field => $label) {
            $value = $data[$field] !== '' ? $data[$field] : '-';
            $body .= $label . ":\n" . $value . "\n\n";
        }

        sendEmail(
            $config,
            'Neue Chinderhof-Anmeldung',
            $body,
            $data['email'],
            $replyName
        );

        respond(200, [
            'success' => true,
            'message' => 'Vielen Dank für deine Anmeldung. Wir melden uns so bald wie möglich bei dir.',
        ]);
    }

} catch (Throwable $e) {
    error_log('Form submission error: ' . $e->getMessage());

    respond(500, [
        'success' => false,
        'message' => 'Deine Anfrage konnte leider nicht gesendet werden. Bitte versuche es später erneut.',
    ]);
}
