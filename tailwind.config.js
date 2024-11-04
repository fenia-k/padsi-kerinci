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
            // Font Family Custom
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            // Warna Kustom
            colors: {
                primary: '#3490dc',   // Warna utama
                secondary: '#ffed4a', // Warna sekunder
                danger: '#e3342f',    // Warna untuk kesalahan/aksi berbahaya
            },

            // Breakpoint tambahan
            screens: {
                'xs': '475px', // Breakpoint khusus untuk layar ekstra kecil
            },

            // Pengaturan transition
            transitionProperty: {
                'width': 'width',
                'spacing': 'margin, padding',
            },
        },
    },

    plugins: [forms],
};
