import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // 新しく追加したものがあれば記載する
                'resources/css/slider.css',
                'resources/js/slider.js',
            ],
            refresh: true,
        }),
    ],
});
