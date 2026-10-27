---
name: Hof Oberhusers
description: Burehof Oberhusers — handgezeichnete Kiesel, warmes Papier, offene Stalltür.
colors:
  chalk: "#FAF6EC"
  gelb: "#FFD222"
  gruen: "#ACC969"
  altrosa: "#ECC4BE"
  braun: "#593930"
typography:
  display:
    fontFamily: "Amatic SC, Segoe Print, Comic Sans MS, cursive"
    fontWeight: 700
    letterSpacing: "0.02em"
  headline:
    fontSize: "36px/48px"
  body:
    fontFamily: "Arial, Helvetica, sans-serif"
    fontSize: "17px"
    lineHeight: 1.6
  lead:
    fontSize: "19px"
  meta:
    fontSize: "15px"
  label:
    fontSize: "14px"
  note:
    fontFamily: "Caveat, cursive"
    fontSize: "20px"
rounded:
  photo: "36px"
  band: "24px"
  box: "20px"
  inner: "18px"
  control: "14px"
  kiesel: "52% 48% 45% 55% / 60% 63% 37% 40%"
spacing:
  container: "1120px"
  section: "64px"
components:
  link-standalone:
    textColor: "{colors.braun}"
    blobColor: "{colors.gelb}"
    outline: "2px solid {colors.braun}"
  link-inline:
    textColor: "{colors.braun}"
    highlightColor: "{colors.gelb}"
    underline: "2px, offset 3px"
  button-primary:
    textColor: "{colors.braun}"
    fillColor: "{colors.gelb}"
    outline: "2px solid {colors.braun}"
    minHeight: "44px"
  button-ghost:
    textColor: "{colors.braun}"
    outline: "2px solid {colors.braun}"
    minHeight: "44px"
  input:
    backgroundColor: "{colors.chalk}"
    textColor: "{colors.braun}"
    borderColor: "color-mix(in srgb, {colors.braun} 60%, {colors.chalk})"
    rounded: "{rounded.box}"
    minHeight: "44px"
---

# Design System: Hof Oberhusers

## Overview

**Creative North Star: "Die Kieselmarke — ein Hof zum Anfassen"** *(Update 25.10.2026: auf die neue Identität von der Design-System-Abgabe [assets/oberhusers-design-system.pdf] umgestellt.)*

Die neue Identität kommt vom Logo: drei handgezeichnete Kiesel (Gelb-Huhn, Grün-Kleeblatt, Altrosa-Kuh) auf warmem Papier, dazu Wellenbänder mit Hühnern und feine Blumen-/Zweig-Doodles. Die Seite fühlt sich an wie ein hingesetzter Stempel-Ausflug auf den Hof: handgemacht und verspielt in **Typografie, Farbe und kleinen Stempeln** — aber ruhig und simpel in **Struktur und Layout**. PRODUCT.md und SHAPE.md bleiben gültig; die Verspieltheit lebt in Material und Details, nie in der Informationsarchitektur.

**Key Characteristics:**
- Warmes Papier statt Kaltkalk: cream-ground, braune Tusche statt Schwarz
- **Amatic SC als Display-Handschrift** (freie Nähe zur Schriftart der neuen Wortmarke), Arial als nüchterner Lauftext, Caveat bleibt die Kreide-Notiz
- Kiesel-Badges mit hartem Papier-Schatten (wie im Logo: dunklere Kiesel hinter der bunten); Links und Buttons tragen den Offset-Blob ohne Schatten
- Jede Sparte trägt ihre Kiesel-Farbe: Eier = Gelb (Huhn), Milch = Altrosa (Kuh), Ackerbau = Grün (Kleeblatt), Kindernachmittage = neutral (Chalk + braune Blumen-Doodles)
- Bilder zuerst, grosse gerundete Platten — die Verspieltheit kommt nie vor das Foto

**Referenz-Studie (Inspo, 25.10.2026):** Dirty Vine (Typo-first Hero, organischer Gelb-Blob auf der Bildkante, warmes Papier), Oliver Jeffers (handgezeichnete Headline-Welt, Hand-Print-Gefühl), Daptone Records (Folk-Art-Rahmen, Stempel und Plattenkultur), Chick-fil-A (verspielte Schrift-Hierarchie, Icon-Trio). Übernommen: Typo-first Hero, Blob auf der Bildkante, Stempel-Ästhetik, runde Icon-Formen. Nicht übernommen: Brutalismus (Beard Meats Food), Nachtfoto-Heroes (Huck).

