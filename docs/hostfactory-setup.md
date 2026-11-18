# Formulare & Hosting auf Hostfactory

Stand: November 2026. Die Website ist statisch (Astro), die Formulare laufen
über zwei PHP-Endpunkte. Hostfactory erlaubt PHP per `open_basedir` nur den
Zugriff auf `httpdocs` und `/tmp` – deshalb liegen Konfiguration und
Bibliotheken **innerhalb** des Webroots, aber in einem per `.htaccess`
gesperrten Unterordner.

```
httpdocs/
├── index.html, chinderhof/, eier/, …
└── api/
    ├── forms.php
    ├── altcha-challenge.php
    └── private/              ← Require all denied
        ├── .htaccess
        ├── config.php        ← manuell hochgeladen
        └── vendor/           ← im CI gebündelt
```

Die PHP-Skripte benutzen zuerst diesen Pfad und fallen nur lokal auf das
Repo-Layout (`private/config.php`, `backend/vendor/`) zurück.

## 1. Was versioniert ist – und was nicht

| Pfad | Im Repo? | Grund |
| --- | --- | --- |
| `public/api/*.php` | ja | API-Code; landet über `dist/` in `httpdocs/api/` |
| `public/api/private/.htaccess` | ja | sperrt `config.php` und `vendor/` im Web |
| `backend/composer.json`, `composer.lock` | ja | Reproduzierbare PHP-Abhängigkeiten |
| `backend/vendor/` | nein | Wird im CI installiert und in den Build kopiert |
| `private/config.example.php` | ja | Vorlage ohne Geheimnisse |
| `httpdocs/api/private/config.php` | nein | Serverdatei mit SMTP-Passwort und Altcha-Secret |

Nur `config.php` wird manuell gepflegt. Alles andere kommt aus dem Repo.

## 2. Repository-Secrets anlegen

GitHub → Repository → Settings → Secrets and variables → Actions.

| Secret | Pflicht | Wert |
| --- | --- | --- |
| `FTP_HOST` | ja | Host aus dem Hostfactory-Panel |
| `FTP_USERNAME` | ja | FTP-/SSH-Benutzer |
| `FTP_PASSWORD` | ja | Passwort des Accounts |

Optional als **Variable**: `SITE_URL` (Standard
`https://www.oberhusers.ch`), Ziel des Smoke-Tests.

SMTP- und Altcha-Werte sind keine GitHub-Secrets: Sie stehen nur in
`httpdocs/api/private/config.php` auf dem Server.

## 3. `config.php` manuell anlegen und hochladen

Einmalig lokal:

```bash
cp private/config.example.php private/config.php
```

Werte ausfüllen (dieselben Keys wie in der Vorlage):

| Schlüssel | Bedeutung |
| --- | --- |
| `recipient_email` | Empfänger der Formular-Mails |
| `sender_email`, `sender_name` | sichtbarer Absender der eigenen Domain |
| `smtp_host`, `smtp_port` | Infomaniak: `mail.infomaniak.com`, `587` |
| `smtp_secure` | `starttls` (Port 587) oder `ssl` (Port 465) |
| `smtp_username`, `smtp_password` | Mailadresse + App-Passwort |
| `altcha_secret` | `openssl rand -hex 32`, **stabil lassen** |

Dann per FTPS hochladen nach:

```
httpdocs/api/private/config.php
```

Nicht in den Account-Ordner `private/` (dort liegen die DB-Backups): PHP darf
dort wegen `open_basedir` nicht lesen. Bei späteren Änderungen genügt es, nur
diese eine Datei erneut hochzuladen.

`altcha_secret` darf sich nicht ändern: Bereits ausgegebene Challenges werden
sonst ungültig. Er dient ausserdem als Schlüssel für die Rate-Limit-Dateien.

## 4. Ablauf des Deployments

`.github/workflows/deploy.yml` läuft bei jedem Push auf `main` und manuell über
«Run workflow»:

1. prüft, ob die FTP-Secrets gesetzt sind,
2. installiert Node- und Composer-Abhängigkeiten,
3. baut die Website,
4. kopiert `backend/vendor/` nach `dist/api/private/vendor/`,
5. prüft, ob API, `vendor/` und `.htaccess` im Build liegen,
6. lädt `dist/` nach `httpdocs/`,
7. ruft `/api/altcha-challenge.php` auf und prüft die JSON-Antwort.

Der Deploy-Schritt schliesst `api/private/config.php` aus, damit die manuell
gepflegte Datei nicht angefasst wird. Die früheren Ziele `~/private` und
`~/backend` entfallen.

## 5. Einmalige Einrichtung auf Hostfactory

