# SHAPE.md – Hof Oberhusers Website (MVP)

Mode: Persuade (Start/Eier/Kindernachmittage/Milch) + Read (Ackerbau/Über uns) + Operate (Formulare/Besuch-Module).
Status: UX-Plan vor Code, kein visueller Entwurf. Technik: Astro + Tailwind, kein CMS (Content in Dateien).

## 1. Jobs / Journeys
1. **Stamm-Eierkunde:** „Ändert sich was für mich?“ → Übernahme-Hinweis auf Start → Eier (Was bleibt / Was ändert sich) → Vertrauen (Labels + Menschen) → bleibt. Braucht: Wechsel transparent, Eierkühlschrank-Info unverändert, Kontakt.
2. **Interessent Eierabo:** „Kann ich Eier bekommen?“ → Start/Eier → Interesse-Formular. Kein „Jetzt abonnieren“, sondern Interesse erfassen: Name, Kontakt (möglicherweise auch einfach ein email für direkten, persönlichen Kontakt)
3. **Gewerbe (Laden/Bäckerei/Restaurant):** „Was liefern sie, wie Kontakt?“ → Eier (B2B-Block, neuer Produzent transparent) → Kontakt (Besuch-Modul). Braucht: Produkte, Mengen, Ansprechpartner in <30s.
4. **Familie 3-10J:** „Was erleben Kinder, ist es vertrauenswürdig, wie anmelden?“ → Kindernachmittage → Anmeldung + Barbara/Anne-Lea. Braucht: Ablauf, Jahreszyklus, pädagogische Einordnung, Termine.
5. **Besucher:** „Darf ich vorbeikommen, wo, wie?“ → Besuch-Modul auf Start, Über uns und als CTA-Slot auf allen Unterseiten (keine eigene Seite).

## 2. Sitemap MVP (6 Seiten, flach – kein /besuch)
1. `/` Start (inkl. Besuch-Modul + Kontakt/Anfahrt)
2. `/eier` Freilandeier
3. `/kindernachmittage` Kindernachmittage
4. `/milch` Milch & Kühe
5. `/ackerbau` Ackerbau inkl. Wald & Obst
6. `/ueber-uns` Über uns / Unser Hof (Menschen + Familienbetrieb + Besuch-Modul + Kontakt)

Besuch-Modul (wiederverwendbar, keine eigene URL): Offene-Stalltür-Versprechen, Standort/Karte, ÖV Langnau/Emmenmatt, Parken/Fussweg, Verhaltenshinweise kurz, Kontaktwege, Eierkühlschrank-Box. Eingebettet auf Start + Über uns, als kompakter CTA-Slot auf Eier/Kindernachmittage/Milch/Ackerbau.

Globale Elemente: Header (Logo, Eier / Kindernachmittage / Milch / Ackerbau / Über uns, CTA „Vorbeikommen“ → Anker zum Besuch-Modul), Footer (Kontakt, Eierkühlschrank-Zeiten, Karte-Link, Impressum), Sticky CTA mobile: Kontakt.

Nicht MVP: Shop, Milchabholung, Geburtstage, News/Blog, Mehrsprachigkeit.

## 3. Seiten-Blöcke (Reihenfolge = Hierarchie)

### / Start – „Wer, was, darf ich kommen?“
Ziel: In 5s klar: Familienhof Emmental, Eier/Kinder/Milch/Ackerbau, offene Tür.
1. Hero: 1 grosses Hofbild [Platzhalter – Bildwahl TBD], H1 [Entwurf, TBD – z.B. „Familienhof im Emmental – zum Erleben“], Sub [TBD, 1 Satz], CTAs [TBD – Richtung: Eier / Kindernachmittage / Vorbeikommen, finale Formulierung offen]
2. Übernahme-Hinweis Eier ( prominent, für Bestandskunden): „Unsere Eierproduktion wurde von [Partner-Hof] übernommen – Eierkühlschrank, Abos und Qualität laufen weiter.“ + Link /eier. Kein „keine Abos“-Ton, sondern Kontinuität. [Text final TBD mit Partner-Hof]
3. 4er-Übersicht: Eier / Kindernachmittage / Milch / Ackerbau (inkl. Wald & Obst) – je Bild [Platzhalter] + 1 Satz + Link. **Gestaltung TBD – Varianten später mit impeccable (live/new-work): z.B. Cards vs. Bild-Liste vs. Split.**
4. Vertrauen Eier (neu formuliert): Was bleibt gleich + wer produziert jetzt (Partner-Hof nennen) + Link /eier [Text TBD]
5. Partnerschaften & Qualitäts-Labels (fester Vertrauens-Block): 4 Kacheln mit Logo, 1 Satz, externem Link (neuer Tab, rel noopener):
   - Stallvisite – Hof-Erlebnis & offene Stalltüren (Schweizer Bauernverband) → https://www.schweizerbauern.ch/bauernhof-erleben/ausfluege/stallvisite/
   - IP-Suisse – ganzheitliche nachhaltige Hof-Zertifizierung → https://www.ipsuisse.ch/
   - SEMAG – Saatvermehrung Pflanzkartoffeln → https://www.semag.ch/
   - Emmentaler AOP – Käserei-Rohmilchlieferant → https://www.emmentaler.ch/
