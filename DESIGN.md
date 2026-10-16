---
name: Hof Oberhusers
description: Familienhof im Emmental — offene Stalltür als Gefühl.
colors:
  paper: "#FAF6EE"
  ink: "#2A2620"
  pine: "#2F4A3C"
  stall: "#33523F"
  holz: "#9C6B43"
  holz-dunkel: "#6E4A2C"
  clay: "#B08968"
  sage: "#7D8C6F"
  sun: "#E9C46A"
  line: "#E7DFD2"
typography:
  display:
    fontFamily: "Archivo Variable, system-ui, sans-serif"
    fontWeight: 800
    letterSpacing: "-0.02em"
  body:
    fontFamily: "system-ui, -apple-system, Segoe UI, Arial, sans-serif"
    fontSize: "16px"
    lineHeight: 1.6
  hand:
    fontFamily: "Caveat, cursive"
rounded:
  band: "24px"
  box: "20px"
  inner: "18px"
  control: "12px"
spacing:
  container: "1120px"
  section: "64px"
components:
  button-primary:
    backgroundColor: "{colors.pine}"
    textColor: "{colors.paper}"
    rounded: "{rounded.control}"
  button-outline:
    backgroundColor: "{colors.paper}"
    textColor: "{colors.holz-dunkel}"
    rounded: "{rounded.control}"
---

# Design System: Hof Oberhusers

## Overview

**Creative North Star: "The Open Stable Door"**

Die Seite fühlt sich an wie ein Hof, dessen Tür offen steht: ruhige, helle Flächen, Holz- und Stallgrün-Anklänge, echte Bilder zuerst. Nichts ruft, alles lädt ein. Sparten tragen Tier-Identitäten (Huhn, Hund, Kuh, Apfel), die dezent lebendig sind; Vertrauen entsteht durch Stempel, Daten und Menschen statt durch Behauptungen.

**Key Characteristics:**
- Warm, ruhig, einladend — nie laut, nie rustikal-kitschig
- Bildgeführt: Hof und Besitzerinnen stehen am Anfang
- Handgemachte Details: Stempel, Kreide-Notizen, Holzbalken-Regeln

## Colors

Warme Papierwelt mit Holzbraun und Stallgrün; ein Honig-Akzent für Lichtstimmung.

