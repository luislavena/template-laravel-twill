import laravel from 'laravel-vite-plugin'
import { resolve } from 'path'
import { defineConfig } from 'vite'
import environmentPlugin from 'vite-plugin-environment'
import eslintPlugin from 'vite-plugin-eslint'

export default ({ mode }) =>
    defineConfig({
        plugins: [
            eslintPlugin(),
            environmentPlugin({
                MODE: mode,
                BEHAVIORS_PATH: resolve(
                    __dirname,
                    'resources/frontend/scripts/behaviors'
                ),
                BEHAVIORS_EXTENSION: 'js'
            }),
            laravel({
                input: [
                    resolve(__dirname, 'resources/frontend/styles/app.css'),
                    resolve(__dirname, 'resources/frontend/scripts/app.js')
                ],
                refresh: true
            })
        ],
        resolve: {
            alias: {
                '@': resolve(__dirname, 'resources/frontend')
            }
        }
    })
