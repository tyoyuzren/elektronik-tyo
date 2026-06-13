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
</head>
<body class="font-sans antialiased" x-data="loadingScreen()">

    {{-- Loading Overlay --}}
    <div class="loading-overlay" :class="{ 'active': show }">
        <div class="flex flex-col items-center">
            <div class="loading-spinner"></div>
            <p class="loading-text">Memuat...</p>
        </div>
    </div>

    {{-- Top Navbar --}}
    <header class="fixed top-0 left-0 right-0 z-50 h-16 backdrop-blur-xl border-b" style="background-color: color-mix(in srgb, var(--color-surface) 80%, transparent); border-color: var(--color-border);">
        <div class="h-full max-w-screen-2xl mx-auto px-4 sm:px-6 flex items-center gap-4">
            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 shrink-0">
                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="width: 22px; height: 22px; color: var(--color-text);">
                    <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                </svg>
                <span class="font-bold text-base text-text tracking-tight hidden sm:block">Apple Store Elektronik Tyo</span>
            </a>

            {{-- Nav Links --}}
            <nav class="hidden md:flex items-center gap-1 ml-6" data-nav>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                    <i class="ph ph-layout text-base"></i>
                    Dashboard
                </a>
                <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'nav-link-active' : '' }}">
                    <i class="ph ph-tag text-base"></i>
                    Kategori
                </a>
                <a href="{{ route('produk.index') }}" class="nav-link {{ request()->routeIs('produk.*') ? 'nav-link-active' : '' }}">
                    <i class="ph ph-package text-base"></i>
                    Produk
                </a>
                <a href="{{ route('cart.index') }}" class="nav-link {{ request()->routeIs('cart.*') ? 'nav-link-active' : '' }}">
                    <i class="ph ph-shopping-cart text-base"></i>
                    Keranjang
                    @php $cartCount = app(App\Services\CartService::class)->count(); @endphp
                    @if ($cartCount > 0)
                        <span class="bg-accent-green text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center">{{ $cartCount }}</span>
                    @endif
                </a>
                <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->routeIs('transaksi.*') ? 'nav-link-active' : '' }}">
                    <i class="ph ph-receipt text-base"></i>
                    Transaksi
                </a>
            </nav>

            {{-- Spacer --}}
            <div class="flex-1"></div>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">
                {{-- Theme Toggle --}}
                <button @click="toggle()" class="theme-toggle" title="Toggle theme">
                    <template x-if="isDark">
                        <i class="ph ph-sun text-lg"></i>
                    </template>
                    <template x-if="!isDark">
                        <i class="ph ph-moon text-lg"></i>
                    </template>
                </button>

                {{-- Cart Icon --}}
                <a href="{{ route('cart.index') }}" class="relative btn-ghost !px-2 !py-2 hidden sm:flex" title="Keranjang">
                    <i class="ph ph-shopping-cart text-base"></i>
                    @php $cartCount = app(App\Services\CartService::class)->count(); @endphp
                    @if ($cartCount > 0)
                        <span class="absolute -top-1 -right-1 bg-accent-green text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full min-w-[16px] text-center leading-tight">{{ $cartCount }}</span>
                    @endif
                </a>

                {{-- Quick Action --}}
                <a href="{{ route('transaksi.create') }}" class="btn-primary !px-3 !py-1.5 text-xs hidden sm:flex">
                    <i class="ph ph-plus-circle text-sm"></i>
                    Transaksi
                </a>

                {{-- User --}}
                <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl" style="background-color: var(--color-glass-white); border: 1px solid var(--color-glass-border);">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-primary/20 to-accent-blue/10 border border-primary/20 flex items-center justify-center">
                        <i class="ph ph-user text-xs text-primary-light"></i>
                    </div>
                    <div class="hidden sm:block leading-tight">
                        <p class="text-sm font-medium text-text">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] font-semibold text-text-muted">{{ Auth::user()->role }}</p>
                    </div>
                </div>

                {{-- Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="btn-ghost !px-2 !py-2">
                        <i class="ph ph-dots-three-vertical-vertical text-base"></i>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-52 rounded-2xl shadow-elevated p-1.5 z-50 animate-scale-in"
                         style="display:none; background-color: var(--color-surface-100); border: 1px solid var(--color-border);">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-sm text-text transition-colors hover:bg-glass-white">
                            <i class="ph ph-user-circle text-base text-text-muted"></i>
                            Profile
                        </a>
                        <hr class="my-1" style="border-color: color-mix(in srgb, var(--color-border) 30%, transparent);">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" onclick="sessionStorage.removeItem('welcome_shown')" class="flex items-center gap-2.5 w-full text-left px-3.5 py-2.5 rounded-xl text-sm transition-colors hover:bg-glass-white">
                                <i class="ph ph-arrows-counter-clockwise text-base text-text-muted"></i>
                                Ganti Akun
                            </button>
                        </form>
                        <hr class="my-1" style="border-color: color-mix(in srgb, var(--color-border) 30%, transparent);">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" onclick="sessionStorage.removeItem('welcome_shown')" class="flex items-center gap-2.5 w-full text-left px-3.5 py-2.5 rounded-xl text-sm text-accent-red transition-colors hover:bg-accent-red/5">
                                <i class="ph ph-sign-out text-base"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Mobile Nav --}}
    <nav class="fixed bottom-0 left-0 right-0 z-50 md:hidden backdrop-blur-xl border-t flex items-center justify-around px-2 py-2" style="background-color: color-mix(in srgb, var(--color-surface) 90%, transparent); border-color: var(--color-border);" data-nav>
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-text-muted' }}">
            <i class="ph ph-layout text-lg"></i>
            <span class="text-[10px] font-semibold">Dashboard</span>
        </a>
        <a href="{{ route('kategori.index') }}" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition-colors {{ request()->routeIs('kategori.*') ? 'text-primary' : 'text-text-muted' }}">
            <i class="ph ph-tag text-lg"></i>
            <span class="text-[10px] font-semibold">Kategori</span>
        </a>
        <a href="{{ route('produk.index') }}" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition-colors {{ request()->routeIs('produk.*') ? 'text-primary' : 'text-text-muted' }}">
            <i class="ph ph-package text-lg"></i>
            <span class="text-[10px] font-semibold">Produk</span>
        </a>
        <a href="{{ route('cart.index') }}" class="relative flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition-colors {{ request()->routeIs('cart.*') ? 'text-primary' : 'text-text-muted' }}">
            <i class="ph ph-shopping-cart text-lg"></i>
            @php $cartCount = app(App\Services\CartService::class)->count(); @endphp
            @if ($cartCount > 0)
                <span class="absolute -top-0.5 right-2 bg-accent-green text-white text-[8px] font-bold px-1 py-0.5 rounded-full min-w-[14px] text-center leading-tight">{{ $cartCount }}</span>
            @endif
            <span class="text-[10px] font-semibold">Keranjang</span>
        </a>
        <a href="{{ route('transaksi.index') }}" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition-colors {{ request()->routeIs('transaksi.*') ? 'text-primary' : 'text-text-muted' }}">
            <i class="ph ph-receipt text-lg"></i>
            <span class="text-[10px] font-semibold">Transaksi</span>
        </a>
    </nav>

    {{-- Main Content --}}
    <main class="pt-16 pb-20 md:pb-0 min-h-screen max-w-screen-2xl mx-auto">
        @if (session('success'))
            <div class="px-4 sm:px-6 pt-6 animate-slide-down">
                <div class="flex items-center gap-2.5 px-5 py-3.5 rounded-2xl border text-sm font-semibold bg-accent-green/5 border-accent-green/20 text-accent-green">
                    <i class="ph ph-check-circle text-lg"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    @stack('scripts')
</body>
</html>
