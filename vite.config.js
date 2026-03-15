import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
<<<<<<< HEAD
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
=======
>>>>>>> 6170f718171fadb17dc5beb361ea37d9812646d0
});
