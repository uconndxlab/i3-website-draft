import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/circleTurnAnimation.js',
                'resources/js/coffeeAnimation.js',
                'resources/js/explodingPhrases.js',
                'resources/js/photoScroller.js',
                'resources/js/starParticles.js',
        ],
            refresh: true,
        })
    ],
});
