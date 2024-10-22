import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'; // <-- require path from node

export default defineConfig({
    plugins: [
        laravel({
            // edit the first value of the array input to point to our new sass files and folder.
            input: ['resources/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        proxy: {
          '/api': {
            target: 'http://127.0.0.1:8000', // URL del tuo backend Laravel
            changeOrigin: true,
            secure: false, // imposta false se usi HTTP e non HTTPS
          },
        },
      },
    // Add resolve object and aliases
    resolve: {
        alias: {
            '~icons': path.resolve(__dirname, 'node_modules/bootstrap-icons/font'),
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~resources': '/resources/'
        }
    },

});
