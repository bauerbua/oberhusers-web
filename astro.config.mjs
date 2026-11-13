import { defineConfig } from 'astro/config';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  site: 'http://www.oberhusers.ch',
  base: '/test-deployment/',
  vite: { plugins: [tailwindcss()] },
});
