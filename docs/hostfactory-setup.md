# Formulare & Hosting auf Hostfactory

Stand: November 2026. Die Website ist statisch (Astro), die Formulare laufen
über zwei PHP-Endpunkte. SMTP- und Altcha-Zugangsdaten stehen in einer
`private/config.php`, die **manuell** auf dem Server gepflegt wird.

```
git push auf main
      │
      ▼
GitHub Actions
  npm ci
  composer install  → backend/vendor/
  npm run build     → dist/
      │
      ▼  FTPS
  dist/     → httpdocs/   Website + api/*.php (öffentlich)
  backend/  → backend/    composer.json, composer.lock, vendor/
      │
      ▼
Server
  httpdocs/api/forms.php
    ├─ require ../../private/config.php      ← manuell hochgeladen
    └─ require ../../backend/vendor/autoload.php
```

`dirname(__DIR__, 2)` in den PHP-Skripten landet im Benutzer-Home, eine Ebene
über `httpdocs`. Deshalb müssen `private/` und `backend/` **ausserhalb** des
Web-Roots liegen. Das setzt voraus, dass der FTP-/SFTP-Login im Home beginnt
(also `httpdocs` ein Unterordner ist). Prüfen mit `pwd` in einem SFTP-Client.

## 1. Was versioniert ist – und was nicht

| Pfad | Im Repo? | Grund |
| --- | --- | --- |
| `public/api/*.php` | ja | API-Code; landet über `dist/` in `httpdocs/api/` |
| `backend/composer.json`, `composer.lock` | ja | Reproduzierbare PHP-Abhängigkeiten |
| `backend/vendor/` | nein | Wird im CI mit Composer installiert und hochgeladen |
| `private/config.example.php` | ja | Vorlage ohne Geheimnisse |
| `private/config.php` | nein | Enthält SMTP-Passwort und Altcha-Secret |

Nur `config.php` wird manuell hochgeladen. Alles andere kommt aus dem Repo –
sonst würden Server und Git auseinanderlaufen.

## 2. Repository-Secrets anlegen

GitHub → Repository → Settings → Secrets and variables → Actions.

| Secret | Pflicht | Wert |
| --- | --- | --- |
| `FTP_HOST` | ja | Host aus dem Hostfactory-Panel |
| `FTP_USERNAME` | ja | FTP-/SSH-Benutzer |
| `FTP_PASSWORD` | ja | Passwort des Accounts |

Optional als **Variable**: `SITE_URL` (Standard
`https://www.oberhusers.ch`), Ziel des Smoke-Tests.

SMTP- und Altcha-Werte sind **keine** GitHub-Secrets mehr: Sie stehen nur in
`private/config.php` auf dem Server.

## 3. `config.php` manuell anlegen und hochladen

Einmalig:

```bash
cp private/config.example.php private/config.php
```

Dann in `private/config.php` ausfüllen:

| Schlüssel | Bedeutung |
| --- | --- |
| `recipient_email` | Empfänger der Formular-Mails |
| `sender_email`, `sender_name` | sichtbarer Absender (Adresse der eigenen Domain) |
| `smtp_host`, `smtp_port` | Infomaniak: `mail.infomaniak.com`, `587` |
| `smtp_secure` | `starttls` (Port 587) oder `ssl` (Port 465) |
| `smtp_username`, `smtp_password` | vollständige Mailadresse + App-Passwort |
| `altcha_secret` | `openssl rand -hex 32`, **stabil lassen** |

Datei per FTPS nach `private/config.php` hochladen – **nicht** nach
`httpdocs/`. Der Ordner `private/` muss auf dem Server existieren; er wird vom
Deployment nicht angelegt, weil er nicht im Repo liegt.

Bei späteren Änderungen genügt es, nur diese Datei erneut hochzuladen. Ein
neues Deployment ist dafür nicht nötig.

`altcha_secret` darf sich nicht ändern: Bereits ausgegebene Challenges werden
sonst ungültig. Er dient ausserdem als Schlüssel für die Rate-Limit-Dateien.

## 4. Ablauf des Deployments

`.github/workflows/deploy.yml` läuft bei jedem Push auf `main` und manuell über
«Run workflow»:

1. prüft, ob die FTP-Secrets gesetzt sind,
2. installiert Node- und Composer-Abhängigkeiten,
3. baut die Website,
4. prüft, ob API und `vendor/autoload.php` vorhanden sind,
5. lädt **zuerst** `backend/` hoch (ausserhalb des Web-Roots),
6. lädt danach `dist/` nach `httpdocs/`,
7. ruft `/api/altcha-challenge.php` auf und prüft die JSON-Antwort.

`private/config.php` wird bewusst nicht angefasst. Der Smoke-Test schlägt fehl,
wenn die Datei auf dem Server fehlt oder unvollständig ist.

## 5. Einmalige Einrichtung auf Hostfactory

1. **PHP-Version**: im Panel PHP **8.1 oder neuer** wählen (Altcha verlangt
   `>= 8.1`; empfohlen 8.3).
2. **FTPS aktivieren** und Host, Port, Benutzer und Passwort notieren.
3. **Web-Root** prüfen: Der FTP-Login muss im Home beginnen und `httpdocs`
   als Unterordner zeigen. Sonst würden `backend/` und `private/` an der
   falschen Stelle landen.
