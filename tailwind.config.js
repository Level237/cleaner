import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                brand: {
                    50: '#f4fbf5',
                    100: '#e5f6e8',
                    200: '#cbeed3',
                    300: '#a0dfaf',
                    400: '#6dc984',
                    500: '#3ab54a',
                    600: '#2a9638',
                    700: '#24772e',
                    800: '#205f28',
                    900: '#1b4e23',
                    950: '#0e2b14',
                },
                blue: {
                    50: '#f4fbf5',
                    100: '#e5f6e8',
                    200: '#cbeed3',
                    300: '#a0dfaf',
                    400: '#6dc984',
                    500: '#3ab54a', // Custom brand color (requested by user)
                    600: '#2a9638',
                    700: '#24772e',
                    800: '#205f28',
                    900: '#1b4e23',
                    950: '#0e2b14',
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
