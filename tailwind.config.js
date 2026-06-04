/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#0e7490',
                green: {
                    accent: '#06b6d4',
                    dark:   '#0e7490',
                    mid:    '#0891b2',
                    light:  '#cffafe',
                },
            },
            fontFamily: {
                jakarta: ['"Plus Jakarta Sans"', 'sans-serif'],
            },
        },
    },
    plugins: [],
}