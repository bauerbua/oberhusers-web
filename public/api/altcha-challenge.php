<?php

declare(strict_types=1);

use AltchaOrg\Altcha\Altcha;
use AltchaOrg\Altcha\Algorithm\Pbkdf2;
use AltchaOrg\Altcha\CreateChallengeOptions;

// Allow requests from your local Astro server and production domain.
$allowedOrigins = [
    'http://localhost:4321',
    'http://oberhusers.ch',
    'https://oberhusers.ch',
    'http://www.oberhusers.ch',
    'https://www.oberhusers.ch',
    'http://chinderhof.ch',
    'https://chinderhof.ch',
    'http://www.chinderhof.ch',
    'https://www.chinderhof.ch',
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $allowedOrigins, true)) {
    header("Access-Control-Allow-Origin: $origin");
    header('Vary: Origin');
}

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$root = dirname(__DIR__, 2);

// Hostfactory erlaubt per open_basedir nur httpdocs + /tmp. Darum liegen
// config.php und vendor/ im Deployment unter api/private/. Lokal greift der
// Fallback auf das Repo-Layout (private/config.php, backend/vendor/).
$configCandidates = [
    __DIR__ . '/private/config.php',
    $root . '/private/config.php',
];
$autoloadCandidates = [
    __DIR__ . '/private/vendor/autoload.php',
    $root . '/backend/vendor/autoload.php',
];

$configFile = null;
$autoloadFile = null;

foreach ($configCandidates as $candidate) {
    if (@is_file($candidate) && @is_readable($candidate)) {
        $configFile = $candidate;
        break;
    }
}

foreach ($autoloadCandidates as $candidate) {
    if (@is_file($candidate) && @is_readable($candidate)) {
        $autoloadFile = $candidate;
        break;
    }
}

$problems = [];

if ($configFile === null) {
    $problems[] = 'config.php not found in: ' . implode(', ', $configCandidates);
}

if ($autoloadFile === null) {
    $problems[] = 'autoload.php not found in: ' . implode(', ', $autoloadCandidates);
}

if ($problems !== []) {
    error_log('ALTCHA challenge error: ' . implode('; ', $problems));

    http_response_code(500);
    echo json_encode(['error' => 'Could not create verification challenge']);
    exit;
}

try {
    $config = require $configFile;
    require $autoloadFile;

    $altcha = new Altcha(
        hmacSignatureSecret: $config['altcha_secret']
    );

    $algorithm = new Pbkdf2();

    $challenge = $altcha->createChallenge(
        new CreateChallengeOptions(
            algorithm: $algorithm,
            cost: 10000,
            expiresAt: time() + 120,
        )
    );

    echo json_encode(
        $challenge->toArray(),
        JSON_THROW_ON_ERROR
    );

} catch (Throwable $e) {
    error_log('ALTCHA challenge error: ' . $e->getMessage());

    http_response_code(500);

    echo json_encode([
        'error' => 'Could not create verification challenge',
    ]);
}
