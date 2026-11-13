<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/PHPMailer/Exception.php';
require __DIR__ . '/PHPMailer/PHPMailer.php';
require __DIR__ . '/PHPMailer/SMTP.php';

// Formular-Endpoint für Hostfactory: nimmt beide Website-Formulare entgegen
// und verschickt sie per SMTP über Infomaniak.

// --- Konfiguration --------------------------------------------------------
const ALLOWED_ORIGINS = [
    'https://oberhusers.ch',
    'https://www.oberhusers.ch',
    'http://localhost:4321',
    'http://localhost:4322',
    'http://localhost:8080',
];

const MAX_BODY_BYTES = 32768;
const MAX_FIELD_LEN = 2000;
const RATE_LIMIT_WINDOW = 600;
const RATE_LIMIT_MAX = 5;

$configFile = __DIR__ . '/config.php';
$config = is_file($configFile) ? require $configFile : [];
if (!is_array($config)) {
    $config = [];
}

// Umgebungsvariablen überschreiben config.php (praktisch für lokale Tests).
$smtpHost = getenv('SMTP_HOST') ?: (string) ($config['smtp_host'] ?? '');
$smtpPort = (int) (getenv('SMTP_PORT') ?: ($config['smtp_port'] ?? 587));
$smtpSecure = strtolower((string) (getenv('SMTP_SECURE') ?: ($config['smtp_secure'] ?? 'starttls')));
$smtpUser = getenv('SMTP_USER') ?: (string) ($config['smtp_user'] ?? '');
$smtpPass = getenv('SMTP_PASS') ?: (string) ($config['smtp_pass'] ?? '');
$mailTo = getenv('MAIL_TO') ?: (string) ($config['mail_to'] ?? '');
$mailFrom = getenv('MAIL_FROM') ?: (string) ($config['mail_from'] ?? $smtpUser);
$mailFromName = (string) ($config['mail_from_name'] ?? 'Oberhusers Website');

// --- Formulare ------------------------------------------------------------
const FORMS = [
    'eierabo' => [
        'label' => 'Eierabo-Anfrage',
        'required' => ['vorname', 'nachname', 'email', 'strasse', 'plz', 'ort'],
        'fields' => [
            'vorname' => 'Vorname',
            'nachname' => 'Nachname',
            'email' => 'E-Mail',
            'telefon' => 'Telefon',
            'strasse' => 'Strasse',
            'plz' => 'PLZ',
            'ort' => 'Ort',
            'abo' => 'Eierabo',
            'nachricht' => 'Nachricht',
        ],
    ],
    'kinder-anmeldung' => [
        'label' => 'Chinderhof-Anmeldung',
        'required' => [
            'vorname',
            'name',
            'adresse',
            'email',
            'telPrivat',
            'natel',
            'geburtsdatum',
        ],
        'fields' => [
            'vorname' => 'Vorname Kind',
            'name' => 'Nachname Kind',
            'adresse' => 'Adresse',
            'email' => 'E-Mail',
            'telPrivat' => 'Telefon',
            'natel' => 'Natel',
            'geburtsdatum' => 'Geburtsdatum',
            'allergien' => 'Allergien',
            'bemerkungen' => 'Bemerkungen',
            'fotoerlaubnis' => 'Fotoerlaubnis',
        ],
    ],
];

// --- Hilfsfunktionen ------------------------------------------------------
date_default_timezone_set('Europe/Zurich');

header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header('Vary: Origin');

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$originAllowed = $origin !== '' && in_array($origin, ALLOWED_ORIGINS, true);

if ($originAllowed) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Accept');
    header('Access-Control-Max-Age: 86400');
}

$accept = $_SERVER['HTTP_ACCEPT'] ?? '';
$wantsHtml = stripos($accept, 'text/html') !== false
    && stripos($accept, 'application/json') === false;