6. Besuch-Modul (voll): „Kommt vorbei – offene Stalltür“ + Karte, ÖV Langnau/Emmenmatt, Parken, Kontakt
7. Menschen-Teaser: 3 Porträts, je Name/Rolle/1 Satz + Link /ueber-uns
8. Saisonaler Hinweis (manuell pflegbar, 1 Slot, Datei – kein CMS)

### /eier – Übergang transparent machen (keine eigene Produktion mehr)
1. Übernahme-Intro (für Bestandskunden zuerst): Bisher eigene Freilandeier (300 weiss + 300 braun, mobile Ställe) → neu: Produktion beim [Partner-Hof]. Warum Wechsel, seit wann, was bleibt garantiert gleich (Kühlschrank jederzeit bar/QR, Abos, B2B-Belieferung).
2. Neuer Produzent konkret: Wer, wo, Haltung (kurz, faktenbasiert), Link zum Partner-Hof falls vorhanden.
3. Wege zum Ei (unverändertKD): Privathaushalte/Abo-Interesse, Eierkühlschrank (jederzeit, bar/QR), Restaurants/Läden/Bäckereien
4. B2B-Block: Produkte, neue Herkunft transparent, Kontakt (Name/Tel/Mail), keine Preisliste nötig
5. Interesse-Formular (statt Abo): Name, Kontakt, Menge/Häufigkeit, Haushalt/Geschäft, Nachricht. Hinweis: Warteliste / Abklärung mit Partner-Hof, wir melden uns. Kein „keine Abos“-Banner.
6. FAQ kurz: Warum neuer Hof? Ändert sich Preis/Abholung/Zahlung? Woher kommen die Eier jetzt? Was passiert mit Hennen dort?

### /kindernachmittage – Alleinstellung
1. Intro: 1x monatlich, 3-10J, selbst erleben, Jahreszyklus
2. Was Kinder tun: Tiere, mitarbeiten, draussen bewegen, Beziehungen aufbauen
3. Jahreszyklus-Grafik/list: Frühling/Sommer/Herbst/Winter Beispiele (Apfel-Most, Kuh-Kalb)
4. Pädagogik-Vertrauen: Barbara (Lehrerin/Heilpädagogik) + Anne-Lea (Fachfrau Betreuung/Landwirtin), 2 Sätze je + Link /ueber-uns
5. Aktuelle Anmeldung: nächster Termin, Plätze, Ablauf/Zeit/Mitbringen/Kosten
6. Gruppen: Kindergarten/Schule/Gruppen, Themen-Nachmittage, Anfrage-Formular getrennt von Eier-Formular
7. Kompakter CTA-Slot Besuch-Modul (Anfahrt kurz + Kontakt)

### /milch – Milch & Kühe (eigene Seite)
1. Intro: 40 Milchkühe, Milch für echten Emmentaler aus dem Emmental
2. Haltung konkret: am Hof geboren/aufgezogen, grosser Freilaufstall, freie Bewegung/Liegen/Sonnen, Weide Frühling–Herbst, Fütterung frisches Gras
3. Alltag Einblick: kein Shop-Ton, eher Reportage (Melken, Weide, Kälber)
4. Kreislauf-Hinweis: Futter vom eigenen Acker → Link /ackerbau
5. Kompakter CTA-Slot Besuch-Modul

### /ackerbau – Ackerbau inkl. Wald & Obst (eigene Seite)
1. Intro: ca. 30 ha Gesamtfläche, Vielseitigkeit + Kreislauf des Betriebs
2. Acker/Futter: Grünland, Mais, Weizen, Futterproduktion für Kühe, Pflanzgutvermehrung/Saatkartoffeln
3. Waldwirtschaft: kurz, eigene Bewirtschaftung
4. Obst: Äpfel, Kirschen, Birnen + weitere Sorten (saisonal, z.B. Most-Thema → Link /kindernachmittage)
5. Kompakter CTA-Slot Besuch-Modul

