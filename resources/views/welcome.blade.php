<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Apple Store Elektronik Tyo') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background: #FFFFFF; color: #1D1D1F;">

    <div id="showcase" class="welcome-showcase" style="display:none;">
        <div class="showcase-logo">
            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
            </svg>
        </div>

        <div class="showcase-stage">
            <div class="showcase-slide active" data-index="0">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                </div>
                <h2>Produk Apple Lengkap</h2>
                <p class="desc">Kelola seluruh produk Apple — iPhone, iPad, Mac, Apple Watch, dan aksesoris original dalam satu sistem terpadu.</p>
            </div>
            <div class="showcase-slide" data-index="1">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>
                </div>
                <h2>Pantau Stok Real-time</h2>
                <p class="desc">Notifikasi stok menipis, manajemen inventaris otomatis, dan update ketersediaan barang secara langsung tanpa jeda.</p>
            </div>
            <div class="showcase-slide" data-index="2">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <h2>Catat Penjualan Cepat</h2>
                <p class="desc">Proses transaksi dengan sistem POS terintegrasi. Cetak struk, kelola riwayat, dan pantau penjualan dalam satu klik.</p>
            </div>
            <div class="showcase-slide" data-index="3">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                </div>
                <h2>Laporan & Analisis</h2>
                <p class="desc">Pantau omzet, produk terlaris, dan performa bisnis dengan grafik interaktif dan laporan real-time yang akurat.</p>
            </div>
        </div>

        <div class="showcase-footer">
            <div class="showcase-progress">
                <span class="p-bar active"><span class="p-fill"></span></span>
                <span class="p-bar"><span class="p-fill"></span></span>
                <span class="p-bar"><span class="p-fill"></span></span>
                <span class="p-bar"><span class="p-fill"></span></span>
            </div>
            <span class="showcase-label" id="showcaseLabel">Produk Apple Lengkap</span>
            <button class="showcase-enter-btn" id="showcaseEnterBtn" onclick="enterShowcase()">Lanjutkan ke Login</button>
        </div>
    </div>

    <header class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl" style="background-color: rgba(255,255,255,0.8); border-bottom: 1px solid rgba(0,0,0,0.05);">
        <div class="max-w-7xl mx-auto px-6 h-12 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="width: 18px; height: 18px; color: #1D1D1F;">
                    <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                </svg>
                <span style="font-size: 13px; font-weight: 600; color: #1D1D1F; letter-spacing: -0.01em;">Apple Store Elektronik Tyo</span>
            </div>
            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" style="font-size: 12px; font-weight: 500; color: #1D1D1F; text-decoration: none; transition: opacity 0.2s;">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" style="font-size: 12px; font-weight: 500; color: #1D1D1F; text-decoration: none; transition: opacity 0.2s;">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="font-size: 12px; font-weight: 500; color: #FFFFFF; background: #1D1D1F; padding: 5px 14px; border-radius: 20px; text-decoration: none; transition: opacity 0.2s;">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <main class="min-h-screen flex flex-col items-center justify-center px-6">
        <div class="text-center max-w-lg" style="padding-top: 48px;">
            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="width: 48px; height: 48px; color: #1D1D1F; margin: 0 auto 24px;">
                <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
            </svg>
            <h1 style="font-size: 40px; font-weight: 700; letter-spacing: -0.03em; color: #1D1D1F; margin-bottom: 8px;">Apple Store Elektronik Tyo</h1>
            <p style="font-size: 17px; font-weight: 400; color: #86868B; line-height: 1.5; margin-bottom: 32px;">Sistem manajemen inventaris dan penjualan<br>produk Apple terpercaya.</p>
            <div class="flex items-center justify-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" style="font-size: 14px; font-weight: 500; color: #FFFFFF; background: #1D1D1F; padding: 10px 24px; border-radius: 24px; text-decoration: none; transition: all 0.2s;">Buka Dashboard</a>
                @else
                    <button onclick="startShowcase()" style="font-size: 14px; font-weight: 500; color: #FFFFFF; background: #1D1D1F; padding: 10px 24px; border-radius: 24px; border: none; cursor: pointer; transition: opacity 0.2s;">Mulai</button>
                @endauth
            </div>
        </div>

        {{-- Promo Banner --}}
        <div style="margin-top: 48px; width: 100%; max-width: 600px; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
            <div style="background: linear-gradient(135deg, #1D1D1F 0%, #333333 100%); padding: 32px 28px; text-align: center;">
                <div style="margin-bottom: 12px;">
                    <span style="display: inline-block; background: rgba(255,255,255,0.15); color: #FFFFFF; padding: 4px 14px; border-radius: 20px; font-size: 11px; font-weight: 600; letter-spacing: 0.03em;">PROMO SPESIAL</span>
                </div>
                <h2 style="font-size: 24px; font-weight: 700; color: #FFFFFF; margin-bottom: 6px;">Diskon Hingga 20%</h2>
                <p style="font-size: 14px; font-weight: 400; color: #A1A1A6; line-height: 1.6; margin-bottom: 18px;">Untuk pembelian iPhone dan aksesoris terpilih. <br>Promo berlaku sampai akhir bulan ini!</p>
                <div style="display: flex; align-items: center; justify-content: center; gap: 24px; flex-wrap: wrap;">
                    <div style="text-align: center;">
                        <p style="font-size: 24px; font-weight: 700; color: #FFFFFF; margin: 0;">10%</p>
                        <p style="font-size: 11px; color: #A1A1A6; margin: 0;">iPhone Series</p>
                    </div>
                    <div style="width: 1px; height: 32px; background: rgba(255,255,255,0.15);"></div>
                    <div style="text-align: center;">
                        <p style="font-size: 24px; font-weight: 700; color: #FFFFFF; margin: 0;">20%</p>
                        <p style="font-size: 11px; color: #A1A1A6; margin: 0;">Aksesoris</p>
                    </div>
                    <div style="width: 1px; height: 32px; background: rgba(255,255,255,0.15);"></div>
                    <div style="text-align: center;">
                        <p style="font-size: 24px; font-weight: 700; color: #FFFFFF; margin: 0;">15%</p>
                        <p style="font-size: 11px; color: #A1A1A6; margin: 0;">MacBook</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Service Lokasi --}}
        <div style="margin-top: 20px; width: 100%; max-width: 600px; border-radius: 20px; background: #F5F5F7; padding: 24px 28px; text-align: center; border: 1px solid #E5E5EA;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 8px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="width: 22px; height: 22px; color: #1D1D1F; flex-shrink: 0;">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                <h3 style="font-size: 16px; font-weight: 600; color: #1D1D1F; margin: 0;">Bisa Service di Lokasi Langsung</h3>
            </div>
            <p style="font-size: 13px; font-weight: 400; color: #86868B; line-height: 1.6; margin: 0;">Kami melayani perbaikan dan servis iPhone, iPad, Mac, dan Apple Watch<br>langsung di lokasi Anda. Gratis biaya kunjungan untuk area tertentu!</p>
        </div>
    </main>

    <script>
    const showcaseData = [
        { label: 'Produk Apple Lengkap' },
        { label: 'Pantau Stok Real-time' },
        { label: 'Catat Penjualan Cepat' },
        { label: 'Laporan & Analisis' }
    ];
    let currentIdx = 0;
    let showcaseTimer = null;

    function startShowcase() {
        const el = document.getElementById('showcase');
        el.style.display = 'flex';
        el.style.opacity = '0';
        requestAnimationFrame(() => { el.style.opacity = '1'; });

        currentIdx = 0;
        updateSlide(0);
        showcaseTimer = setInterval(nextSlide, 2400);
    }

    function updateSlide(idx) {
        const slides = document.querySelectorAll('.showcase-slide');
        const bars = document.querySelectorAll('.p-bar');

        slides.forEach((s, i) => {
            s.classList.remove('active', 'exit');
            if (i < idx) s.classList.add('exit');
            if (i === idx) s.classList.add('active');
        });

        bars.forEach((b, i) => {
            b.classList.remove('active', 'done');
            if (i < idx) b.classList.add('done');
            if (i === idx) b.classList.add('active');
        });

        document.getElementById('showcaseLabel').textContent = showcaseData[idx].label;
        document.getElementById('showcaseEnterBtn').classList.remove('show');
    }

    function nextSlide() {
        currentIdx++;
        if (currentIdx >= showcaseData.length) {
            clearInterval(showcaseTimer);
            setTimeout(() => {
                document.getElementById('showcaseEnterBtn').classList.add('show');
            }, 300);
            return;
        }
        updateSlide(currentIdx);
    }

    function enterShowcase() {
        const overlay = document.getElementById('showcase');
        overlay.classList.add('showcase-exit');
        setTimeout(() => {
            window.location.href = '{{ route("login") }}';
        }, 800);
    }
    </script>
</body>
</html>
