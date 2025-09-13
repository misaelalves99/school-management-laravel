// vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/css/home/home.css',
                'resources/css/teachers/index.css',
                'resources/css/teachers/create.css',
                'resources/css/teachers/edit.css',
                'resources/css/teachers/details.css',
                'resources/css/teachers/delete.css',
                'resources/css/enrollments/index.css',
                'resources/css/enrollments/create.css',
                'resources/css/enrollments/edit.css',
                'resources/css/enrollments/details.css',
                'resources/css/enrollments/delete.css',
            ],
            refresh: true,
        }),
    ],
});
