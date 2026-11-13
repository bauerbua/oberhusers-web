# Formulare & Hosting auf Hostfactory

Stand: Nov 2026. Die Website ist statisch (Astro) und liegt zusammen mit
einem kleinen PHP-Skript auf Hostfactory. Die Formulare schicken ihre Daten
an `/api/senden.php`; das Skript verschickt sie per SMTP über Infomaniak.

```
git push auf main
      │
      ▼
GitHub Actions: npm ci → build → config.php aus Secrets → SFTP
      │
      ▼
Hostfactory Web-Root
      ├── index.html, chinderhof/, eier/, …
      └── api/senden.php ──PHPMailer──▶ mail.infomaniak.com ──▶ Postfach
```

## 1. Deployment per GitHub Actions

Der Workflow `.github/workflows/deploy.yml` läuft bei jedem Push auf `main`
und lässt sich manuell starten (Actions → «Deploy to Hostfactory» → «Run
workflow»). Er macht Folgendes:

1. prüft, ob alle nötigen Secrets gesetzt sind,
2. baut die Website mit `npm ci && npm run build`,
3. erzeugt `dist/api/config.php` aus den SMTP-Secrets
   (`scripts/generate-config.mjs`),
4. prüft, ob `senden.php`, PHPMailer und `config.php` im Build liegen,
5. spiegelt `dist/` per SFTP in das Web-Root.

Der Upload ist ein vollständiger Abgleich (`sync: full`) mit `--delete`:
Dateien, die im Web-Root liegen, aber nicht im Build, werden gelöscht. Damit
das nichts Wichtiges trifft, sind `.well-known/`, `cgi-bin/`, `logs/`,
`*.log`, `error_log`, `.deploy-*`, `.user.ini` und `php.ini` ausgenommen.

### Einmalig: SFTP bei Hostfactory aktivieren

1. my.hostfactory.ch → «Webhostings» → Webhosting wählen → Domain Account
   wählen → «FTP / SSH verwalten» → «SSH/SFTP aktivieren».
2. Dort stehen Hostname, Port und Benutzername. Das Passwort ist das
   FTP-/SSH-Passwort des Accounts.
3. Den absoluten Pfad zum Web-Root herausfinden: einmal mit einem
   SFTP-Client verbinden und `pwd` ausführen, oder im Panel beim
   FTP-Verzeichnis nachsehen. Meist ist es `/home/BENUTZER/public_html`.

> **Wichtig:** `SFTP_REMOTE_DIR` muss der absolute Pfad genau dieses
> Web-Roots sein, zum Beispiel `/home/BENUTZER/public_html`. Nie `/` und
> nicht das Home-Verzeichnis, sonst löscht `--delete` dort alles, was nicht
> zur Website gehört.

Falls im Web-Root bereits eine wichtige `.htaccess` liegt (z. B. mit
Weiterleitungen oder PHP-Einstellungen), vor dem ersten Deployment eine
Sicherung machen und sie bei Bedarf als `public/.htaccess` ins Repository
legen — dann wird sie mit ausgeliefert. Dateien ausserhalb der oben
genannten Ausnahmen, die nicht im Build liegen, werden gelöscht.

### Repository-Secrets anlegen

GitHub → Repository → Settings → Secrets and variables → Actions.

| Secret | Pflicht | Wert |
| --- | --- | --- |
| `SFTP_HOST` | ja | SFTP-Host aus dem Hostfactory-Panel |
| `SFTP_PORT` | nein | Standard `22` |
| `SFTP_USER` | ja | FTP-/SSH-Benutzer |
| `SFTP_PASSWORD` | ja\* | Passwort des Accounts |
| `SFTP_PRIVATE_KEY` | ja\* | alternativ: kompletter privater SSH-Key |
| `SFTP_REMOTE_DIR` | ja | absoluter Pfad zum Web-Root, z. B. `/home/BENUTZER/public_html` |
| `SMTP_HOST` | nein | Standard `mail.infomaniak.com` |
| `SMTP_PORT` | nein | Standard `587` |
| `SMTP_SECURE` | nein | Standard `starttls` (`ssl` für Port 465) |
| `SMTP_USER` | ja | vollständige Infomaniak-Mailadresse |
| `SMTP_PASS` | ja | SMTP- oder App-Passwort |
| `MAIL_TO` | ja | Empfänger der Formular-Mails |
| `MAIL_FROM` | nein | Absender, Standard: `SMTP_USER` |

