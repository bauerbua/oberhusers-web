---
name: Hof Oberhusers
description: Familienhof im Emmental — offene Stalltür als Gefühl.
colors:
  chalk: "#F2F5F0"
  surface: "#FFFFFF"
  ink: "#15211A"
  weide: "#2C6A46"
  weide-tief: "#1B452D"
  dotter: "#FFC61A"
  dotter-ink: "#241B00"
  kastanie: "#8A6A3A"
  line: "#DCE4DA"
  tiefe: "#798675"
typography:
  display:
    fontFamily: "Fraunces Variable, Georgia, serif"
    fontWeight: 800
    letterSpacing: "-0.015em"
  headline:
    fontSize: "30px"
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
  control: "12px"
spacing:
  container: "1120px"
  section: "64px"
components:
  button-primary:
    backgroundColor: "{colors.weide}"
    textColor: "{colors.chalk}"
    rounded: "{rounded.control}"
  button-stamp:
    backgroundColor: "{colors.dotter}"
    textColor: "{colors.dotter-ink}"
    borderColor: "{colors.dotter}"
    rounded: "{rounded.control}"
---

# Design System: Hof Oberhusers

## Overview

**Creative North Star: "The Open Stable Door"**

Die Seite fühlt sich an wie ein Hof, dessen Tür offen steht: ruhige, helle Kalkflächen, Weidegrün und ein chromgelber Akzent, echte Bilder zuerst. Nichts ruft, alles lädt ein. Sparten tragen Tier-Identitäten (Huhn, Hund, Kuh, Apfel), die dezent lebendig sind; Vertrauen entsteht durch Stempel, Daten und Menschen statt durch Behauptungen.

**Key Characteristics:**
- Warm, ruhig, einladend — nie laut, nie rustikal-kitschig
- Bildgeführt: Hof und Besitzerinnen stehen am Anfang
- Handgemachte Details: Stempel, Kreide-Notizen, Weide-Regeln
- Ein Akzent, kein Feuerwerk: das Gelb der Ohrmarke bleibt knapp

## Colors

**Hofschild Chrom.** Die Palette kommt aus den eigenen Fotos: die weisse Kalkwand, das Weidegras, das warme Stroh — und die chromgelbe Ohrmarke am Kalb, die einzige Stelle, an der der Hof wirklich laut ist. Zwei Grüntöne tragen die Seite, ein Gelb setzt den Akzent, ein warmes Braun schreibt von Hand.

