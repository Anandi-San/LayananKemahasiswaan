/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                customBlue: "#0166B3",
                customBlack: "#3A3A3A",
                customLightBlue: "#00C2FF",
                customWhite: "#FEFEFE",
                customGray: "#DAD7D7",
            },
        },
    },
    plugins: [],
};
