import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {

        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                greenG: '#00A859',
                greenB: '#1BB18E',
                greenY: '#B0D831',
            },  
        },
        container: {    /* De esta forma defino parametros por defecto en las clases de tailwind, recordar activar la compilación automatica: npm run dev  */
            center: true,
        },
    },

    plugins: [forms, typography],
};