function respond_json(int $status, array $body): void
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function respond_html(bool $ok, int $status = 200): void
{
    http_response_code($status);
    header('Content-Type: text/html; charset=utf-8');

    $title = $ok ? 'Danke!' : 'Das hat leider nicht geklappt';
    $text = $ok
        ? 'Deine Anfrage ist bei uns eingegangen. Wir melden uns sobald wie möglich.'
        : 'Bitte versuche es noch einmal oder schreibe uns direkt eine E-Mail.';

    echo '<!doctype html><html lang="de-CH"><meta charset="utf-8">'
        . '<meta name="viewport" content="width=device-width, initial-scale=1">'
        . '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . ' – Oberhusers Burehof</title>'
        . '<style>'
        . 'body{margin:0;min-height:100vh;display:grid;place-items:center;'
        . 'background:#FAF6EC;color:#593930;font:18px/1.5 Arial,Helvetica,sans-serif}'
        . 'main{max-width:34rem;padding:2rem;text-align:center}'
        . 'h1{font-size:2rem;margin:0 0 1rem}a{color:#593930}'
        . '</style>'
        . '<main><h1>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</h1>'
        . '<p>' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</p>'
        . '<p><a href="/">Zurück zur Website</a></p></main></html>';
    exit;
}

function clean(string $value): string
{
    $value = str_replace(['<', '>', "\0"], '', $value);
    $value = trim($value);

    return function_exists('mb_substr')
        ? mb_substr($value, 0, MAX_FIELD_LEN, 'UTF-8')
        : substr($value, 0, MAX_FIELD_LEN);
}

function is_email(string $value): bool
{
    return strlen($value) <= 254
        && filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
}

// Einfaches Rate-Limit pro IP. Wenn der Temp-Ordner nicht schreibbar ist,
// wird nicht blockiert.
function is_rate_limited(string $ip): bool
{
    $dir = sys_get_temp_dir() . '/oberhusers-forms';
    if (!is_dir($dir) && !@mkdir($dir, 0700, true) && !is_dir($dir)) {
        return false;
    }

    $file = $dir . '/' . hash('sha256', $ip) . '.json';
    $now = time();
    $hits = [];

    if (is_file($file)) {
        $raw = @file_get_contents($file);
        $decoded = json_decode($raw !== false ? $raw : '[]', true);
        if (is_array($decoded)) {
            $hits = $decoded;
        }
    }

    $hits = array_values(array_filter(
        $hits,
        static function ($timestamp) use ($now): bool {
            return is_int($timestamp) && $timestamp > $now - RATE_LIMIT_WINDOW;
        }
    ));

    if (count($hits) >= RATE_LIMIT_MAX) {
        return true;
    }

    $hits[] = $now;
    @file_put_contents($file, json_encode($hits), LOCK_EX);

    return false;
}

// --- Request --------------------------------------------------------------
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'OPTIONS') {
    http_response_code($originAllowed ? 204 : 403);
    exit;
}

if ($method !== 'POST') {
    header('Allow: POST, OPTIONS');
    respond_json(405, ['ok' => false, 'error' => 'method_not_allowed']);
}

if ((int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > MAX_BODY_BYTES) {
    respond_json(413, ['ok' => false, 'error' => 'body_too_large']);
}

$raw = file_get_contents('php://input');
$raw = $raw !== false ? $raw : '';
$contentType = $_SERVER['CONTENT_TYPE'] ?? '';
$data = [];

if (stripos($contentType, 'application/json') !== false) {
    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        respond_json(400, ['ok' => false, 'error' => 'invalid_body']);
    }

    $payload = $decoded['data'] ?? [];
    if (!is_array($payload)) {
        respond_json(400, ['ok' => false, 'error' => 'invalid_body']);
    }

    foreach ($payload as $key => $value) {
        if (is_scalar($value)) {
            $data[(string) $key] = clean((string) $value);
        }
    }

    if (isset($decoded['form']) && is_string($decoded['form'])) {
        $data['_form'] = clean($decoded['form']);
    }
} else {
    foreach ($_POST as $key => $value) {
        if (is_string($value)) {
            $data[(string) $key] = clean($value);
        }
    }
}

