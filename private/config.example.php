<?php

declare(strict_types=1);

// Vorlage für `private/config.php`.
//
// Einmalig kopieren, Werte eintragen und die Datei manuell per FTPS auf den
// Server laden – nach `private/config.php`, also ausserhalb von `httpdocs/`.
// Die echte Datei ist absichtlich nicht versioniert.

return [
    'recipient_email' => '',
    'sender_email' => '',
    'sender_name' => '',

    'smtp_host' => 'mail.infomaniak.com',
    'smtp_port' => 587,
    'smtp_secure' => 'starttls',
    'smtp_username' => '',
    'smtp_password' => '',

    'altcha_secret' => '',

    // Temporary storage for rate limiting
    'rate_limit_dir' => sys_get_temp_dir() . '/oberhusers-form-rate',
];
