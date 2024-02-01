import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Vue from '@vitejs/plugin-vue';
import WindiCSS from 'vite-plugin-windicss';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: true
        }),
        Vue(),
        WindiCSS(),
    ],
});
