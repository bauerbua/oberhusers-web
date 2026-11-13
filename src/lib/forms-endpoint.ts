// Ziel für die Formular-POSTs: der PHP-Endpoint auf demselben Host
// (public/api/senden.php → /api/senden.php).
const base = import.meta.env.BASE_URL.replace(/\/$/, "");

export const formsEndpoint = `${base}/api/senden.php`;
