/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './source/**/*.php',
        './source/_assets/**/*.js',
        './config.php',
    ],
    // 字級／色票 token 一律保留，供 md:/lg: 與尚未用到的 class
    safelist: [
        {
            pattern: /^text-(cb|ch|eb|eh)[1-5]$/,
            variants: ['md', 'lg'],
        },
        {
            pattern: /^(bg|text|border|outline|ring|fill|stroke)-(main[12]|gray[1235]|bg|white)(\/\d+)?$/,
            variants: ['hover', 'focus', 'active', 'md', 'lg'],
        },
        'bg-dot', // 定義在 main.css（白底 + 點狀圖），尚未使用但保留
    ],
    theme: {
        screens: {
            'md': '800px',
            'lg': '1200px',
        },
        extend: {
            colors: {
                main1: '#005BAC',
                main2: '#82A7D8',
                gray5: '#0E1A2B',
                gray3: '#697280',
                gray2: '#BDC1CF',
                gray1: '#E1E3E7',
                bg: '#F0F2F8',
            },
            fontFamily: {
                sans: ['Noto Sans TC', 'sans-serif'],
                outfit: ['Outfit', 'sans-serif'],
                display: ['Tenor Sans', 'sans-serif'],
            },
        },
    },
    plugins: [],
};
