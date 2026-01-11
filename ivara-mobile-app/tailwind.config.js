/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./src/**/*.{js,ts,jsx,tsx,mdx}",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                border: "var(--glass-border)",
                input: "var(--secondary)", // Using secondary as input bg
                ring: "var(--accent)",
                background: "var(--background)",
                foreground: "var(--foreground)",
                primary: {
                    DEFAULT: "var(--primary)",
                    foreground: "var(--primary-foreground)",
                },
                secondary: {
                    DEFAULT: "var(--secondary)",
                    foreground: "var(--secondary-foreground)",
                },
                accent: {
                    DEFAULT: "var(--accent)",
                    foreground: "var(--accent-foreground)",
                },
                destructive: {
                    DEFAULT: "hsl(0 62.8% 30.6%)",
                    foreground: "hsl(0 0% 98%)",
                },
                muted: {
                    DEFAULT: "var(--text-muted)",
                    foreground: "var(--foreground)", // or lighter
                },
                popover: {
                    DEFAULT: "var(--secondary)",
                    foreground: "var(--foreground)",
                },
                card: {
                    DEFAULT: "var(--secondary)",
                    foreground: "var(--foreground)",
                },
            },
            fontFamily: {
                sans: ["var(--font-poppins)", "sans-serif"],
            },
            animation: {
                'spin-slow': 'spin 3s linear infinite',
            }
        },
    },
    plugins: [],
}
