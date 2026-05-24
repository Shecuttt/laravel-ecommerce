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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                background: '#f5fcf9',
                foreground: '#202925',
                card: {
                    DEFAULT: '#ffffff',
                    foreground: '#202925',
                },
                popover: {
                    DEFAULT: '#ffffff',
                    foreground: '#202925',
                },
                primary: {
                    DEFAULT: '#1e4a3b',
                    foreground: '#f5fcf9',
                },
                secondary: {
                    DEFAULT: '#dfeae6',
                    foreground: '#1e4a3b',
                },
                muted: {
                    DEFAULT: '#edf3f1',
                    foreground: '#566e66',
                },
                accent: {
                    DEFAULT: '#d98218',
                    foreground: '#121e1a',
                },
                destructive: {
                    DEFAULT: '#c82333',
                },
                border: '#d2e2de',
                input: '#d2e2de',
                ring: '#1e4a3b',
            },
        },
    },

    plugins: [forms],
};
