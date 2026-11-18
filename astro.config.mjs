import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  site: 'https://www.oberhusers.ch',
  base: '/',
  integrations: [sitemap()],
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
