module.exports = {
    env: {
        node: true,
        browser: true
    },
    extends: ['eslint:recommended', 'prettier'],
    plugins: ['unused-imports', 'simple-import-sort'],
    rules: {
        'no-unused-vars': 'off',
        'unused-imports/no-unused-imports': 'error',
        'unused-imports/no-unused-vars': [
            'warn',
            {
                vars: 'all',
                varsIgnorePattern: '^_',
                args: 'after-used',
                argsIgnorePattern: '^_'
            }
        ],
        'simple-import-sort/imports': 'error',
        'simple-import-sort/exports': 'error'
    },
    parserOptions: {
        sourceType: 'module',
        ecmaVersion: 2022
    },
    globals: {
        A17: true
    }
}