\* Entweder `SFTP_PASSWORD` oder `SFTP_PRIVATE_KEY`. Der Key ist die
robustere Variante: Das Passwort wird vom Deployer ungeschützt in ein
Shell-Skript eingesetzt, deshalb bricht der Workflow bei Passwörtern mit
`"`, `$`, `` ` `` oder `\` ab. In dem Fall einen SSH-Key verwenden.

`MAIL_FROM_NAME` ist optional und kann als Repository-**Variable** (`vars`)
angelegt werden; Standard ist «Oberhusers Website».

Die Secrets werden nie committet. `.env` ist in `.gitignore`; im CI
existiert `dist/api/config.php` erst nach dem Generieren aus den Secrets.

### GitHub Pages abschalten

Der frühere Pages-Workflow ist ersetzt. Falls Pages im Repository noch
aktiv ist: Settings → Pages → Source auf «None» stellen. Die Domain zeigt
auf Hostfactory, nicht auf Pages.

## 2. SMTP konfigurieren (Infomaniak)

Für das Deployment sind die Secrets oben ausreichend; `dist/api/config.php`
wird im Workflow erzeugt. Für lokale Tests gibt es die committete Vorlage
`.env.example`:

```bash
cp .env.example .env
```

Dann in `.env` ausfüllen:

```dotenv
SMTP_HOST=mail.infomaniak.com
SMTP_PORT=587
SMTP_SECURE=starttls
SMTP_USER=deine-adresse@oberhusers.ch
SMTP_PASS=DEIN_SMTP_PASSWORT
MAIL_TO=deine@private-adresse.ch
MAIL_FROM=deine-adresse@oberhusers.ch
```

- `MAIL_TO` ist der Empfänger und darf deine private Adresse sein.
- `MAIL_FROM` muss zum Infomaniak-Postfach bzw. einer dort erlaubten
  Absenderadresse passen.
- `.env` ist in `.gitignore`; `.env.example` ist die Vorlage und wird
  committet.

Danach `dist/api/config.php` aus der `.env` erzeugen:

```bash
npm run build
npm run generate:config
```

Das Skript schreibt die PHP-Datei nach `dist/api/config.php`. Die Werte
lassen sich auch direkt als Umgebungsvariablen setzen, ohne `.env`:

```bash
SMTP_USER=… SMTP_PASS=… MAIL_TO=… npm run generate:config
```

In Infomaniak zusätzlich SPF/DKIM für die Domain setzen. Als Absender eine
Adresse der eigenen Domain verwenden, nicht eine fremde. Für den Versand
am besten ein eigenes App-Passwort anlegen, damit es bei einem Leak
einfach widerrufen werden kann.

## 3. Testen

### Lokal mit echtem Mailversand

```bash
brew install php          # falls PHP noch nicht installiert ist
cp .env.example .env      # einmalig, danach ausfüllen
npm run build
npm run generate:config
php -S localhost:8080 -t dist
```

`http://localhost:8080/chinderhof/` öffnen, das Formular ausfüllen und
absenden. Die Mail geht über Infomaniak raus und kommt bei `MAIL_TO` an.
PHPMailer spricht SMTP direkt; `mail()`, sendmail oder msmtp werden weder
lokal noch auf dem Server benötigt.

### Gegen die Produktion

```bash
curl -i -X POST https://www.oberhusers.ch/api/senden.php \
  -H 'Content-Type: application/json' \
  -H 'Accept: application/json' \
  -d '{"form":"kinder-anmeldung","data":{"vorname":"Test","name":"Test","email":"test@example.com","adresse":"Testweg 1","telPrivat":"034 000 00 00","natel":"079 000 00 00","geburtsdatum":"2018-05-01","allergien":"","bemerkungen":"Test","fotoerlaubnis":"ja"}}'
```

Erwartet: HTTP 200 und `{"ok":true}`. Das Rate-Limit erlaubt 5 Anfragen pro
IP in 10 Minuten; für weitere Tests kurz warten.

Ohne JavaScript wird das Formular klassisch abgeschickt und das Skript
antwortet mit einer Danke- bzw. Fehlerseite.

