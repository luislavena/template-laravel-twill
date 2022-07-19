import { defineConfig } from 'vite'
import eslintPlugin from 'vite-plugin-eslint'

import laravel from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        eslintPlugin(),
        laravel(['resources/css/app.css', 'resources/js/app.js'])
    ]
})