### Primary
- **Weide** (#2C6A46): Aktionen, Regeln, Stempel-Konturen, Fokusring. Das ruhige Grün der Weide — die Stimme des Hofs.
- **Weide tief** (#1B452D): der dunklere Zwilling. Nur für den Hover der Sparten-Stempel; sonst nirgends.
- **Kastanie** (#8A6A3A): Handschrift der Kreide-Notizen und warme Tier-Details (Ohren, Ruten, Blattstiel). Erdiger als das Grün, nie Text auf einem Foto.

### Accent
- **Dotter** (#FFC61A): die chromgelbe Ohrmarke. Der einzige intensive Ton — er trägt die Icon-Bühnen (Verlauf), die gefüllten Sparten-Stempel und den Pfeil der Kreide-Notiz.
- **Dotter Ink** (#241B00): die Schrift auf gefüllten Dotter-Flächen (Sparten-Stempel). Nie Dotter als Textfarbe auf Kalk.

### Neutral
- **Chalk** (#F2F5F0): Seitengrund überall — gekalkt, nicht steril.
- **Surface** (#FFFFFF): Karten und Eingabefelder, die sich vom Kalk abheben.
- **Ink** (#15211A): Text, Icon-Striche, Scrim über Fotos.
- **Line** (#DCE4DA): feine Trennlinien und Rahmen.
- **Tiefe** (#798675): Platzhalterton hinter dem Hero-Foto. Bewusst dunkler als das Foto — er soll als Tiefe wirken, nicht als graue Karte.

### Named Rules
**The Stamp Rule.** Weide gehört Aktionen, Regeln und Stempel-Konturen; auf keiner Fläche liegt Weide dekorativ. Seine Seltenheit ist der Point.

**The Dotter Rule.** Dotter ist der eine intensive Ton und bleibt darum knapp: Icon-Bühne, gefüllter Sparten-Stempel, Pfeil der Kreide-Notiz. Dotter trägt nie eine ganze Sektion als Fläche und nie Text auf Kalk.

## Typography

**Display Font:** Fraunces Variable (selbstgehostet via Fontsource, Gewichts-Achse 100–900) mit Georgia-Fallback
**Body Font:** Arial (reine System-Schrift, kein Webfont-Download)
**Label/Mono Font:** Caveat (selbstgehostet via Fontsource, Schnitte 500/600 — nur handschriftliche Mini-Notizen)

**Character:** Warme, weiche Serif für Titel, nüchterne Arial für Text, ein Hauch Handschrift für Menschlichkeit. Alles selbst gehostet: Titel und Handschrift werden via Fontsource gebündelt und von der eigenen Domain geliefert, nur der Lauftext ist System-Arial — kein Fremd-Request.

### Hierarchy
Jede Stufe ist eine echte Klasse; kein Wert ausserhalb dieser Liste wird als Ausnahme gesetzt.

| Stufe | Size | Weight | Line-height | Einsatz |
|---|---|---|---|---|
| **Display** | `clamp(2rem, 9vw, 4.25rem)` | 800 | 1.02 | H1 des Hero, leicht eng gesetzt (`-0.015em`), `text-wrap: balance` |
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

Ein Container (1120px), 20/32px Ränder, grosszügige Sektions-Abstände (96–144px). Die Startseite ist eine Folge grosser, gerundeter Bildplatten: Hero, Schildchen, vier Sparten-Bänder im Wechsel (Bild links/rechts), Marken-Zeile, Besuchs-Panel. Mehr Luft über einer Überschrift als darunter.

### Die linke Achse

Der Text der gesamten Seite steht in derselben 1120er-Spalte — Kopf, Sektions-Titel, Footer und auch die H1, die auf dem Hero-Foto liegt (sie sitzt in einem absolut positionierten 1120er-Band auf der Platte). Es gibt genau eine linke Kante. Die Bilder sind die Ausnahme: das Hero-Foto ragt bis auf `10px` (mobil) beziehungsweise `16px` (md) an den Viewport-Rand, die Sparten-Bilder füllen ihre Rasterspalte. Kein Schatten, nirgends.

### Hero

**Das Bild ist die Bühne, die H1 steht auf ihm.**

- Das Foto spannt sich als grosse Platte fast über den ganzen ersten Bildschirm: `mx-2.5` (`md:mx-4`), 28px Radius (`md: 36px`), Höhe `clamp(440px, calc(100svh - 200px), 860px)`. Der Kopf bleibt oben auf dem Kalk — das Bild beginnt darunter, nicht hinter ihm.
- Die **H1** liegt unten links auf dem Foto, in einem absolut positionierten 1120er-Band, damit sie auf derselben Achse steht wie der übrige Text. Ein weicher Ink-Scrim (`from-ink/85` über die unteren zwei Drittel) trägt sie; ohne ihn verschwindet Chalk auf hellem Foto. Display-Grösse `clamp(2.25rem, 7.5vw, 5.5rem)`, `text-wrap: balance`.
- **Nur die H1 liegt auf dem Bild.** Keine Subzeile, keine Chips, kein Scroll-Cue, kein zweiter Text — die Platte bleibt ruhig.
- Darunter auf dem Kalk, in der 1120er-Spalte: die **Subzeile** (46ch, 17/19px) und ein **Handlungsband** über einer Haarlinie — links genau ein CTA als unterstrichene Zeile mit Pfeil, rechts der zweite Weg (Eier) als **Kreide-Notiz**.
- **Nichts ist über eine Animation versteckt.** Der Ruhezustand ist vollständig sichtbar; animiert wird allein das Handlungsband, und auch das nur über `transform`.

**Warum die H1 auf dem Bild liegt:** die Referenz-Richtung des Kunden (grosses Bild, grosszügige Rundungen, ruhige Bildsprache) macht das Foto zur Bühne; die H1 sitzt als einzige Schrift darauf und macht den Hof zum Ziel statt zum Hintergrund. Alles Lesbare — Subzeile und Handlung — bleibt auf dem Kalk.

## Elevation & Depth

Flach als Prinzip: Tiefe entsteht durch den Dotter-Verlauf der Icon-Bühnen und die Weide-Regeln, nicht durch Schatten. Eine Ausnahme: das überlappende Besitzerinnen-Porträt im Hero ruht mit einem weichen Standardschatten.

## Shapes

Runde, ruhige Geometrie: grosse Foto-Platten (36px), Bänder und Panels (24px), Boxen (20px), Bild-Innen (18px), Controls eckiger (12px). Tür- und Brett-Motive nur als Rahmen und Regeln, nie als Clip-Path-Deko.

## Components

### Buttons
- **CTAs sind Zeilen, keine Kästen.** Der Hero-CTA ist Weide auf Kalk: 17px fett, Haarlinie (`1px`, 7px Abstand), Pfeil, `min-height: 48px`. Der Nav-CTA ist Weide-Text mit Pfeil, ohne Fläche.
- **Primary:** Weide-Fläche, Chalk-Text, uppercase, fett. Reserviert für Formulare und Unterseiten — nie im Hero.
- **Sparten-Stempel:** Dotter-Fläche, Dotter-Ink-Text, 2px Dotter-Kontur, 12px Radius; Hover füllt Weide tief und stellt die Schrift auf Chalk. Die einzige gefüllte Aktion der Startseite.
- **Hover / Focus:** Fokus-Ring in Weide (3px, 2px Offset, 12px Radius). Kein Bewegungs-Feuerwerk.

### Stempel-Labels
- **Style:** Chalk, 2.5px Weide-Kontur (`/70`), leicht gedreht (±1deg), uppercase Meta-Zeile in Weide.
- **State:** Hover richtet auf (0deg).

### Sparten-Band (Stallgasse)
- **Aufbau:** Alternierende Bänder — die grosse, gerundete Foto-Platte (24px mobil, 30px md, `aspect-[4/3]`, `object-cover`, `scale-[1.035]` bei Hover) wechselt links/rechts, daneben der Text.
- **Bild:** ein echtes Hof-Foto je Sparte; Hover zoomt minimal, sonst keine Bewegung.
- **Icon:** die Tier-Identität bleibt als kleines Chalk-Badge oben links auf dem Foto (48px mobil, 56px md, `ring-1 ring-ink/10`) — der einzige Ort, an dem das Tier-Icon noch auftritt.
- **Text:** Name (Headline), ein Satz (17px), darunter der gefüllte Dotter-Stempel und rechts die Kreide-Notiz.
- **Rhythmus:** keine Balken-Regeln mehr; die Bänder trennt grosszügiger Weissraum (56px mobil, 96px md).

### Tier-Icons
- **Style:** Einheitliche 3px Kontur in Ink, Weiss-Flächen, je ein Farb-Akzent (Kamm und Blatt in Weide, Schnabel in Dotter, Ohren/Ruten/Stiel in Kastanie).
- **Einsatz:** als kleines Chalk-Badge auf den Sparten-Fotos; sonst nirgends.
- **State:** Dezent animiert (Picken 4.2s, Wedeln 1.6s, Ohrzucken 6s, Wiegen 3.8s); ohne Motion-Einstellung statisch.

### Übernahme-Schildchen
- **Style:** Surface, 2px Line-Kontur, zwei Weide-Nieten links, 12px Radius.

### Kreide-Notiz
- **Style:** Caveat 20px (selbstgehostet) in Kastanie, 2px Unterstrich, `rotate(-1deg)`. Der Pfeil in Dotter.
- **Zustand:** Hover hellt Schrift und Pfeil auf, richtet sich nicht auf — die Drehung bleibt, sie gehört zum Notiz-Charakter.

### Navigation
- **Style:** Sticky, oben **transparent** (keine Fläche, keine Linie — Teil des Heros, nicht eine Leiste davor). Erst ab 8px Scroll (`nav-scrolled`) legt sie Chalk mit Blur unter und zieht die Haarlinie in `line`; ohne JavaScript steht sie sofort solid (`<noscript>`). Lockup aus gezeichnetem Stalltor (Weide) + Wortmarke (22px), 14px Links, CTA „Vorbeikommen" als Weide-Text mit Pfeil — kein Kasten. Touch-Ziele `min-h-[44px]`.

## Do's and Don'ts

### Do:
- **Do** Bilder vom echten Hof und echte Menschen an den Anfang stellen (echte Fotos statt Platzhalter).
- **Do** das Hero-Foto als grosse Platte fassen (`10px` / `md: 16px` Kalkrand, 28/36px Radius) und die H1 darauf setzen.
- **Do** die H1 mit einem weichen Ink-Scrim tragen, damit Chalk auf jedem Foto lesbar bleibt.
- **Do** die Sparten als grosse, gerundete Foto-Platten zeigen; das Tier-Icon lebt nur noch als kleines Badge darauf.
- **Do** den Kopf oben transparent lassen und ihn erst beim Scrollen zur Leiste machen.
- **Do** Weide sparsam und nur für Aktion, Regel und Stempel-Kontur nutzen (Stamp Rule).
- **Do** Dotter nur für den gefüllten Sparten-Stempel und den Notiz-Pfeil einsetzen (Dotter Rule).
- **Do** Tier-Icons in einer Strichstärke und einem Animations-Loop pro Tier halten.
- **Do** Türen nur dort zeigen, wo sie helfen (Besuch, Details) — Gefühl statt Deko.

### Don't:
- **Don't** Kicker oder Eyebrows über Headlines setzen (No-Kicker Rule).
- **Don't** ausser der H1 Text auf das Hero-Foto legen — keine Subzeile, keine Chips, kein Scroll-Cue auf der Platte.
- **Don't** Inhalte über `animation-fill-mode: both` + `opacity: 0` verstecken — der Ruhezustand ist immer vollständig sichtbar.
- **Don't** den Hero-CTA als Kasten bauen — er bleibt eine unterstrichene Zeile.
- **Don't** das Hero-Foto randlos über die ganze Breite ziehen — der Kalkrand gehört dazu.
- **Don't** Stock-Fotos, Folklore oder knallige Flächen verwenden (Brief-Ban).
- **Don't** Dotter zur Sektionsfläche machen oder als Textfarbe auf Kalk setzen (Dotter Rule).
- **Don't** harte Offset-Schatten ausserhalb der einen Portrait-Ausnahme nutzen.
- **Don't** Emoji oder Unicode-Zeichen statt gezeichneter Icons verwenden.
- **Don't** die Eier-Übergabe je als Banner mit „ausgebucht"-Ton formulieren.
