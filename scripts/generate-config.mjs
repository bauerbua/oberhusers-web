import { mkdirSync, writeFileSync } from "node:fs";
import { dirname, resolve } from "node:path";

const target = resolve(process.argv[2] ?? "dist/api/config.php");
const env = process.env;

const secure = (env.SMTP_SECURE || "starttls").toLowerCase();
if (!["starttls", "tls", "ssl", "smtps"].includes(secure)) {
    console.error("SMTP_SECURE muss starttls, tls, ssl oder smtps sein.");
    process.exit(1);
}

const port = Number(
    env.SMTP_PORT || (secure === "ssl" || secure === "smtps" ? 465 : 587),
);
if (!Number.isInteger(port) || port < 1 || port > 65535) {
    console.error("SMTP_PORT ist ungültig.");
    process.exit(1);
}

const values = {
    smtp_host: env.SMTP_HOST || "mail.infomaniak.com",
    smtp_port: port,
    smtp_secure: secure,
    smtp_user: env.SMTP_USER || "",
    smtp_pass: env.SMTP_PASS || "",
    mail_to: env.MAIL_TO || "",
    mail_from: env.MAIL_FROM || env.SMTP_USER || "",
    mail_from_name: env.MAIL_FROM_NAME || "Oberhusers Website",
};

const required = ["smtp_user", "smtp_pass", "mail_to", "mail_from"];
const missing = required.filter((key) => String(values[key]).trim() === "");

if (missing.length > 0) {
    console.error(`Fehlende Secrets: ${missing.join(", ")}`);
    process.exit(1);
}

const asPhpString = (value) =>
    `'${String(value).replace(/\\/g, "\\\\").replace(/'/g, "\\'")}'`;

const lines = [
    "<?php",
    "",
    "// Automatisch beim Deployment erzeugt. Nicht committen.",
    "return [",
    `    'smtp_host' => ${asPhpString(values.smtp_host)},`,
    `    'smtp_port' => ${values.smtp_port},`,
    `    'smtp_secure' => ${asPhpString(values.smtp_secure)},`,
    `    'smtp_user' => ${asPhpString(values.smtp_user)},`,
    `    'smtp_pass' => ${asPhpString(values.smtp_pass)},`,
    `    'mail_to' => ${asPhpString(values.mail_to)},`,
    `    'mail_from' => ${asPhpString(values.mail_from)},`,
    `    'mail_from_name' => ${asPhpString(values.mail_from_name)},`,
    "];",
    "",
];

mkdirSync(dirname(target), { recursive: true });
writeFileSync(target, lines.join("\n"), { mode: 0o600 });
console.log(`config.php erzeugt: ${target}`);
