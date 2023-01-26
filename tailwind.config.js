const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/wireui/wireui/resources/**/*.blade.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/View/**/*.php",
    ],
    presets: [require("./vendor/wireui/wireui/tailwind.config.js")],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    safelist: [
        "top-4",
        "whitespace-nowrap",
        {
            pattern: /bg-(red|green|blue)-(100|200|300|400|500|600|700)/,
            variants: ["hover", "focus"],
        },
    ],

    plugins: [
        require("@tailwindcss/forms")({ strategy: "class" }),
        require("@tailwindcss/typography"),
    ],
};
