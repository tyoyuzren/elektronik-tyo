<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="themeManager()"
      :class="{ 'dark': isDark, 'light': !isDark }"
      class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Apple Store Elektronik Tyo') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|jetbrains-mono:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2/src/regular/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.2/src/bold/style.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .auth-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            overflow: hidden;
        }
        .auth-bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
        }
        .light .auth-bg-circle {
            opacity: 0.08;
        }
        .auth-bg-circle:nth-child(1) {
            width: 400px;
            height: 400px;
            background: #6C5CE7;
            top: -100px;
            right: -100px;
        }
        .auth-bg-circle:nth-child(2) {
            width: 300px;
            height: 300px;
            background: #4DA3FF;
            bottom: -50px;
            left: -80px;
        }
        .auth-bg-circle:nth-child(3) {
            width: 200px;
            height: 200px;
            background: #00D2FF;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .auth-grid {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(rgba(108, 92, 231, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108, 92, 231, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .light .auth-grid {
            background-image:
                linear-gradient(rgba(108, 92, 231, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108, 92, 231, 0.04) 1px, transparent 1px);
        }
        .auth-card {
            background-color: var(--color-surface-50);
            border: 1px solid var(--color-border);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.04);
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            overflow: hidden;
        }
        .light .auth-card {
            box-shadow: 0 8px 32px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.04);
            background-color: var(--color-surface-50);
        }
        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #6C5CE7, #4DA3FF, #00D2FF);
            border-radius: 1.5rem 1.5rem 0 0;
        }
    </style>
</head>
<body class="font-sans antialiased" style="background-color: var(--color-surface); color: var(--color-text);">

    <div class="auth-bg">
        <div class="auth-bg-circle"></div>
        <div class="auth-bg-circle"></div>
        <div class="auth-bg-circle"></div>
    </div>
    <div class="auth-grid"></div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4">
        <div class="mb-8 text-center animate-fade-in">
            <a href="/" class="inline-flex flex-col items-center gap-1">
                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 40px; color: var(--color-text);">
                    <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                </svg>
                <span class="font-semibold text-lg tracking-tight" style="color: var(--color-text);">Apple Store Elektronik Tyo</span>
            </a>
        </div>

        <div class="auth-card animate-slide-up">
            {{ $slot }}
        </div>

        <p class="mt-6 text-xs font-medium animate-fade-in" style="color: var(--color-text-dim);">
            &copy; {{ date('Y') }} Apple Store Elektronik Tyo &mdash; All rights reserved
        </p>
    </div>

</body>
</html>
