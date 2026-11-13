import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  site: 'http://www.oberhusers.ch',
  base: '/',
  vite: { plugins: [tailwindcss()] },
});
