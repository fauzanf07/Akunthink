import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            screens: {
                phone: { max: '559px' },              // ≤ 559px (small phones)
                phoneLg: { min: '560px', max: '639px' }, // 560px – 649px (large phones)
                tablet: { min: '640px', max: '1024px' }, // 640px – 1024px (tablets)
                laptop: { min: '1025px', max: '1245px' }, // 1025px – 1440px (laptops)
                desktop: { min: '1246px', max: '1600px'},          // ≥ 1441px (normal desktops)
                desktopLg: { min: '1601px'},          // ≥ 1441px (lg desktops)
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
