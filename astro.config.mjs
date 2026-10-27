import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  site: 'https://bauerbua.github.io',
  base: '/oberhusers-web',
  vite: { plugins: [tailwindcss()] },
});
