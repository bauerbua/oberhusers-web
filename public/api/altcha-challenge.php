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
$configFile = $root . '/private/config.php';
$autoloadFile = $root . '/backend/vendor/autoload.php';

if (!is_file($configFile) || !is_file($autoloadFile)) {
    error_log(
        'ALTCHA challenge error: private/config.php or ' .
        'backend/vendor/autoload.php is missing.'
    );

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
