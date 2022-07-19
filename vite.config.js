import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'
import eslintPlugin from 'vite-plugin-eslint'

export default defineConfig({
    plugins: [
        eslintPlugin(),
        laravel(['resources/css/app.css', 'resources/js/app.js'])
    ]
})