## Colors

**Die Logo-Palette — genau fünf Tokens.** Mehr Farben gibt es nicht. Die Werte stammen 1:1 aus dem Identitäts-PDF (RGB-Angaben der Vorlage): chromgelbes Gelb, sattes Wiesengrün, verwaschenes Altrosa, warmes Schokoladenbraun als Tusche — und das wärmere Papier (Chalk), damit Gelb, Grün und Rosa wie auf Packpapier sitzen.

### Palette (die einzigen Farb-Tokens)
- **Chalk** (#FAF6EC): Seitengrund — warmes MEHL-Papier statt Kaltkalk. Auch Basis für Karten und Eingabefelder.
- **Gelb** (#FFD222): die Huhn-Kiesel. Der eine intensive Ton — Aktionen, Kiesel-Badges, Notiz-Pfeile.
- **Grün** (#ACC969): die Kleeblatt-Kiesel. Gefüllte Flächen (Buttons, Kiesel-Badges) mit **Braun-Text** — nie Weiss-Text auf Grün, der Kontrast trägt nicht.
- **Altrosa** (#ECC4BE): die Kuh-Kiesel. Zarte Panels und Kiesel-Tönung (Besuch-Modul).
- **Braun** (#593930): die Tusche. **Textfarbe, Linienfarbe, Doodle-Farbe, Icon-Striche** — alles, was gezeichnet ist, ist Braun. Kein Schwarz nirgends.

### Abgeleitete Varianten (keine eigenen Tokens)
Schattierungen, Rahmen und Hover-Töne werden **ausschliesslich aus den fünf Basis-Tokens gemischt** (`color-mix`), nie als neue Hex-Werte angelegt. Beispiele:
- **Text-Grün:** `color-mix(in srgb, var(--color-gruen) 70%, var(--color-braun))` — nur so darf Grün als Textfarbe auftreten.
- **Altrosa vertieft (Hover):** `color-mix(in srgb, var(--color-altrosa) 80%, var(--color-braun))`
- **Gedämpfter Text:** `color-mix(in srgb, var(--color-braun) 70%, var(--color-chalk))`
- **Trennlinien / Rahmen:** `color-mix(in srgb, var(--color-braun) 15%, var(--color-chalk))`
- **Karten/Inputs:** Chalk, bei Bedarf aufgehellt: `color-mix(in srgb, var(--color-chalk) 70%, white)`
- **Kreide-Notiz:** Braun, bei Bedarf leicht aufgehellt
- **Platzhalter hinter Fotos:** `color-mix(in srgb, var(--color-braun) 20%, var(--color-chalk))`
- **Harter Papier-Schatten:** `color-mix(in srgb, var(--color-braun) 25%, transparent)`

### Named Rules
**The Stamp Rule.** Nur Kiesel-Badges tragen einen **harten Papier-Schatten** (`5px 6px 0` in Halbraun, gemischt aus Braun), wie ein aufgeklebter Aufkleber. Links und Buttons tragen **keinen** Schatten — ihre Verspieltheit kommt aus dem Offset-Blob. Jede andere Fläche bleibt flach.

**The Gelb Rule.** Gelb bleibt der eine intensive Ton: primäre Aktionen, Kiesel-Badges, Notiz-Pfeil und der eine Kiesel auf der Hero-Bildkante. Nie eine ganze Sektion als Gelb-Fläche und nie Gelb als Textfarbe auf Papier.

**The Tusche Rule.** Alles Gezeichnete (Text, Doodles, Icon-Striche, Logo-Details) ist Braun #593930. Die Palette hat nur einen Brauton — Füllungen tragen die Farbe, Linien immer Braun.

## Typography

**Display Font:** Amatic SC (selbstgehostet via Fontsource, Gewichte 400/700; Gefühlsentscheid des Users als freie Nähe zur Marken-Handschrift **"A Day Without Sun Text"** [Zetafonts, kommerziell] — **TODO: sobald die Original-Schrift lizenziert/geliefert ist, 1:1 tauschen**)
**Body Font:** Arial (reine System-Schrift, kein Webfont-Download)
**Note Font:** Caveat (selbstgehostet via Fontsource, Schnitte 500/600 — Kreide-Notizen)

**Character:** Handgezeichnete, hoch gestreckte Display-Schrift für Hero, Überschriften und Wortmarke; nüchterne Arial für Lauftext; die Notiz bleibt Caveat. Amatic nur ab 20px — darunter zerbricht die Handschrift-Optik — mit `font-weight: 700` für Titel und 400 für dekorative Grossformen.

### Hierarchy
| Stufe | Size | Weight | Line-height | Einsatz |
|---|---|---|---|---|
| **Display** | `clamp(3.5rem, 11vw, 7rem)` | 700 | 0.95 | H1 des Hero, `text-wrap: balance` |
| **Headline** | 36px / 48px | 700 | 1.05 | Sektions-Titel (H2), Sparten-Namen |
| **Wordmark** | 28px | 700 | 1.0 | Wortmarke im Kopf — **nur dort** (kein Hero-Wiederholung: H1 trägt den Hofnamen) |
| **Body** | 17px | 400 | 1.6 | Lauftext, max. 60ch |
| **Lead** | 19px | 400 | 1.6 | Hero-Subzeile, Intro-Sätze |
| **Meta** | 15px | 400–700 | 1.5 | Footer, Bildunterschriften, Sekundärtext |
| **Label** | 14px | 700 | 1.0 | kleine Label in Arial (uppercase + `0.08em`), Buttons, Form-Felder |
| **Notiz** | 20px | 600 | 1.25 | Kreide-Notiz (Caveat), nur dort |

**Named Rules**
**The Amatic Rule.** Amatic nur für Display/Headline/Wortmarke; Body, Labels, Formulare und Button-Beschriftungen bleiben Arial — lesbar, nicht verspielt verkorst.
**The No-Kicker Rule.** Keine Eyebrow, kein Kicker über einer Headline — die Überschrift trägt sich selbst.

## Layout

Ein Container (1120px), 20/32px Ränder, grosszügige Sektions-Abstände (96–144px). Die Startseite ist **bildgeführt mit Wort über dem Bild (Referenzen Runde 2: Grass Roots Coop, Basic/Dept., Graza)**: Papierzone oben trägt H1 + CTA, darunter füllt das Hof-Foto den Rest des Folds — vollflächig, an den Seitenkanten blutend, ohne Radius. Mehr Luft über einer Überschrift als darunter; genau eine linke Achse.

### Hero (bildgeführt, 25.10.; User-Brief: füllendes Foto, CTA oberhalb des Bildes, simpel)

1. Die **H1** steht gross in Amatic auf dem Papier, links («Das isch üise Hof.» — ersetzt «Landwirtschaft zum Erleben.»). Rechts daneben: die Sub-Zeile (konkrete Fakten) + der **primäre Offset-Blob-CTA** (Blob in der Spartenfarbe, braune Linie versetzt, kein Schatten) und die **Kreide-Notiz** zum Eier-Wechsel (Caveat + Gelb-Pfeil) in derselben Reihe — die Papierzone hält den Fold kompakt.
2. Darunter das grosse **Hof-Foto vollflächig** (100vw, kein Radius, `hero-foto: clamp(460px, 100svh − 360px, 800px)`): der letzte Bildschirm-Abschnitt gehört dem Bild, nicht der Schrift.
3. **Ein Gelb-Kiesel** brückt die Naht Papier → Bild (linke Kante, halb auf dem Foto, halb auf dem Papier, aria-hidden). Kein weiteres Text- oder Bildelement auf dem Foto — alles Obligatorische liegt oberhalb.
4. Die Sparten folgen als **abwechselnde Bild-Bänder** (Bestand, Stallgasse): grosses Foto + Textseite, kein Karten-Raster.

## Elevation & Depth

Flach als Prinzip, ausser: Kiesel-Badges tragen den harten Papier-Schatten (Stamp Rule); Links und Buttons nutzen den Offset-Blob ohne Schatten. Das überlappende Porträt im Hero hat seinen weichen Ausnahmeschatten. Tiefe entsteht aus Farbe auf Papier, nicht aus Blur oder Layering.

## Shapes

Runde, ruhige Geometrie für Flächen: grosse Foto-Platten (36px), Bänder (24px), Boxen (20px), Bild-Innen (18px), Controls (14px). **Kiesel-Form** (`52% 48% 45% 55% / 60% 63% 37% 40%`) für Badges und Blob-Deko — niemals für Fotos. **Offset-Blob-Formen** für Links und Buttons: drei feste Paare `--f1`/`--o1`, `--f2`/`--o2`, `--f3`/`--o3` — Füllung und Linie weichen absichtlich voneinander ab, nie zufällige Werte. Wellen-Divider nur als offizielles Brand-Element (Wellenband mit Hühnern), gebraucht in gerade 1–2 Stellen pro Seite.

## Components

### Links & Buttons (Offset-Blob)

Gemeinsames Formsystem: Farb-Blob und braune Linie liegen absichtlich nicht deckungsgleich — der Blob sitzt nach rechts unten, die Linie nach links oben, wie ein leicht versetzt gedrucktes Etikett (Vorbild: Logo-Abzeichen). Die Formen kommen aus drei festen Paaren `.s1`/`.s2`/`.s3` (Füllung `--f`, Linie `--o`); die Farbe wird pro Element über `--c` aus den fünf Palette-Tokens gesetzt. Benachbarte Elemente wechseln das Set. Kein Schatten, keine zusätzlichen Effekte.

- **Textlink `.lk`** (Navigation, Fusszeile, kurze Labels): ruhend unsichtbar; bei Hover und `:focus-visible` erscheinen Blob (Spartenfarbe) und Braun-Linie, leicht versetzt. Kein Kasten.
- **Inline-Link `.il`** (im Lauftext): ruhend 2px untermalt; bei Hover/Fokus liegt ein flacher Farb-Streifen hinter der unteren Texthälfte. `box-decoration-break: clone` hält ihn bei Zeilenumbrüchen korrekt.
- **Primär-Button `.btn`**: Blob und Linie ruhend sichtbar und versetzt; Hover/Fokus bewegen sie zueinander, `:active` rastet beide deckungsgleich ein. Braun-Text, 44px Touch-Ziel. Genau eine primäre Aktion pro Ansicht.
- **Sekundär-Button `.btn-ghost`**: ruhend nur die Linie; der Farb-Blob erscheint bei Hover/Fokus.
- **Fokus:** Jede Komponente hat ihren eigenen Fokus-Status (Blob/Linie bzw. schwerere 3px-Linie); der transparente Outline bleibt für den Forced-Colors-Modus. Kein zusätzlicher Aussenring.
- **Bewegung:** Hover-Regeln nur unter `@media (hover: hover)`; `prefers-reduced-motion: reduce` schaltet alle Übergänge ab.
- **Abstände:** Die Formen ragen über das Element hinaus — benachbarte Links/Buttons mit ca. `gap-x-6` setzen.
- **Farbzuordnung:** Gelb = Eier, Grün = Ackerbau & Kindernachmittage, Altrosa = Milch, Menschen & Kontakt.

### Form-Felder

Ein System für alle Eingaben (Text, E-Mail, Telefon, Datum, Select, Textarea) — Arial, nie Amatic.

- **Struktur:** Jedes Feld sitzt in `.field` (Label über dem Control, ~6px Abstand). Labels: 14px/700, uppercase, `0.08em` Laufweite, Braun.
- **Ruhezustand:** Chalk-Fläche, 2px Braun-Rahmen (`color-mix` Braun 60% + Chalk, 3.25:1), **20px Radius** (Box-Token, bewusst runder als die alten 14px-Controls — passt zu Kiesel und Offset-Blob), `min-height: 44px`, 16px Arial in Braun. Select bekommt denselben Rahmen plus braunen Chevron (native Pfeil ersetzt, damit die Form auf allen Plattformen gleich sitzt).
- **Platzhalter:** Braun 75% + Chalk (4.77:1) — lesbar, aber klar sekundär.
- **Fokus:** globaler 3px-Braun-Outline mit 2px Abstand; der Rahmen dunkelt zusätzlich auf volles Braun. Der Übergang (200ms) startet mit **80ms Verzögerung**, `prefers-reduced-motion: reduce` schaltet ihn ab. Der Feld-Radius bleibt (kein Snap auf einen anderen Radius).
- **Fehler:** `[aria-invalid="true"]` oder `:user-invalid` (greift erst nach Interaktion) → voller Braun-Rahmen + Altrosa-Tönung (`color-mix` Altrosa 35% + Chalk). Die Meldung (`.field-error`, 14px/700 in Braun) steht im `.field`, ist per `aria-describedby` mit dem Feld verbunden und wird per `:has(:user-invalid)` eingeblendet — nie nur Farbe. Die native Validierung bleibt als Fallback aktiv.
- **Aktion:** Submit ist ein `.btn` in der Spartenfarbe (Kindernachmittage = Grün), `type="submit"`.
- **Deaktiviert:** 55% Deckkraft, `not-allowed`.
- **Checkbox/Radio:** `accent-color` Braun; die Klickfläche liefert das umschliessende Label.
- **Keine** eigenen Schatten, Verläufe oder zusätzlichen Farben — der Fehlerzustand nutzt Altrosa aus der Palette, kein Rot.

### Kiesel-Badge (Sparten-Identität)
- **Aufbau:** Kiesel-Form (uneben gerundet, leicht rotiert ±3–4deg), Füllung in der Sparten-Farbe (Eier Gelb, Kinder Chalk + 2px Braun-Ring, Milch Altrosa, Ackerbau Grün), dahinter der harte Schatten in Halbraun. Innen das Tier-Icon in Braun-Strich.
- **Einsatz:** oben links auf den Sparten-Fotos; sonst nirgends.
- **State:** Icons behalten ihre dezente Animations-Loops; beim Hover des Cards dreht der Kiesel auf 0deg.

### Wellen-Divider (Hennen-Wiese)
- **Aufbau:** SVG-Wellenband in Grün + brauner Haarlinie, 2–3 sitzende Hennen-Icons (bestehende Tier-Icons) leicht rotiert auf den Kuppen. `aria-hidden`.
- **Einsatz:** einmal vor dem Seitenabschluss; keine Wiederholung im Inhaltsbereich.

### Übernahme-Schildchen
- **Style:** Chalk, 2px braune Kontur (`color-mix` Braun + Chalk), zwei grüne Punkte links, 20px Radius — bleibt, Farben aktualisiert.

### Kreide-Notiz
- **Style:** Caveat 20px in Braun, 2px Unterstrich, `rotate(-1deg)`, Pfeil in Gelb. Hover hellt auf — die Drehung bleibt.

### Navigation
- **Style:** Sticky, transparent oben; ab 8px Scrollen legt sie Chalk mit Blur und Haarlinie unter. Lockup: gezeichnetes Stalltor (Braun) + Wortmarke in **Amatic 28px**. Links Arial 14px in Braun/70, CTA „Vorbeikommen" als Zeile in Braun. Touch-Ziele `min-h-[44px]`.

### Besuch-Modul
- **Style:** Panels auf einer **Altrosa-Tönung** (`from-altrosa/40 to-chalk`), 2px braune Kontur (`color-mix` Braun + Chalk), zwei Eck-Doodles (Zweig oben links, Blumen unten rechts, Braun-Strich, aria-hidden). Das ist das zarte Rosa-Panel der Seite — die eine weiche Sektion.

## Do's and Don'ts

### Do:
- **Do** die Palette 1:1 aus dem Identitäts-PDF verwenden (Gelb/Grün/Altrosa/Braun).
- **Do** die H1 in Amatic aufs Papier setzen und erst danach das grosse Hero-Foto zeigen.
- **Do** Kiesel-Badges mit hartem Schatten und leichtem Drall zeigen (Stamp Rule).
- **Do** Grün nur als Fläche verwenden; Text-Grün ausschliesslich als abgedunkelte Mischung (`color-mix` Grün + Braun) — nie das helle Mark-Grün.
- **Do** das Kind in der Tonart halten: drei Kiesel-Farben + neutrale Kinder-Sparte (Chalk + brauner Blumen-Doodle).
- **Do** das Wellen-Divider als offizielles Brand-Element einmal pro Seite setzen.
- **Do** Body, Label und Formulare in Arial lassen — die Verspieltheit kommt aus Titel/Farbe/Stempel.

### Don't:
- **Don't** Weiss-Text auf Grün oder Hellem setzen — Flächen mit Grün/Altrosa tragen Braun.
- **Don't** Amatic unter 20px oder für Lauftext/Buttons/Formulare einsetzen.
- **Don't** harte Offset-Schatten ausser auf Kiesel-Badges (Stamp Rule).
- **Don't** Wellen-Divider, Doodles und Blobs stapeln — jede Seite 1–2 verspielte Momente, nie mehr.
- **Don't** Kicker oder Eyebrows über Headlines (No-Kicker Rule).
- **Don't** ausser dem einen Hero-Kiesel Text auf das Hero-Foto legen.
- **Don't** Inhalte über `opacity: 0` verstecken — der Ruhezustand bleibt vollständig sichtbar.
- **Don't** Schwarz statt Braun, Stock-Fotos, Folklore-Kitsch oder Emoji statt gezeichneter Icons.
- **Don't** die Eier-Übergabe je als Banner mit „ausgebucht"-Ton formulieren.
