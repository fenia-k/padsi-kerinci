const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './resources/**/*.scss', // Pastikan file SCSS/CSS juga dimasukkan jika diperlukan
    ],
    theme: {
        extend: {
            colors: {
                'brown-main': '#b3804d',       // Main brown color
                'brown-dark': '#8c6239',       // Darker brown for hover effects
                'brown-darker': '#704c2a',     // Even darker brown
                'brown-light': '#f5f5f5',      // Light brown color for text/sections
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans], // Menambahkan font kustom 'Figtree'
            },
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
            borderRadius: {
                'xl': '1.5rem',
            },
            boxShadow: {
                'custom-light': '0 2px 8px rgba(0, 0, 0, 0.1)', // Bayangan halus untuk elemen
                'custom-dark': '0 2px 8px rgba(0, 0, 0, 0.3)',  // Bayangan lebih gelap
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'), // Plugin untuk memperindah form
        require('@tailwindcss/typography'), // Plugin untuk mempercantik tipografi
        require('@tailwindcss/aspect-ratio'), // Plugin untuk rasio aspek elemen
    ],
}