### /ueber-uns – Über uns / Unser Hof (Menschen + Besuch + Kontakt)
1. Intro Familienbetrieb: persönlich, überschaubar, klare Verantwortlichkeiten
2. Je Person: Foto, Name, Rolle/Ausbildung, Verantwortungsbereich, persönlicher Motivationssatz.
   Fritz: Betriebsleiter, Meisterlandwirt. Barbara: Lehrerin Volks-/Heilpädagogik, Kindernachmittage. Anne-Lea: Fachfrau Kinderbetreuung, Landwirtin.
3. Geschichte/Motivation kurz
4. Besuch-Modul (voll): Offene Stalltür, Standort + Karte (embed), Adresse, Parken, ÖV Langnau/Emmenmatt, Fussweg, Verhaltenshinweise (Hunde, Stall, Kinder), Kontakt: Tel/Mail/Formular allgemein + getrennte Wege Eier / Kinder / Gewerbe, Eierkühlschrank-Box (jederzeit, bar/QR)

## 4. Formulare (MVP-Spec, Versand via PostHog / Mail)
- `eier-interesse`: Pflicht Name/Kontakt, optional Menge/Häufigkeit, Typ Haushalt/Geschäft, Nachricht. Success: „Danke, wir melden uns sobald…“. Spam-Schutz honeypot, kein Konto.
- `kinder-anmeldung`: Kind Name/Alter, Begleitung, Termin-Auswahl, Kontakt, Allergien/Bemerkung. Success + Mail an Barbara/Anne-Lea.
- `kontakt-allgemein` + `gewerbe`: Firma, Bedarf, Menge, Kontakt.
Alle: serverseitig validieren, DE-Fehlermeldungen, DS-Hinweis 1 Satz. Mails: Bestätigung an Absender + intern (PostHog als Mail-Tool), keine Marketing-Nutzung ohne Einwilligung.

## 5. Content-Regeln
- Konkret > werblich. Zahlen nennen (40 Kühe, 30 ha; Hühner-Zahlen nur noch historisch/Partner-Hof).
- Bildbedarf pro Seite: 1 Hero + 2-4 Alltag (Mensch+Tier, dokumentarisch). Kein Stock, kein Klischee-Filter. **Aktuell: Bildauswahl TBD – mit Platzhaltern arbeiten, finale Bilder kommen später.**
- Texte kurz, Ebenen vertiefbar. Keine Preislisten zum Start. H1/CTAs bewusst noch offen (TBD).
- Nicht erwähnen: Geburtstage, „keine Abos frei“, Milchabholung als Versprechen.

## 6. Technik / Constraints (Astro + Tailwind, kein CMS, PostHog)
- Astro statisch (SSG), `src/pages/` = Sitemap oben, `src/components/` für Besuch-Modul, Labels-Block, Cards, Formulare, `src/content/` für Texte/Termine (Dateien, kein CMS – Content ändert sich selten).
- Tailwind-Tokens aus DESIGN.md (Farben, Fonts, Radien), Bilder WebP/AVIF, Maps-Embed + ÖV-Links. Label-Logos als SVG/lokale Assets, externe Links neuer Tab.
- PostHog cookieless Analytics: keine Cookies, kein Banner nötig, aber Privacy-Hinweis in Footer/Datenschutz. Events: CTA-Klicks, Formular-Start/Erfolg, Label-Klicks. Keine PII im Analytics, IP-Anonymisierung an.
- PostHog/Mail-Versand für Formulare (Bestätigung + intern), honeypot, serverseitig validieren, DE-Fehlermeldungen.
- Responsive, a11y AA, SEO basics (Titel/Description DE-CH, OG-Bilder), Performance <2s.

## 7. Offene Punkte (brauche ich von dir)
- Eier-Übergabe: Name/Link Partner-Hof, Datum Wechsel, 2-3 Sätze Haltung dort, was bleibt gleich (Preis, Abholung, Zahlung)?
- Eierkühlschrank-Adresse/Zeiten, Kontaktpersonen Tel/Mail
- Nächste Kinder-Termine, Gruppengrössen, Kosten
- Fotos [TBD, Platzhalter ok]: Hof-Hero, Kühe/Weide, Kinder (Einwilligung), 3 Porträts, Eierkühlschrank; Hühnerbilder nur noch falls Partner-Hof liefert. Finale Bildsprache später mit echten Bildern.
- H1 + CTA-Formulierungen [TBD, Varianten später mit impeccable]
- 4er-Übersicht Gestaltung [TBD, Varianten später mit impeccable live/new-work]
- Label-Logos: Stallvisite / IP-Suisse / SEMAG / Emmentaler AOP als SVG/PNG + Freigabe
- PostHog: API-Host/Key, Mail-Absenderadresse/Domain
- Logo/Wunschfarben? Brief sagt warm/natürlich, serifenlos – sonst frei
- Hosting/Domain vorhanden?

Nächster Schritt: DESIGN.md (visuelle Welt) → Startseite new-work.
