/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                mono: ['"IBM Plex Mono"', "monospace"],
            },
            colors: {
                retro: {
                    bg: "#0a0a0a",
                    surface: "#171717",
                    border: "#333333",
                    text: "#f5f5f5",
                    accent: "#ffffff",
                },
            },
        },
    },
    plugins: [],
};
