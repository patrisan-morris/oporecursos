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
                mindbank: {
                    primary: '#65268E',
                    secondary: '#9D4EDD',
                    background: '#FFFFFF',
                    text: '#1E293B',
                    lightbg: '#E0D7F3',
                    accent: '#A78BFA',
                    gradientStart: '#5A189A',
                    gradientEnd: '#9D4EDD',
                },
            },
            fontFamily: {
                sans:  ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
