import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                primary:      '#06B6D4',
                'light-cyan': '#22D3EE',
                'ice-cyan':   '#ECFEFF',
                rose:         '#F43F5E',
            },
            fontFamily: {
                sans:    ['"DM Sans"', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"', 'serif'],
            },
            keyframes: {
                fadeUp: {
                    '0%':   { opacity: '0', transform: 'translateY(18px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%,100%': { transform: 'translateY(0)' },
                    '50%':     { transform: 'translateY(-22px)' },
                },
            },
            animation: {
                'fade-up':   'fadeUp .55s ease both',
                'fade-up-1': 'fadeUp .55s .10s ease both',
                'fade-up-2': 'fadeUp .55s .20s ease both',
                'fade-up-3': 'fadeUp .55s .32s ease both',
                'float':     'float 7s ease-in-out infinite',
                'float-r':   'float 9s ease-in-out infinite reverse',
            },
        },
    },
    plugins: [forms],
};