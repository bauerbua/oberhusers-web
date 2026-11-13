// Formular-Versand an den PHP-Endpoint (public/api/senden.php), der die
// Anfrage als normale E-Mail an den Hof schickt. Das Skript liegt auf
// demselben Host wie die Seite (Hostfactory); es gibt keinen Secret Key im
// Browser und keinen externen Mail-Dienst.
//
// Die Endpoint-URL steht als data-Attribut am <body> (siehe Base.astro und
// src/lib/forms-endpoint.ts).

const endpoint = document.body.dataset.formsEndpoint ?? "";

type FormKind = "eierabo" | "kinder-anmeldung";

const TEXTS: Record<FormKind, { sending: string; success: string }> = {
    eierabo: {
        sending: "Wird gesendet …",
        success: "Danke! Wir melden uns sobald wie möglich bei dir.",
    },
    "kinder-anmeldung": {
        sending: "Wird gesendet …",
        success: "Danke! Wir melden uns bei euch.",
    },
};

const ERROR_TEXT =
    "Senden hat nicht geklappt. Bitte versuche es noch einmal oder schreibe uns direkt an hof@oberhusers.ch.";

if (endpoint) {
    document
        .querySelectorAll<HTMLFormElement>("form[data-form]")
        .forEach((form) => {
            const kind = form.dataset.form as FormKind;
            const texts = TEXTS[kind] ?? TEXTS.eierabo;
            const status = form.querySelector<HTMLElement>(".form-status");
            const submit = form.querySelector<HTMLButtonElement>(
                'button[type="submit"]',
            );

            // Fallback ohne JavaScript: normaler POST an den PHP-Endpoint (der
            // antwortet dann mit einer Danke-Seite).
            form.action = endpoint;

            const setStatus = (
                state: "" | "sending" | "success" | "error",
                text = "",
            ) => {
                if (!status) return;
                status.dataset.state = state;
                status.textContent = text;
            };

            form.addEventListener("submit", async (event) => {
                event.preventDefault();

                const data = Object.fromEntries(new FormData(form).entries());

                // Honeypot gefüllt = Bot: still verwerfen, nichts senden.
                if (String(data.website ?? "").trim()) return;
                delete data.website;

                setStatus("sending", texts.sending);
                if (submit) submit.disabled = true;

                try {
                    const response = await fetch(endpoint, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                        },
                        body: JSON.stringify({ form: kind, data }),
                    });
                    if (!response.ok) throw new Error(String(response.status));

                    form.reset();
                    setStatus("success", texts.success);
                } catch {
                    setStatus("error", ERROR_TEXT);
                } finally {
                    if (submit) submit.disabled = false;
                }
            });
        });
}