### Primary
- **Stall Pine** (#2F4A3C): Primäraktionen, Stempel, Fokus. Ruhiges, tiefes Grün.
- **Barn Wood** (#9C6B43): Balken-Regeln, Rahmen, Icon-Bühnen. Warmes Holzbraun.
- **Dark Beam** (#6E4A2C): Rahmen, Trennregeln, Nieten-Details.

### Secondary
- **Honey Sun** (#E9C46A): Lichtstimmung (Verläufe, Besuch-Panel). Nie flächig, nie Text.
- **Clay Note** (#B08968): Handschrift-Farbe für Kreide-Notizen.
- **Sage Leaf** (#7D8C6F): Apfel-Blatt und pflanzliche Details in Icons.

### Neutral
- **Warm Paper** (#FAF6EE): Seitengrund überall.
- **Stable Ink** (#2A2620): Text, Icon-Striche, Scrim über Fotos.
- **Stall Line** (#E7DFD2): Feine Trennlinien, Platzhalter-Flächen.
- **Barn Shadow** (#7C6A57): Platzhalterton hinter dem Hero-Foto. Bewusst dunkler als das Foto — er soll als Tiefe wirken, nicht als braune Karte.

### Named Rules
**The Stamp Rule.** Pine gehört Aktionen und Stempeln; auf keiner Fläche liegt Pine dekorativ. Seine Seltenheit ist der Point.

## Typography

**Display Font:** Archivo Variable (selbstgehostet, 118% Breite) mit System-Fallback
**Body Font:** System-Grotesk (mit Arial)
**Label/Mono Font:** Caveat (nur handschriftliche Mini-Notizen)

**Character:** Breite Arbeits-Schrift für Titel, nüchterne System-Schrift für Text, ein Hauch Handschrift für Menschlichkeit.

### Hierarchy
Jede Stufe ist eine echte Klasse; kein Wert ausserhalb dieser Liste wird als Ausnahme gesetzt.

| Stufe | Size | Weight | Line-height | Einsatz |
|---|---|---|---|---|
| **Display** | `clamp(2rem, 9vw, 4.25rem)` | 800 | 1.02 | H1 des Hero, eng gesetzt (`-0.035em`), `text-wrap: balance` |
| **Headline** | 30px / 24px | 800 | 1.1 | Sektions-Titel (H2), Sparten-Namen |
| **Wordmark** | 22px | 800 | 1.0 | Wortmarke im Kopf, nur dort |
| **Body** | 17px | 400 | 1.6 | Lauftext, 52ch Subzeile im Hero, max. 60ch sonst |
| **Lead** | 19px | 400 | 1.6 | Subzeile des Hero auf Desktop |
| **Meta** | 15px | 400–700 | 1.5 | Footer, Bildunterschriften, Sekundärtext |
| **Label** | 14px | 700 | 1.0 | Navigation, uppercase + `0.05em` tracking für Stempel und Buttons |
| **Notiz** | 20px | 600 | 1.25 | Kreide-Notiz (Caveat), nur dort |

**Named Rule.** Die Wortmarke ist eine eigene Stufe und lebt nur im Kopf. Sie wird nie
in gleicher Grösse im Hero wiederholt: der Hero-H1 trägt den Hofnamen, der Kopf führt ihn
als Signatur mit (22px gegen 68px). Konkurrieren zwei gleiche Namen im ersten Blick,
sucht das Auge keiner von beiden – es liest sie als einen.

### Named Rules
**The No-Kicker Rule.** Keine Eyebrow, kein Kicker über einer Headline — die Überschrift trägt sich selbst.

## Layout

Ein Container (1120px), 20/32px Ränder, grosszügige Sektions-Abstände (64–96px). Die Startseite folgt der Stallgasse: H1-Brett, Hero-Bild, Schildchen, dann vier Bänder im Wechsel (Bild links/rechts), Marken-Zeile, Besuchs-Panel. Mehr Luft über einer Überschrift als darunter.

### Die linke Achse

Der Text der gesamten Seite steht in derselben 1120er-Spalte — Kopf, Hero-H1, Sektions-Titel, Footer. Es gibt genau eine linke Kante. Das Hero-Foto ist das einzige Element, das über diese Spalte hinausragt: es geht über die Textbreite hinaus bis auf `12px` (mobil) beziehungsweise `20px` (md) an den Viewport-Rand, mit 26px Radius und ohne Schatten. Diese eine Ausnahme ist der Grund, warum das Bild wirkt; ohne sie wirkt es zufällig. Ein Vollbild ist es bewusst nicht — der schmale Papierrand fasst das Foto und hält es im selben Blatt wie die Schrift.

### Hero

**Erst die Schrift, dann das Bild. Das Foto ist der ruhige Anker unter der Einladung.**

- Oben spannt sich das Foto als gerahmte Platte: `mx-3` (`md:mx-5`), 26px Radius, `clamp(400px, 64vh, 680px)`, `object-position: 50% 34%` (mobil `58% 30%`). Kein Text auf dem Bild, kein Scrim, kein Rahmen aus Holz.
- Darüber in der 1120er-Spalte, jede Ebene eine eigene Zeile: **H1** (20ch, `text-wrap: balance`), darunter die **Subzeile** (52ch, 17/19px), darunter ein **Handlungsband** über einer Haarlinie.
- **Die H1 nennt den Hof und das Versprechen:** „Hof Oberhusers. Tür offen." Der Name steht in der grössten Schrift der Seite, das Versprechen im selben Atemzug. Die Subzeile trägt die Einladung und die Fakten (Freilandeier, 40 Kühe, Acker, Wald, Obst); der Name wird nicht wiederholt, die Zahlen auch nicht.
- Das Handlungsband trägt links genau **einen** Primär-CTA als ruhige unterstrichene Zeile mit Pfeil, nie als Kasten; rechts den zweiten Weg (Eier) als **Kreide-Notiz**, kein zweiter Button. Auf `sm` liegen beide auf einer Grundlinie, mobil gestapelt.
- **Nichts ist über eine Animation versteckt.** Der Ruhezustand ist vollständig sichtbar; animiert wird allein das Handlungsband, und auch das nur über `transform`. Mit `animation-fill-mode: both` und `opacity: 0` blieb das Hero-Bild in Headless, Print und bei deaktivierter Animation leer.

**Warum die Schrift über dem Bild und nicht darauf:** die Einladung zuerst zu lesen macht den Hof zum Ziel, nicht zum Hintergrund; das Foto antwortet darunter in voller Ruhe und trägt die Stimmung, ohne dass Schrift auf den Kälbern liegt. Der erste Blick bleibt das Bild, der erste Satz die Handlung.

## Elevation & Depth

Flach als Prinzip: Tiefe entsteht durch warme Farbverläufe (Sonnenlicht) und Holz-Rahmen, nicht durch Schatten. Eine Ausnahme: das überlappende Besitzerinnen-Porträt im Hero ruht mit einem weichen Standardschatten.

## Shapes

Runde, ruhige Geometrie: Bänder und Panels (24px), Boxen (20px), Bild-Innen (18px), Controls eckiger (12px). Tür- und Brett-Motive nur als Rahmen und Regeln, nie als Clip-Path-Deko.

## Components

### Buttons
- **CTAs sind Zeilen, keine Kästen.** Der Hero-CTA ist Pine auf Papier: 17px fett, Haarlinie (`1px`, 7px Abstand), Pfeil, `min-height: 48px`. Der Nav-CTA ist Pine-Text mit Pfeil, ohne Fläche.
- **Primary:** Pine-Fläche, Papier-Text, uppercase, fett. Reserviert für Formulare und Unterseiten — nie im Hero.
- **Hover / Focus:** Fokus-Ring in Clay (3px, 2px Offset, 12px Radius). Kein Bewegungs-Feuerwerk.
- **Secondary:** Papier-Fläche, Holz-Kontur, Holz-Text; Hover füllt Pine.

### Stempel-Labels
- **Style:** Papier, 2.5px Pine-Kontur, leicht gedreht (±1deg), uppercase Meta-Zeile.
- **State:** Hover richtet auf (0deg).

### Stallgasse-Band
- **Corner Style:** Icon-Bühne 24px, sonst offene Kanten mit 4px Balken-Regeln oben/unten.
- **Background:** Papier; Icon-Bühne mit Sonnen-Verlauf (40→60% bei Hover).
- **Internal Padding:** 32–40px vertikal, Icon-Bühne 160–176px.

### Tier-Icons
- **Style:** Einheitliche 3px Kontur in Ink, Weiss-Flächen, je ein Farb-Akzent (Kamm, Ohr, Blatt).
- **State:** Dezent animiert (Picken 4.2s, Wedeln 1.6s, Ohrzucken 6s, Wiegen 3.8s); ohne Motion-Einstellung statisch.

### Übernahme-Schildchen
- **Style:** Papier, 2px Holz-Kontur, zwei Nieten-Punkte links, 12px Radius.

### Kreide-Notiz
- **Style:** Caveat 20px in Holz-Dunkel, 2px Unterstrich, `rotate(-1deg)`. Der Pfeil in Honey Sun.
- **Zustand:** Hover hellt Schrift und Pfeil auf, richtet sich nicht auf — die Drehung bleibt, sie gehört zum Notiz-Charakter.

### Navigation
- **Style:** Sticky, oben **transparent** (keine Fläche, keine Linie — Teil des Heros, nicht eine Leiste davor). Erst ab 8px Scroll (`nav-scrolled`) legt sie Papier mit Blur unter und zieht die Holz-Linie; ohne JavaScript steht sie sofort solid (`<noscript>`). Lockup aus gezeichnetem Stalltor (Pine) + Wortmarke (22px), 14px Links, CTA „Vorbeikommen" als Pine-Text mit Pfeil — kein Kasten. Touch-Ziele `min-h-[44px]`.

## Do's and Don'ts

### Do:
- **Do** Bilder vom echten Hof und echte Menschen an den Anfang stellen (Platzhalter nur bis Ersatz da ist).
- **Do** das Hero-Foto seitlich fassen (`12px` / `md: 20px` Papierrand, 26px Radius) — der Rahmen hält es im selben Blatt wie die Schrift.
- **Do** den Kopf oben transparent lassen und ihn erst beim Scrollen zur Leiste machen.
- **Do** Pine sparsam und nur für Aktion und Stempel nutzen (Stamp Rule).
- **Do** Tier-Icons in einer Strichstärke und einem Animations-Loop pro Tier halten.
- **Do** Türen nur dort zeigen, wo sie helfen (Besuch, Details) — Gefühl statt Deko.

### Don't:
- **Don't** Kicker oder Eyebrows über Headlines setzen (No-Kicker Rule).
- **Don't** Inhalte über `animation-fill-mode: both` + `opacity: 0` verstecken — der Ruhezustand ist immer vollständig sichtbar.
- **Don't** den Hero-CTA als Kasten bauen — er bleibt eine unterstrichene Zeile.
- **Don't** das Hero-Foto als Vollbild über die ganze Breite ziehen — der Papierrand gehört dazu.
- **Don't** Stock-Fotos, Folklore oder knallige Flächen verwenden (Brief-Ban).
- **Don't** harte Offset-Schatten ausserhalb der einen Portrait-Ausnahme nutzen.
- **Don't** Emoji oder Unicode-Zeichen statt gezeichneter Icons verwenden.
- **Don't** die Eier-Übergabe je als Banner mit „ausgebucht"-Ton formulieren.
