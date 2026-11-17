type FormResponse = {
    success?: boolean;
    message?: string;
};

const SUBMIT_LABEL = "Wird gesendet …";
const GENERIC_ERROR =
    "Deine Anfrage konnte leider nicht gesendet werden. Bitte versuche es später erneut.";

function setNotice(
    form: HTMLFormElement,
    state: "success" | "error",
    message: string,
): void {
    const notice = form.querySelector<HTMLElement>("[data-form-status]");

    if (!notice) {
        return;
    }

    notice.textContent = message;
    notice.dataset.state = state;
    notice.classList.toggle("is-error", state === "error");

    notice.focus({ preventScroll: true });
    notice.scrollIntoView({
        block: "nearest",
        behavior: window.matchMedia("(prefers-reduced-motion: reduce)").matches
            ? "auto"
            : "smooth",
    });
}

function clearNotice(form: HTMLFormElement): void {
    const notice = form.querySelector<HTMLElement>("[data-form-status]");

    if (!notice) {
        return;
    }

    notice.textContent = "";
    notice.classList.remove("is-error");
    delete notice.dataset.state;
}

async function readResponse(response: Response): Promise<FormResponse | null> {
    const contentType = response.headers.get("content-type") ?? "";

    if (!contentType.includes("application/json")) {
        return null;
    }

    try {
        return (await response.json()) as FormResponse;
    } catch {
        return null;
    }
}

async function handleSubmit(event: SubmitEvent): Promise<void> {
    const form = event.currentTarget as HTMLFormElement;

    event.preventDefault();

    if (form.dataset.submitting === "true") {
        return;
    }

    const submitButton = form.querySelector<HTMLButtonElement>(
        'button[type="submit"]',
    );
    const originalLabel = submitButton?.textContent ?? "";

    form.dataset.submitting = "true";
    clearNotice(form);

    if (submitButton) {
        submitButton.disabled = true;
        submitButton.setAttribute("aria-busy", "true");
        submitButton.textContent = SUBMIT_LABEL;
    }

    try {
        const response = await fetch(form.action, {
            method: "POST",
            body: new FormData(form),
            headers: { Accept: "application/json" },
        });
        const data = await readResponse(response);
        const message = data?.message?.trim() ?? "";

        if (response.ok && data?.success) {
            form.reset();
            setNotice(
                form,
                "success",
                message || "Vielen Dank für deine Nachricht.",
            );
        } else {
            setNotice(form, "error", message || GENERIC_ERROR);
        }
    } catch {
        setNotice(form, "error", GENERIC_ERROR);
    } finally {
        delete form.dataset.submitting;

        if (submitButton) {
            submitButton.disabled = false;
            submitButton.removeAttribute("aria-busy");
            submitButton.textContent = originalLabel;
        }
    }
}

document
    .querySelectorAll<HTMLFormElement>("form[data-form]")
    .forEach((form) => {
        form.addEventListener("submit", handleSubmit);
    });
