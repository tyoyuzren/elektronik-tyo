import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                glass: {
                    white: 'var(--color-glass-white)',
                    border: 'var(--color-glass-border)',
                    hover: 'var(--color-glass-hover)',
                },
                surface: {
                    DEFAULT: 'var(--color-surface)',
                    50: 'var(--color-surface-50)',
                    100: 'var(--color-surface-100)',
                    200: 'var(--color-surface-200)',
                    300: 'var(--color-surface-300)',
                    400: 'var(--color-surface-400)',
                },
                border: {
                    DEFAULT: 'var(--color-border)',
                    light: 'var(--color-border-light)',
                    subtle: 'var(--color-border-subtle)',
                },
                primary: {
                    DEFAULT: '#6C5CE7',
                    light: '#8B7CFF',
                    dark: '#5548C0',
                    glow: 'rgba(108, 92, 231, 0.25)',
                },
                accent: {
                    blue: '#4DA3FF',
                    cyan: '#00D2FF',
                    green: '#34D98B',
                    red: '#FF6B6B',
                    orange: '#FFA94D',
                    yellow: '#F5C842',
                },
                text: {
                    DEFAULT: 'var(--color-text)',
                    muted: 'var(--color-text-muted)',
                    dim: 'var(--color-text-dim)',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
                heading: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'card': '0 1px 3px 0 rgba(0, 0, 0, 0.3), 0 1px 2px -1px rgba(0, 0, 0, 0.2)',
                'card-hover': '0 4px 12px 0 rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.3)',
                'elevated': '0 8px 32px rgba(0, 0, 0, 0.4)',
                'panel': '0 0 0 1px rgba(255, 255, 255, 0.04), 0 4px 24px rgba(0, 0, 0, 0.3)',
                'glow-primary': '0 0 20px rgba(108, 92, 231, 0.2)',
                'glow-blue': '0 0 20px rgba(77, 163, 255, 0.2)',
                'glow-green': '0 0 20px rgba(52, 217, 139, 0.2)',
            },
            animation: {
                'fade-in': 'fadeIn 0.25s ease-out',
                'slide-up': 'slideUp 0.3s ease-out',
                'slide-down': 'slideDown 0.2s ease-out',
                'scale-in': 'scaleIn 0.2s ease-out',
                'pulse-soft': 'pulseSoft 2s ease-in-out infinite',
                'shimmer': 'shimmer 2s linear infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(12px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                slideDown: {
                    '0%': { opacity: '0', transform: 'translateY(-6px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                scaleIn: {
                    '0%': { opacity: '0', transform: 'scale(0.95)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                pulseSoft: {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.6' },
                },
                shimmer: {
                    '0%': { transform: 'translateX(-100%)' },
                    '100%': { transform: 'translateX(100%)' },
                },
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'gradient-card': 'linear-gradient(135deg, rgba(108,92,231,0.06) 0%, rgba(77,163,255,0.02) 100%)',
                'gradient-card-accent': 'linear-gradient(135deg, rgba(108,92,231,0.12) 0%, rgba(77,163,255,0.06) 100%)',
                'gradient-glass': 'linear-gradient(135deg, rgba(255,255,255,0.04) 0%, rgba(255,255,255,0.01) 100%)',
            },
        },
    },

    plugins: [forms],
};
