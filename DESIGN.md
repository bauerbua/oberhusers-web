---
name: Hof Oberhusers
description: Burehof Oberhusers — handgezeichnete Kiesel, warmes Papier, offene Stalltür.
colors:
  chalk: "#FAF6EC"
  surface: "#FFFFFF"
  ink: "#593930"
  weide: "#ACC969"
  weide-tief: "#55702B"
  dotter: "#FFD222"
  dotter-ink: "#4E3121"
  altrosa: "#ECC4BE"
  altrosa-tief: "#DDB199"
  kastanie: "#7A4C3B"
  line: "#E6DFCB"
  tiefe: "#8C7B63"
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
  button-stamp:
    backgroundColor: "{colors.dotter}"
    textColor: "{colors.dotter-ink}"
    borderColor: "{colors.dotter}"
    shadow: "5px 6px 0 rgb(89 57 48 / 0.25)"
    rounded: "{rounded.control}"
  button-primary:
    backgroundColor: "{colors.weide}"
    textColor: "{colors.ink}"
    borderColor: "{colors.ink}"
    shadow: "5px 6px 0 rgb(89 57 48 / 0.22)"
    rounded: "{rounded.control}"
---

# Design System: Hof Oberhusers

## Overview

**Creative North Star: "Die Kieselmarke — ein Hof zum Anfassen"** *(Update 25.10.2026: auf die neue Identität von der Design-System-Abgabe [assets/oberhusers-design-system.pdf] umgestellt.)*

Die neue Identität kommt vom Logo: drei handgezeichnete Kiesel (Gelb-Huhn, Grün-Kleeblatt, Altrosa-Kuh) auf warmem Papier, dazu Wellenbänder mit Hühnern und feine Blumen-/Zweig-Doodles. Die Seite fühlt sich an wie ein hingesetzter Stempel-Ausflug auf den Hof: handgemacht und verspielt in **Typografie, Farbe und kleinen Stempeln** — aber ruhig und simpel in **Struktur und Layout**. PRODUCT.md und SHAPE.md bleiben gültig; die Verspieltheit lebt in Material und Details, nie in der Informationsarchitektur.

**Key Characteristics:**
- Warmes Papier statt Kaltkalk: cream-ground, braune Tusche statt Schwarz
- **Amatic SC als Display-Handschrift** (freie Nähe zur Schriftart der neuen Wortmarke), Arial als nüchterner Lauftext, Caveat bleibt die Kreide-Notiz
- Kiesel-Badges und Stempel mit hartem Papier-Schatten (wie im Logo: dunklere Kiesel hinter der bunten)
- Jede Sparte trägt ihre Kiesel-Farbe: Eier = Gelb (Huhn), Milch = Altrosa (Kuh), Ackerbau = Grün (Kleeblatt), Kindernachmittage = neutral (Chalk + braune Blumen-Doodles)
- Bilder zuerst, grosse gerundete Platten — die Verspieltheit kommt nie vor das Foto

**Referenz-Studie (Inspo, 25.10.2026):** Dirty Vine (Typo-first Hero, organischer Gelb-Blob auf der Bildkante, warmes Papier), Oliver Jeffers (handgezeichnete Headline-Welt, Hand-Print-Gefühl), Daptone Records (Folk-Art-Rahmen, Stempel und Plattenkultur), Chick-fil-A (verspielte Schrift-Hierarchie, Icon-Trio). Übernommen: Typo-first Hero, Blob auf der Bildkante, Stempel-Ästhetik, runde Icon-Formen. Nicht übernommen: Brutalismus (Beard Meats Food), Nachtfoto-Heroes (Huck).

## Colors

**Die Logo-Palette.** Die vier Farben stammen 1:1 aus dem Identitäts-PDF (RGB-Angaben der Vorlage): chromgelbes Gelb, sattes Wiesengrün, verwaschenes Altrosa — und als Tusche überall warmes Schokoladenbraun statt Schwarz. Das Papier (Chalk) wird wärmer, damit Gelb, Grün und Rosa auf ihm wie auf Packpapier sitzen.

