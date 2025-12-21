import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                title: ['var(--font-title)'],
                main: ['var(--font-main)'],
            },
            colors: {
                'brand-primary': 'var(--brand-primary)',
                'brand-primary-soft': 'var(--brand-primary-soft)',
                'brand-secondary': 'var(--brand-secondary)',
                'brand-secondary-soft': 'var(--brand-secondary-soft)',
                'bg-white': 'var(--bg-white)',
                'bg-light': 'var(--bg-light)',
                'border-soft': 'var(s--border-soft)',
                'success': 'var(--success)',
                'error': 'var(--error)',
                'info': 'var(--info)',
                'info-hover': 'var(--info-hover)',
            },
        },
    },

    plugins: [forms],
};
