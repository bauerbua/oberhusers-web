import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  site: 'https://www.oberhusers.ch',
  base: '/',
  vite: {
    plugins: [tailwindcss()],
    server: {
      // Nur für `astro dev` und `astro preview`; im Build/Produktion nicht aktiv.
      // Weitergeleitet wird an den PHP-Backend-Server (`npm run dev:backend`).
      proxy: {
        '/api': 'http://localhost:8080',
      },
    },
  },
});
