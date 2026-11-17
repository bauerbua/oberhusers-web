<?php

declare(strict_types=1);

// Vorlage für `config.php`.
//
// Einmalig kopieren, Werte eintragen und die Datei manuell per FTPS auf den
// Server laden – nach `httpdocs/api/private/config.php` (innerhalb des
// Webroots, aber per .htaccess gesperrt; Hostfactorys open_basedir erlaubt
// keinen Zugriff ausserhalb von httpdocs).
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
