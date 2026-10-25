# Design-Quelle: oberhusers-design-system.pdf

`assets/oberhusers-design-system.pdf` (Stand 25.10.2026) ist die Baseline für
alle Design-Entscheidungen der Website. Dieses Verzeichnis enthält die
Vektorgrafiken, die aus dem PDF extrahiert wurden (Script:
`tools/extract-design-system.py`, Farbwerte werden darin 1:1 auf die unten
stehende Palette gemappt — falls das PDF sich ändert, nur dieses Skript
neu ausführen).

## Farben (exakt, keine weiteren Farbwerte; erlaubt sind nur Alpha-Abmischungen dieser fünf)

| Token       | Hex       | Quelle im PDF                     |
| ----------- | --------- | --------------------------------- |
| `chalk`     | `#FAF6EC` | Papier-Hintergrund (Konvention)   |
| `gelb`      | `#FFD222` | Gelb — RGB 255/210/34             |
| `gruen`     | `#ACC969` | Grün — RGB 172/201/105            |
| `altrosa`   | `#ECC4BE` | Altrosa — RGB 236/196/190         |
| `braun`     | `#593930` | Braun — RGB 89/57/48 (Tusche)     |

## Typografie

- **Überschriften:** Amatic SC (freier Ersatz für die Markenschrift
  „A Day Without Sun Text", die lizenzpflichtig ist). Token: `font-heading`.
- **Lauftext:** System-Arial. Token: `font-sans`.
- Mehr gibt es nicht.

## Grafiken (braune Tusche; Hügelbänder ca. 519×60, Ecken ca. 55–110)

- `logo-abzeichen.svg` — die drei Oval-Abzeichen (Huhn/Klee/Kuh)
- `wortmarke.svg` — „Oberhusers Burehof" als Vektor
- `mini-huhn.svg`, `mini-klee.svg`, `mini-kuh.svg` — runde Mini-Logos mit
  Kreisinschrift (WhatsApp/Instagram)
- `huegel-1-umriss.svg`, `huegel-2-braun.svg`, `huegel-3-gruen.svg`,
  `huegel-4-gelb.svg` — die vier Hügelbänder (Umriss und drei Farbfelder)
- `ecke-gruen-blatt.svg`, `ecke-gelb-huhn.svg`, `ecke-altrosa-blatt.svg`,
  `ecke-gruen-blume.svg` — die vier Eckornamente
- `huhn-gras.svg`, `blatt-1.svg`–`blatt-3.svg`, `blatt-gelb.svg`,
  `blume-gras.svg`, `herz.svg` — Einzelelemente

Regel: Nur diese Grafiken und die davon abgeleiteten Ausschnitte; keine
selbst gezeichneten SVG-Linien, keine CSS-Animationen.