## 4. Fehlersuche

| Symptom | Ursache / Lösung |
| --- | --- |
| `Fehlende Repository-Secrets` | Secret(s) unter Settings → Secrets and variables → Actions anlegen. |
| `SFTP_REMOTE_DIR muss ein absoluter Pfad sein` | Pfad mit `/` beginnen lassen, z. B. `/home/BENUTZER/public_html`. |
| `Permission denied (publickey,password)` | SFTP-Benutzer/Passwort bzw. Key prüfen; SSH/SFTP im Panel aktiviert? |
| Upload landet im falschen Ordner | `SFTP_REMOTE_DIR` zeigt nicht auf das Web-Root. Pfad per SFTP-Client mit `pwd` prüfen. |
| `500` / `config_missing` | `dist/api/config.php` fehlt oder SMTP-/Mail-Werte sind leer. Secrets prüfen und neu deployen. |
| `502` / `mail_failed` | SMTP-Login abgelehnt. Zugangsdaten, Port und Verschlüsselung prüfen; PHP-Error-Log ansehen. |
| `400` / `validation` | Pflichtfeld fehlt oder E-Mail ungültig. Das Formular zeigt das im UI an. |
| `429` / `rate_limited` | Zu viele Anfragen von derselben IP. Kurz warten. |
| Mail kommt nicht an | Spam-Ordner, SPF/DKIM, Empfängeradresse und `mail_from` prüfen. |
| `535` / Authentication failed | Infomaniak verlangt evtl. ein App-Passwort, oder der Benutzername ist nicht die vollständige Mailadresse. |
| Formular sendet nicht | Im Browser prüfen, ob `/api/senden.php` erreichbar ist. |

## 5. Sicherheit

- SMTP-Zugangsdaten stehen nur in `config.php`, nicht im Frontend und nicht
  im Repository.
- `config.php` wird im CI aus Secrets erzeugt und ist per `.htaccess` gegen
  direkten HTTP-Aufruf geschützt.
- Serverseitige Validierung von Formularart, Pflichtfeldern und E-Mail.
- Honeypot-Feld `website`; Bots bekommen eine Erfolgsmeldung, es wird aber
  nichts verschickt.
- Nur bekannte Felder landen in der Mail.
- Einfaches dateibasiertes Rate-Limit pro IP.

## 6. Analytics

Aktuell ist **kein** Web-Tracking eingebaut. Für die Frage «über welche
Suchbegriffe kommen Leute auf die Seite?» reicht die **Google Search
Console**:

1. Property für `https://www.oberhusers.ch` anlegen und per DNS oder
   HTML-Datei verifizieren.
2. Unter «Leistung» Suchanfragen, Klicks und Impressionen beobachten.

Falls später Seitenaufrufe oder Events gewünscht sind, kann ein
datenschutzfreundliches Tool ergänzt werden — dann muss der
Datenschutz-Abschnitt im Impressum entsprechend angepasst werden.

## 7. PHPMailer

PHPMailer liegt ohne Composer unter `public/api/PHPMailer/` (v7.2.0,
LGPL-2.1). `senden.php` lädt die drei benötigten Dateien direkt. Zum
Aktualisieren die Dateien aus einem PHPMailer-Release ersetzen:

- `PHPMailer.php`
- `SMTP.php`
- `Exception.php`
- `LICENSE`

### Warum kein Composer?

PHP installiert Pakete nicht zur Laufzeit. Composer ist nur der Paketmanager
für Entwicklung und Build; die Dateien aus `vendor/` müssen trotzdem mit auf
den Server. Auf Shared Hosting ist Composer oft gar nicht verfügbar, und für
einen einzelnen Endpoint wäre `vendor/` (Autoloader, Sprachdateien, Docs)
grösser als die drei tatsächlich benötigten Dateien. Der «ganze Source» ist
das also nicht: Beispiele, Tests, Übersetzungen und Doku fehlen bewusst.

Wer trotzdem Composer verwenden will: `phpmailer/phpmailer` in eine
`composer.json` aufnehmen, im CI `composer install --no-dev` ausführen und
`vendor/` nach `dist/api/vendor/` kopieren. `senden.php` bindet dann
`vendor/autoload.php` statt der drei Einzeldateien ein. Lokal braucht es
dafür zusätzlich Composer.
