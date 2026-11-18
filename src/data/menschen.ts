import type { ImageMetadata } from "astro";

import fritz from "../assets/fotos/fritz-1.jpeg";
import barbara from "../assets/fotos/barbara.jpeg";
import anneLea from "../assets/fotos/Anne-lea.jpeg";

export interface Person {
    name: string;
    rolle: string;
    /** Ein Satz für die Teaser-Karten (Startseite). */
    kurz: string;
    /** Ausführlicher Text für das Profil (Über uns). */
    lang: string;
    /** Verantwortungsbereiche, nur im Profil sichtbar. */
    aufgaben: string[];
    bild: ImageMetadata;
    bildAlt: string;
    /**
     * Bildausschnitt als `object-position`. Die Hochformate von Barbara und
     * Anne-Lea werden beschnitten — `50% 0%` rückt die Personen im Rahmen
     * weiter nach unten (mehr Luft über dem Kopf).
     */
    bildPosition?: string;
}

export const menschen: Person[] = [
    {
        name: "Fritz",
        rolle: "Betriebsleiter · Meisterlandwirt",
        kurz: "Behält den Überblick über den vielseitigen Hof und führt ihn mit viel Erfahrung weiter.",
        lang: "Als Betriebsleiter behält Fritz den Überblick über unseren vielseitigen Hof. Obwohl er mit Barbara den Betrieb 2002 übernommen hat, ist er schon sein ganzes Leben hier zu Hause und mit Herzblut in der Landwirtschaft tätig. Er trägt die Gesamtverantwortung für alles, was draussen mit unseren Tieren, den Feldern und dem Land zu tun hat, und führt den Hof mit viel Erfahrung und Engagement weiter.",
        aufgaben: [
            "Betriebsleitung und Organisation",
            "Tierhaltung und Landwirtschaft",
            "Felder, Wiesen und Maschinen",
        ],
        bild: fritz,
        bildAlt: "Fritz im Stall",
    },
    {
        name: "Barbara",
        rolle: "Lehrerin · Allrounderin",
        kurz: "Hat den Chinderhof ins Leben gerufen und sorgt dafür, dass hinter den Kulissen alles rundläuft.",
        lang: "Als Lehrerin bringt Barbara ihre Freude an der Arbeit mit Kindern auch auf unseren Hof. 2008 hat sie den Chinderhof ins Leben gerufen und damit ihr liebstes, den Hof und die Kinder zusammengebracht. Neben ihrer Tätigkeit als Lehrerin ist sie unsere vielseitige Allrounderin und sorgt dafür, dass auch hinter den Kulissen alles rundläuft.",
        aufgaben: [
            "Hauptverantwortung für den Chinderhof",
            "Betreuung unseres Streichelzoos",
            "Administration und Buchhaltung",
        ],
        bild: barbara,
        bildAlt: "Barbara im Stall",
        bildPosition: "50% 0%",
    },
    {
        name: "Anne-Lea",
        rolle: "Landwirtin · Fachfrau Kinderbetreuung",
        kurz: "Bringt Landwirtschaft und Kinderbetreuung zusammen und übernimmt das Eierbusiness.",
        lang: "Mit ihrer Ausbildung und Erfahrung in der Landwirtschaft und der Kinderbetreuung kennt sie zwei grosse Bereiche unseres Hofes. Künftig möchte sie sich ganz dem Familienhof widmen und bringt frischen Wind in die Weiterentwicklung unseres Betriebs.",
        aufgaben: [
            "Mithilfe in allen Betriebszweigen von melken bis Chinderhof",
            "Hauptverantwortung für das Eierbusiness",
            "Administration und digitale Aufgaben",
        ],
        bild: anneLea,
        bildAlt: "Anne-Lea mit einem Huhn auf dem Arm",
        bildPosition: "50% 0%",
    },
];