4. **`private/` anlegen** und `config.php` dort hochladen (Schritt 3).
5. **Domain**: `oberhusers.ch` und `www.oberhusers.ch` auf das Webhosting
   zeigen lassen, HTTPS aktivieren.
6. **Mail**: In Infomaniak SPF, DKIM und DMARC für die Domain setzen. Ein
   eigenes App-Passwort für den Versand verwenden.

Falls der FTP-Zugang nicht über `httpdocs` hinausreicht, ist dieses Layout
nicht möglich. Dann müssten `config.php` und `vendor/` innerhalb von
`httpdocs/api/` liegen (mit `.htaccess`-Schutz) und die `require`-Pfade in den
PHP-Dateien angepasst werden. Das ist die schlechtere Variante, weil Secrets
dann im Web-Root liegen.

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

Der Astro-Dev-Server leitet `/api/*` an PHP weiter (`astro.config.mjs`).
Formular ausfüllen und absenden: Die Seite bleibt stehen, unter dem Button
erscheint eine Meldung. Der Versand geht über Infomaniak an `recipient_email`.

### API direkt prüfen

```bash
curl -s http://localhost:8080/api/altcha-challenge.php | head -c 200
```

Erwartet: JSON mit `parameters` und `signature`. Ein `POST` ohne gültige
Altcha-Lösung antwortet mit `403` – das ist korrekt.

## 7. Fehlersuche

| Symptom | Ursache / Lösung |
| --- | --- |
| `500` bei `/api/altcha-challenge.php` | `private/config.php` fehlt oder ist unvollständig → Datei per FTPS hochladen. |
| `Failed to open stream: …/backend/vendor/autoload.php` | `backend/` wurde nicht hochgeladen oder landete im falschen Verzeichnis. |
| `403` «Sicherheitsprüfung fehlgeschlagen» | Challenge abgelaufen (120 s), `altcha_secret` zwischen Ausgabe und Prüfung geändert oder Serveruhr falsch. |
| `403` «Bitte schliesse die Sicherheitsprüfung ab» | Altcha-Widget hat noch nicht gelöst oder Challenge-Request schlug fehl. |
| `405` auf `/api/forms.php` | Direktaufruf per GET; das Formular sendet POST. |
| `422` Pflichtfeld | Feld leer oder E-Mail ungültig. |
| `429` | Rate-Limit: 5 Anfragen pro IP in 10 Minuten. |
| `500` beim Senden | SMTP-Login oder Verbindung fehlgeschlagen; PHP-Error-Log ansehen. |
| `535 Authentication failed` | Infomaniak verlangt ein App-Passwort, oder `smtp_username` ist nicht die vollständige Mailadresse. |
| Mail kommt nicht an | Spam-Ordner, SPF/DKIM/DMARC, `recipient_email` und `sender_email` prüfen. |
| Deploy landet am falschen Ort | FTP-Login beginnt nicht im Home, oder `server-dir` passt nicht. `pwd` per SFTP prüfen. |
| Smoke-Test schlägt fehl, Website geht aber | `SITE_URL`-Variable prüfen; `private/config.php` und `backend/` auf dem Server prüfen. |
| Änderung nicht sichtbar | Workflow-Log ansehen, ob der Upload-Schritt durchlief; ggf. «Run workflow». |

## 8. Sicherheit

- `config.php` liegt ausserhalb des Web-Roots und wird nie committet.
- Secrets in GitHub: nur die FTP-Zugangsdaten. SMTP- und Altcha-Werte stehen
  ausschliesslich in `private/config.php` auf dem Server.
- Formular-Schutz: Altcha-Challenge, Honeypot `website`, Rate-Limit pro IP,
  serverseitige Validierung und Whitelisting der Felder.
- SMTP-Zugangsdaten, die früher im Klartext in der Arbeitskopie lagen, sollten
  einmalig rotiert werden – besonders, wenn das Repository öffentlich ist.
- Für den Versand ein eigenes App-Passwort verwenden, damit es bei einem Leak
  einfach widerrufen werden kann.
- `private/config.php` nach dem Upload möglichst auf `600` setzen, falls der
  FTP-Client das unterstützt.

## 9. Was bewusst nicht automatisiert ist

- **`config.php`**: enthält Geheimnisse und ändert sich selten. Manuell
  hochladen ist einfacher als Secrets, Generatoren und Extra-Deploy-Ziele.
- **`vendor/` dagegen schon**: Die Bibliotheken sind kein Geheimnis und
  ergeben sich eindeutig aus `composer.lock`. Ein manueller Upload würde bei
  einem vergessenen Update zu schwer auffindbaren Fehlern führen.
- **`public/api/*.php` schon gar nicht**: Diese Dateien sind Teil des
  Astro-Builds. Ein manueller Upload würde den Build und die Website
  auseinanderlaufen lassen.

Wenn du Composer im CI ganz vermeiden willst, ist die sauberste Alternative,
`backend/vendor/` zu committen (ca. 900 KB) und die PHP-Schritte im Workflow zu
entfernen. Dann kommt weiterhin alles automatisch aus dem Repo – nur
`config.php` bleibt manuell.
