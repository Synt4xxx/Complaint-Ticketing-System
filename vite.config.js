import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', // Accept connections from any IP address, including local network
        port: 5173,       // Port number for Vite (you can change it if needed)
        strictPort: true, // Ensure the port is not automatically changed if 5173 is taken
        hmr: {
            host: '192.168.0.99', // Set HMR host to match the IP address
        }
    }
});