// Honeypot: Bots füllen «website», Menschen nicht.
if (isset($data['website']) && trim($data['website']) !== '') {
    if ($wantsHtml) {
        respond_html(true);
    }
    respond_json(202, ['ok' => true]);
}

$formKind = $data['_form'] ?? '';
if (!is_string($formKind) || !isset(FORMS[$formKind])) {
    if ($wantsHtml) {
        respond_html(false, 400);
    }
    respond_json(400, ['ok' => false, 'error' => 'unknown_form']);
}

$form = FORMS[$formKind];
$missing = [];

foreach ($form['required'] as $field) {
    if (trim($data[$field] ?? '') === '') {
        $missing[] = $field;
    }
}

if ($missing !== []) {
    if ($wantsHtml) {
        respond_html(false, 400);
    }
    respond_json(400, [
        'ok' => false,
        'error' => 'validation',
        'fields' => $missing,
    ]);
}

if (!is_email($data['email'] ?? '')) {
    if ($wantsHtml) {
        respond_html(false, 400);
    }
    respond_json(400, [
        'ok' => false,
        'error' => 'validation',
        'fields' => ['email'],
    ]);
}

if (is_rate_limited($_SERVER['REMOTE_ADDR'] ?? 'unknown')) {
    if ($wantsHtml) {
        respond_html(false, 429);
    }
    respond_json(429, ['ok' => false, 'error' => 'rate_limited']);
}

// Nur die definierten Felder landen in der Mail.
$lines = ['Neue ' . $form['label'] . ' über die Website', ''];

foreach ($form['fields'] as $field => $label) {
    $value = $data[$field] ?? '';

    if ($field === 'fotoerlaubnis') {
        $value = trim($value) !== '' ? 'ja' : 'nein';
    }

    $lines[] = $label . ': ' . ($value !== '' ? $value : '–');
}

$lines[] = '';
$lines[] = 'Eingegangen: ' . date('d.m.Y, H:i') . ' (Europe/Zurich)';
$body = implode("\r\n", $lines);

$name = trim(
    ($data['vorname'] ?? '')
    . ' '
    . (($data['name'] ?? '') ?: ($data['nachname'] ?? ''))
);
$subject = 'Website: ' . $form['label'] . ($name !== '' ? ' – ' . $name : '');
$subject = trim(str_replace(["\r", "\n"], ' ', $subject));

if ($smtpHost === '' || $smtpUser === '' || $smtpPass === '' || $mailTo === '' || $mailFrom === '') {
    error_log('Oberhusers form mail: SMTP-Konfiguration unvollständig (config.php)');

    if ($wantsHtml) {
        respond_html(false, 500);
    }
    respond_json(500, ['ok' => false, 'error' => 'config_missing']);
}

$mail = null;

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    $mail->SMTPSecure = in_array($smtpSecure, ['ssl', 'smtps'], true)
        ? PHPMailer::ENCRYPTION_SMTPS
        : PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtpPort > 0
        ? $smtpPort
        : ($mail->SMTPSecure === PHPMailer::ENCRYPTION_SMTPS ? 465 : 587);
    $mail->CharSet = 'UTF-8';
    $mail->Timeout = 20;
    $mail->SMTPDebug = 0;

    $mail->setFrom($mailFrom, $mailFromName);
    $mail->addAddress($mailTo);
    $mail->addReplyTo($data['email']);
    $mail->Subject = $subject;
    $mail->isHTML(false);
    $mail->Body = $body;

    $mail->send();
} catch (\Throwable $e) {
    error_log('Oberhusers form mail failed (form=' . $formKind . '): ' . $e->getMessage());

    if ($mail instanceof PHPMailer && $mail->ErrorInfo !== '') {
        error_log('PHPMailer: ' . $mail->ErrorInfo);
    }

    if ($wantsHtml) {
        respond_html(false, 502);
    }
    respond_json(502, ['ok' => false, 'error' => 'mail_failed']);
}

if ($wantsHtml) {
    respond_html(true);
}
respond_json(200, ['ok' => true]);
