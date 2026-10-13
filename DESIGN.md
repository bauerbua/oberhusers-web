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
- **Stable Ink** (#2A2620): Text, Icon-Striche.
- **Stall Line** (#E7DFD2): Feine Trennlinien, Platzhalter-Flächen.

### Named Rules
**The Stamp Rule.** Pine gehört Aktionen und Stempeln; auf keiner Fläche liegt Pine dekorativ. Seine Seltenheit ist der Point.

## Typography

**Display Font:** Archivo Variable (selbstgehostet, 118% Breite) mit System-Fallback
**Body Font:** System-Grotesk (mit Arial)
**Label/Mono Font:** Caveat (nur handschriftliche Mini-Notizen)

**Character:** Breite Arbeits-Schrift für Titel, nüchterne System-Schrift für Text, ein Hauch Handschrift für Menschlichkeit.

### Hierarchy
- **Display** (800, 36–60px, 1.02): H1 und Sektions-Titel, eng gesetzt.
- **Headline** (800, 24–30px, 1.1): Sparten-Namen, Block-Titel.
- **Body** (400, 15–18px, 1.6): Lauftext, max. 60ch.
- **Label** (700, 12–14px, uppercase, wide tracking): Buttons, Stempel, Meta.

### Named Rules
**The No-Kicker Rule.** Keine Eyebrow, kein Kicker über einer Headline — die Überschrift trägt sich selbst.

## Layout

Ein Container (1120px), 20/32px Ränder, grosszügige Sektions-Abstände (64–96px). Die Startseite folgt der Stallgasse: Hero-Bild, H1-Brett, Schildchen, dann vier Bänder im Wechsel (Bild links/rechts), Marken-Zeile, Besuchs-Panel. Mehr Luft über einer Überschrift als darunter.

## Elevation & Depth

Flach als Prinzip: Tiefe entsteht durch warme Farbverläufe (Sonnenlicht) und Holz-Rahmen, nicht durch Schatten. Eine Ausnahme: das überlappende Besitzerinnen-Porträt im Hero ruht mit einem weichen Standardschatten.

## Shapes

Runde, ruhige Geometrie: Bänder und Panels (24px), Boxen (20px), Bild-Innen (18px), Controls eckiger (12px). Tür- und Brett-Motive nur als Rahmen und Regeln, nie als Clip-Path-Deko.

## Components

### Buttons
- **Shape:** eckig-ruhig (12px), 2px Kontur.
- **Primary:** Pine-Fläche, Papier-Text, uppercase, fett. Hover: unverändert (Farbe trägt).
- **Hover / Focus:** Fokus-Ring in Clay (3px, 2px Offset). Kein Bewegungs-Feuerwerk.
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

### Navigation
- **Style:** Sticky, Papier mit Blur, Holz-Linie unten; Display-Wordmark, 15px Links, Pine-Stempel als CTA.

## Do's and Don'ts

### Do:
- **Do** Bilder vom echten Hof und echte Menschen an den Anfang stellen (Platzhalter nur bis Ersatz da ist).
- **Do** Pine sparsam und nur für Aktion und Stempel nutzen (Stamp Rule).
- **Do** Tier-Icons in einer Strichstärke und einem Animations-Loop pro Tier halten.
- **Do** Türen nur dort zeigen, wo sie helfen (Besuch, Details) — Gefühl statt Deko.

### Don't:
- **Don't** Kicker oder Eyebrows über Headlines setzen (No-Kicker Rule).
- **Don't** Stock-Fotos, Folklore oder knallige Flächen verwenden (Brief-Ban).
- **Don't** harte Offset-Schatten ausserhalb der einen Portrait-Ausnahme nutzen.
- **Don't** Emoji oder Unicode-Zeichen statt gezeichneter Icons verwenden.
- **Don't** die Eier-Übergabe je als Banner mit „ausgebucht"-Ton formulieren.
