import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: '#10B981',
                secondary: '#065F46',
                accent: '#F59E0B',
                muted: '#F4F6F8',
            },
        },
    },
    plugins: [],
}
