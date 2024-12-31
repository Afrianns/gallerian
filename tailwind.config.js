import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                kanit: ["kanit"],
                kumbhSans: ["kumbh sans"],
                kalnia: ["kalnia"],
            },
            colors: {
                teal: "#08E3F2",
                darkPurple: "#01264A",
                lightBlue: "#3648EB",
                lightTeal: "#D0EAE9",
            },

            animation: {
                translation: "translation 1s linear infinite",
            },
            keyframes: {
                translation: {
                    "0%": { transform: "translate(0)" },
                    "100%": { transform: "translate(100%)" },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