### Brand (aus dem Identitäts-PDF)
- **Gelb** (#FFD222): die Huhn-Kiesel. Der eine intensive Ton — Aktionen, Stempel, Notiz-Pfeile.
- **Grün** (#ACC969): die Kleeblatt-Kiesel. Gefüllte Flächen (Buttons, Kiesel-Badges) mit **Braun-Text** — nie Weiss-Text auf Grün, der Kontrast trägt nicht.
- **Altrosa** (#ECC4BE): die Kuh-Kiesel. Zarte Panels und Kiesel-Tönung (Besuch-Modul), Polygon-Hover (`altrosa-tief` #DDB199).
- **Braun** (#593930): die Tusche. **Textfarbe, Linienfarbe, Doodle-Farbe, Icon-Striche** — alles, was gezeichnet ist, ist Braun. Kein Schwarz nirgends.

### System
- **Chalk** (#FAF6EC): Seitengrund — warmes MEHL-Papier statt Kaltkalk.
- **Surface** (#FFFFFF): Karten und Eingabefelder.
- **Weide tief** (#55702B): dunkler Oliv-Grün-Abkömmling — **Text-Grün** (Links, Fokusring, Hover-Füllungen): das Markt-Grün #ACC969 ist als Textfarbe auf Papier unlesbar und darf nur als Fläche auftreten.
- **Kastanie** (#7A4C3B): wärmeres Braun der Kreide-Notizen (Caveat).
- **Line** (#E6DFCB): feine Trennlinien und Rahmen im warmen Paperton.
- **Tiefe** (#8C7B63): Platzhalterton hinter Foto-Platten, warm statt grau.

### Named Rules
**The Stamp Rule.** Stempel — das sind gefüllte Aktionsflächen (Buttons, Sparten-Stempel) und Kiesel-Badges — tragen einen **harten Papier-Schatten** (`5px 6px 0` in Halbraun), wie ein aufgeklebter Aufkleber. Der harte Schatten ist ausschliesslich für Stempel und Kiesel-Badges erlaubt — jede andere Fläche bleibt flach.

**The Dotter Rule.** Dotter bleibt der eine intensive Ton: Hero-Stempel-CTA, Sparten-Stempel, Notiz-Pfeil und der eine Kiesel auf der Hero-Bildkante. Nie eine ganze Sektion als Dotter-Fläche und nie Dotter als Textfarbe auf Papier.

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

1. Die **H1** steht gross in Amatic auf dem Papier, links («Das isch üise Hof.» — ersetzt «Landwirtschaft zum Erleben.»). Rechts daneben: die Sub-Zeile (konkrete Fakten) + der **Gelb-Stempel-CTA** (gefüllt, leicht gedreht, harter Schatten) und die **Kreide-Notiz** zum Eier-Wechsel (Caveat + Dotter-Pfeil) in derselben Reihe — die Papierzone hält den Fold kompakt.
2. Darunter das grosse **Hof-Foto vollflächig** (100vw, kein Radius, `hero-foto: clamp(460px, 100svh − 360px, 800px)`): der letzte Bildschirm-Abschnitt gehört dem Bild, nicht der Schrift.
3. **Ein Gelb-Kiesel** brückt die Naht Papier → Bild (linke Kante, halb auf dem Foto, halb auf dem Papier, aria-hidden). Kein weiteres Text- oder Bildelement auf dem Foto — alles Obligatorische liegt oberhalb.
4. Die Sparten folgen als **abwechselnde Bild-Bänder** (Bestand, Stallgasse): grosses Foto + Textseite, kein Karten-Raster.

## Elevation & Depth

Flach als Prinzip, ausser: Stempel und Kiesel tragen den harten Papier-Schatten (Stamp Rule), das überlappende Porträt im Hero hat seinen weichen Ausnahmeschatten. Tiefe entsteht aus Farbe auf Papier, nicht aus Blur oder Layering.

## Shapes

Runde, ruhige Geometrie für Flächen: grosse Foto-Platten (36px), Bänder (24px), Boxen (20px), Bild-Innen (18px), Controls (14px). **Kiesel-Form** (`52% 48% 45% 55% / 60% 63% 37% 40%`) für Badges und Blob-Deko — niemals für Fotos. Wellen-Divider nur als offizielles Brand-Element (Wellenband mit Hühnern), gebraucht in gerade 1–2 Stellen pro Seite.

## Components

### Stempel-Buttons
- **Kiesel-Stempel (primär Aktion):** Dotter-Fläche, Dotter-Ink (Braun)-Text, 14px Radius, `rotate(-1.5deg)`, harter Schatten. Hover: dreht auf 0deg und schiebt sich in den Schatten (`translate` + Schatten schrumpft). Die eine gefüllte Aktion pro Hero.
- **Sparten-Stempel:** Dotter-Fläche, Braun-Text, optional 2px-Kontur; gleiches Dreh- und Schatten-Verhalten. Hover füllt Weide-Tief und stellt die Schrift auf Chalk.
- **Primary-Button (Formulare/Unterseiten):** Grün-Fläche, **Braun-Text** (nie Weiss auf Grün), 14px Radius, harter Schatten.
- **Zeilen-CTAs** (Nav, Teaser): Weide-Tief-Text mit Pfeil — kein Kasten; Fokus-Ring in Weide-Tief.

### Kiesel-Badge (Sparten-Identität)
- **Aufbau:** Kiesel-Form (uneben gerundet, leicht rotiert ±3–4deg), Füllung in der Sparten-Farbe (Eier Gelb, Kinder Chalk + 2px Braun-Ring, Milch Altrosa, Ackerbau Grün), dahinter der harte Schatten in Halbraun. Innen das Tier-Icon in Braun-Strich.
- **Einsatz:** oben links auf den Sparten-Fotos; sonst nirgends.
- **State:** Icons behalten ihre dezente Animations-Loops; beim Hover des Cards dreht der Kiesel auf 0deg.

### Wellen-Divider (Hennen-Wiese)
- **Aufbau:** SVG-Wellenband in Weide + braunner Haarlinie, 2–3 sitzende Hennen-Icons (bestehende Tier-Icons) leicht rotiert auf den Kuppen. `aria-hidden`.
- **Einsatz:** einmal vor dem Seitenabschluss; keine Wiederholung im Inhaltsbereich.

### Übernahme-Schildchen
- **Style:** Surface, 2px Line-Kontur, zwei Weide-Punkte links, 20px Radius — bleibt, Farben aktualisiert.

### Kreide-Notiz
- **Style:** Caveat 20px in Kastanie, 2px Unterstrich, `rotate(-1deg)`, Pfeil in Dotter. Hover hellt auf — die Drehung bleibt.

### Navigation
- **Style:** Sticky, transparent oben; ab 8px Scrollen legt sie Chalk mit Blur und Haarlinie unter. Lockup: gezeichnetes Stalltor (Weide-Tief) + Wortmarke in **Amatic 28px**. Links Arial 14px in Ink/70, CTA „Vorbeikommen" als Zeile in Weide-Tief. Touch-Ziele `min-h-[44px]`.

### Besuch-Modul
- **Style:** Panels auf einer **Altrosa-Tönung** (`from-altrosa/40 to-chalk`), 2px Line-Kontur, zwei Eck-Doodles (Zweig oben links, Blumen unten rechts, Braun-Strich, aria-hidden). Das ist das zarte Rosa-Panel der Seite — die eine weiche Sektion.

## Do's and Don'ts

### Do:
- **Do** die Palette 1:1 aus dem Identitäts-PDF verwenden (Gelb/Grün/Altrosa/Braun).
- **Do** die H1 in Amatic aufs Papier setzen und erst danach das grosse Hero-Foto zeigen.
- **Do** Stempel und Kiesel mit hartem Schatten und leichtem Drall zeigen (Stamp Rule).
- **Do** Grün als Textfarbe nur als Weide-Tief (#55702B) verwenden — nie das helle Mark-Grün.
- **Do** das Kind in der Tonart halten: drei Kiesel-Farben + neutrale Kinder-Sparte (Chalk + brauner Blumen-Doodle).
- **Do** das Wellen-Divider als offizielles Brand-Element einmal pro Seite setzen.
- **Do** Body, Label und Formulare in Arial lassen — die Verspieltheit kommt aus Titel/Farbe/Stempel.

### Don't:
- **Don't** Weiss-Text auf Grün oder Hellem setzen — Flächen mit Grün/Altrosa tragen Braun.
- **Don't** Amatic unter 20px oder für Lauftext/Buttons/Formulare einsetzen.
- **Don't** harte Offset-Schatten ausser auf Stempeln und Kiesel-Badges (Stamp Rule).
- **Don't** Wellen-Divider, Doodles und Blobs stapeln — jede Seite 1–2 verspielte Momente, nie mehr.
- **Don't** Kicker oder Eyebrows über Headlines (No-Kicker Rule).
- **Don't** ausser dem einen Hero-Kiesel Text auf das Hero-Foto legen.
- **Don't** Inhalte über `opacity: 0` verstecken — der Ruhezustand bleibt vollständig sichtbar.
- **Don't** Schwarz statt Braun, Stock-Fotos, Folklore-Kitsch oder Emoji statt gezeichneter Icons.
- **Don't** die Eier-Übergabe je als Banner mit „ausgebucht"-Ton formulieren.
