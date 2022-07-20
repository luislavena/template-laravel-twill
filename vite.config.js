import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'
import eslintPlugin from 'vite-plugin-eslint'

export default defineConfig({
    plugins: [
        eslintPlugin(),
        laravel([
            'resources/frontend/styles/app.css',
            'resources/frontend/scripts/app.js'
        ])
    ]
})
