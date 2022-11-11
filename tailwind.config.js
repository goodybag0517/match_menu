const defaultTheme = require('tailwindcss/defaultTheme');
const fontSize = require('./fontSize.js');
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            screens: {
                xs:"375px",
                lg:"1024px",
            },
        },
        fontSize
    },

    plugins: [require('@tailwindcss/forms')],
};