1. **PHP-Version**: im Panel **8.1 oder neuer** wählen (empfohlen 8.3).
2. **FTPS aktivieren** und Host, Port, Benutzer und Passwort notieren.
3. **Webroot** ist `httpdocs` (bestätigt: `/srv/www/vhosts/chinderhof.ch/httpdocs`).
4. **`api/private/`**: wird durch das Deployment angelegt; `config.php` dort
   manuell ablegen (Schritt 3). Das `.htaccess` kommt aus dem Build.
5. **Domain**: `oberhusers.ch` und `www.oberhusers.ch` mit gültigem
   SSL-Zertifikat versehen.
6. **Mail**: In Infomaniak SPF, DKIM und DMARC setzen, App-Passwort verwenden.

Die Serverordner `private/` (DB-Backups) und ein evtl. vorhandenes
`backend/` neben `httpdocs` bleiben unberührt; sie werden von der Anwendung
nicht mehr benutzt.

## 6. Lokal entwickeln und testen

```bash
npm install
composer install --working-dir=backend
cp private/config.example.php private/config.php   # einmalig, danach ausfüllen
```

Zwei Terminals:

```bash
npm run dev:backend   # PHP auf http://localhost:8080
npm run dev           # Astro auf http://localhost:4321
```

Lokal greift der Fallback auf `private/config.php` und `backend/vendor/`.
Der Astro-Dev-Server leitet `/api/*` an PHP weiter (`astro.config.mjs`).

### API direkt prüfen

```bash
curl -s http://localhost:8080/api/altcha-challenge.php | head -c 200
```

Erwartet: JSON mit `parameters` und `signature`. Ein `POST` ohne gültige
Altcha-Lösung antwortet mit `403` – das ist korrekt.

## 7. Fehlersuche

| Symptom | Ursache / Lösung |
| --- | --- |
| `500` bei `/api/altcha-challenge.php` | `api/private/config.php` oder `api/private/vendor/` fehlt. Error-Log nennt jetzt die geprüften Pfade. |
| `open_basedir restriction in effect` | Pfad ausserhalb `httpdocs` – Datei nach `httpdocs/api/private/` verschieben. |
| `403` «Sicherheitsprüfung fehlgeschlagen» | Challenge abgelaufen (120 s), `altcha_secret` geändert oder Serveruhr falsch. |
| `403` «Bitte schliesse die Sicherheitsprüfung ab» | Altcha-Widget hat noch nicht gelöst oder Challenge-Request schlug fehl. |
| `405` auf `/api/forms.php` | Direktaufruf per GET; das Formular sendet POST. |
| `422` Pflichtfeld | Feld leer oder E-Mail ungültig. |
| `429` | Rate-Limit: 10 Anfragen pro IP in 10 Minuten. |
| `500` beim Senden | SMTP-Login oder Verbindung fehlgeschlagen; PHP-Error-Log ansehen. |
| `535 Authentication failed` | Infomaniak verlangt ein App-Passwort, oder `smtp_username` ist nicht die vollständige Mailadresse. |
| Mail kommt nicht an | Spam-Ordner, SPF/DKIM/DMARC, `recipient_email` und `sender_email` prüfen. |
| Smoke-Test schlägt fehl, Website geht aber | `SITE_URL`-Variable, `api/private/config.php` und `api/private/vendor/` prüfen. |

## 8. Sicherheit

- `api/private/.htaccess` sperrt den gesamten Unterordner im Web
  (`Require all denied`). Nicht löschen und nicht umbenennen.
- Selbst wenn eine Anfrage `config.php` erreichen sollte, führt PHP sie nur
  aus und gibt nichts aus – Quelltext wird nicht ausgeliefert.
- `config.php` wird nie committet; im Repository liegt nur die Vorlage.
- Formular-Schutz: Altcha-Challenge, Honeypot `website`, Rate-Limit pro IP,
  serverseitige Validierung und Whitelisting der Felder.
- SMTP-Zugangsdaten, die früher im Klartext in der Arbeitskopie lagen, sollten
  einmalig rotiert werden – besonders, wenn das Repository öffentlich ist.
- Für den Versand ein eigenes App-Passwort verwenden.

## 9. Warum liegt `config.php` jetzt im Webroot?

Hostfactory setzt:

```
open_basedir = /srv/www/vhosts/chinderhof.ch/httpdocs/:/tmp/
```

Alles ausserhalb von `httpdocs` ist für PHP unsichtbar – auch der vom Hoster
bereitgestellte `private/`-Ordner mit den DB-Backups. Ein `require` von dort
schlägt fehl, egal welche Rechte die Datei hat. Die einzige praktikable
Variante auf diesem Hosting ist deshalb `httpdocs/api/private/` mit
`.htaccess`-Schutz.

Falls Hostfactory `open_basedir` später um einen Ordner ausserhalb von
`httpdocs` erweitert, kann man `config.php` und `vendor/` dorthin verschieben;
der Code prüft den Deployment-Pfad zuerst und kann entsprechend angepasst
werden.
