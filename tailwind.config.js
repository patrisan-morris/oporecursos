import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                primary: '#65268E',
                lightPrimary: '#C08EE1',
                darkPrimary: '#501E71',
                secondary: '#9D4EDD',
                background: '#FFFFFF',
                text: '#1E293B',
                lightbg: '#E0D7F3',
                accent: '#A78BFA',
                gradientStart: '#5A189A',
                gradientEnd: '#9D4EDD',
                lightText: '#D7BCE8',
            },
            fontFamily: {
                sans:  ['Inter', ...defaultTheme.fontFamily.sans],
            },
            textShadow: {
                sm: '1px 1px 2px rgba(0, 0, 0, 0.25)',
                DEFAULT: '2px 2px 4px rgba(0, 0, 0, 0.3)',
                lg: '3px 3px 6px rgba(0, 0, 0, 0.35)',
            },
        },
    },

    plugins: [forms, require('tailwindcss-textshadow')],
};
