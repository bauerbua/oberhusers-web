# PRODUCT.md – Hof Oberhusers

## 1. Product
- **Name:** Hof Oberhusers
- **Type:** Website für Familien-Bauernhof im Emmental (Nähe Langnau / Emmenmatt)
- **Location:** `/Users/jakob/Projekte/oberhusers` (ehemals chinderhof)
- **Sprache:** Deutsch (Schweiz), persönlich, bodenständig, freundlich, nicht werblich
- **Plattform:** Web, responsiv (Mobile + Desktop). Stack: Astro + Tailwind, kein CMS, PostHog cookieless Analytics + Mail-Versand

## 2. Zweck
Digitales Schaufenster + offene Tür zum Hof. Kein Shop, keine Unternehmensseite.

Erfolg wenn Besucher denken:
> „Das ist ein Hof, den ich mir ansehen möchte. Die haben ein cooles, vielseitiges Angebot. Da fühlt man sich willkommen.“

Ziele:
- Bekanntheit + Vertrauen in der Region stärken
- Bestehende Kund*innen (v.a. Eier) emotional binden
- Zeigen wie / unter welchen Bedingungen produziert wird
- Interesse an Angeboten wecken
- Konkrete Anfragen + Vorbeikommen ermöglichen

## 3. Positionierung
**Vielseitiger Familienbetrieb im Emmental, der Landwirtschaft offen erlebbar macht.**

Bereiche:
- Eier (Übergabe!): bisher eigene Freilandeier (600 Hühner, mobil) → neu Produktion durch Partner-Hof. Wechsel für Bestandskunden transparent machen, Kontinuität (Kühlschrank, Abos, B2B) betonen.
- Milchvieh (40 Kühe, Freilaufstall, Weide, Emmentaler-Milch)
- Ackerbau / Futter / Saatkartoffeln (~30 ha), Wald, Obst (Apfel, Kirsche, Birne)
- Pädagogische Angebote für Kinder (Kindernachmittage)

Vertrauen / Labels (fester Home-Block):
- Stallvisite (Bauernverband), IP-Suisse, SEMAG, Emmentaler AOP – je Logo + 1 Satz + Link.

Differenzierung:
- Mobile Hühnerställe, Weide, transparente Produktion, Verwertung Hennen
- Offene Stalltüren – Besucher ausdrücklich willkommen
- Kindernachmittage als regionales Alleinstellungsmerkmal
- Menschen sichtbar, überschaubar, persönlich

## 4. Zielgruppen (priorisiert)
1. **Eierkund*innen privat (Prio 1):** Wechsel transparent kommunizieren („Was ändert sich für mich?“), Vertrauen halten, Kühlschrank/Abos als Kontinuität. Interesse-Formular weiterführen (ggf. mit Partner-Hof).
2. **Gewerbekund*innen (Prio 2):** Dorfläden, Bäckereien, Restaurants. Schnell sehen: Produkte, neue Herkunft (Partner-Hof), Kontakt.
3. **Familien mit Kindern 3-10J (Prio 3):** Kindernachmittage (1x monatlich) + Gruppen (Kindergarten, Schule). Pädagogische Qualität, Mitmachen, Jahreszyklus.
4. **Allgemein:** Menschen mit Landwirtschafts-Interesse aus Region Emmental.

## 5. Inhalte / Angebote
- **Eier (Übergabe):** bisher 300 weiss + 300 braun → neu Partner-Hof (Name TBD). Eierkühlschrank (jederzeit, bar/QR), Abos/B2B laufen weiter. Seite beantwortet: warum Wechsel, was bleibt gleich.
- **Kindernachmittage:** Konzept, Ablauf/Jahreszyklus, Anmeldung aktuell, Gruppenangebote (z.B. Vom Apfel zum Most, Kuh und Kalb)
- **Hof / Landwirtschaft:** Milchvieh, Ackerbau, Wald & Obst – kompakt, Kreislauf zeigen
- **Menschen:** Fritz (Betriebsleiter, Meisterlandwirt), Barbara (Lehrerin, Heilpädagogik, Kindernachmittage), Anne-Lea (Fachfrau Kinderbetreuung, Landwirtin) – je Foto, Funktion, Verantwortungsbereich, persönlicher Satz
- **Vorbeikommen:** Offene Stalltür CTA, Standort, ÖV, Karte, Besuchshinweise, Kontakt

## 6. Kernbotschaften (immer wieder)
1. Landwirtschaft darf erlebt werden.
2. Hinter dem Hof stehen Menschen.
3. Tiere werden sichtbar + nachvollziehbar gehalten (konkrete Fakten, keine Floskeln).
4. Der Hof ist vielseitig.
5. Regional verwurzelt (Emmental).

Tonalität: konkret statt Marketing. z.B. „Unsere 600 Hühner leben in mobilen Ställen…“ statt „nachhaltig mit höchstem Anspruch“.

## 7. UX-Prinzipien
- Gefühl: „Ich schaue auf einen echten Hof“
- Grosse authentische Bilder (Hof, Mensch, Tier, Alltag, dokumentarisch, kein Stock)
- Wenig Text auf erster Ebene, vertiefbar
- Klare Navigation, einfache Kontaktwege
- Keine Spielereien, dezente Animation max.
- Weniger ist mehr: Weissraum, klare Hierarchie, kurze Blöcke

## 8. IA (Stand SHAPE.md)
Start (inkl. Übernahme-Hinweis, Labels, Besuch-Modul) / Eier / Kindernachmittage / Milch / Ackerbau (inkl. Wald & Obst) / Über uns-Unser Hof (inkl. Besuch + Kontakt). Kein /besuch. Prominenter CTA: Offene Stalltür (Anker).

## 9. Funktionen MVP
- Eier-Übernahme-Box + Eier-Seite (Was bleibt / Was ändert sich, FAQ)
- Labels-Block Home (4 Kacheln + externe Links)
- Eier-Interesse-Formular: Name, Kontakt, Menge/Häufigkeit, Haushalt/Geschäft, Nachricht (kein „Jetzt abonnieren“)
- Kindernachmittage Anfrage/Anmeldung (Referenz: Hof Bisibiel)
- Kontakt + Anfahrt als Besuch-Modul (Maps, ÖV Langnau/Emmenmatt)
- PostHog cookieless Analytics (CTA/Form-Events, keine PII) + Mail-Versand für Formulare
- Später: Anfrage-Management, Webshop, Milchabholung

## 10. Non-Goals (bewusst NICHT)
- Keine Kindergeburtstage erwähnen
- Kein „keine Abos frei“-Banner
- Keine Bewerbung nicht-verfügbarer Angebote
- Kein Shop zum Start, kein überladener Agrar-Content
- Kein Bauernhof-Klischee, kein Folklore, keine Hintergrundmuster, keine Stockfotos, kein knallig/verspielt

## 11. Visuelle Richtung (für DESIGN.md)
- Schlicht, warm, hochwertig, modern, ruhig & klar
- Warme natürliche herzliche Töne, nicht knallig
- Schlicht serifenlos (Arial ok), evtl. dezente Handschrift-Akzente
- Viel Weissraum, grosse Bilder, einfache Navigation
- Herzlich + vertrauenswürdig + naturverbunden + modern + hochwertig gleichzeitig

---
Quelle: User-Brief 2026-10-04 (Website-Konzept Hof Oberhusers). Nächster Schritt: DESIGN.md + Surface-Briefs.
