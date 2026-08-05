import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/bootstrap-app.css',
                'resources/js/bootstrap-app.js',
                'resources/css/fontawesome-app.css',
            ],
            refresh: true,
        }),
    ],
});
