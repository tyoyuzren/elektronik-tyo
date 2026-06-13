<x-app-layout>
    {{-- Welcome Animation Overlay (Apple Premium) --}}
    <div x-data="welcomeAnimation()" x-show="show"
         x-transition:leave="transition-all duration-1000 ease-out"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-110"
         class="welcome-overlay">
        <div class="welcome-glow"></div>
        <div class="welcome-logo">
            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
            </svg>
        </div>
        <h1 class="welcome-title">Welcome</h1>
        <p class="welcome-subtitle">{{ Auth::user()->name }}</p>
        <div class="welcome-bar">
            <div class="welcome-bar-fill"></div>
        </div>
    </div>

    <div class="px-4 sm:px-6 py-6 lg:py-8 space-y-6">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="font-bold text-2xl lg:text-3xl text-text tracking-tight">
                    Selamat datang, {{ Auth::user()->name }}
                </h1>
                <p class="text-text-muted text-sm mt-1">{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('produk.create') }}" class="btn-ghost text-sm">
                    <i class="ph ph-package-plus text-base"></i>
                    Tambah Produk
                </a>
                <a href="{{ route('transaksi.create') }}" class="btn-primary text-sm">
                    <i class="ph ph-plus-circle text-base"></i>
                    Transaksi Baru
                </a>
            </div>
        </div>

        {{-- Promo Banner & Service --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 animate-slide-up" style="animation-delay:50ms">
            <div class="lg:col-span-2 rounded-2xl overflow-hidden" style="background: linear-gradient(135deg, #1D1D1F 0%, #333333 100%);">
                <div class="p-5 flex items-center justify-between gap-4">
                    <div>
                        <span class="inline-block bg-white/15 text-white text-[10px] font-semibold px-2.5 py-1 rounded-full mb-2">PROMO SPESIAL</span>
                        <h3 class="text-white font-bold text-base">Diskon Hingga 20%</h3>
                        <p class="text-white/60 text-xs mt-0.5">iPhone, MacBook & aksesoris terpilih</p>
                    </div>
                    <div class="flex items-center gap-4 shrink-0">
                        <div class="text-center">
                            <p class="text-white font-bold text-lg">10%</p>
                            <p class="text-white/50 text-[10px]">iPhone</p>
                        </div>
                        <div class="text-center">
                            <p class="text-white font-bold text-lg">20%</p>
                            <p class="text-white/50 text-[10px]">Aksesoris</p>
                        </div>
                        <div class="text-center">
                            <p class="text-white font-bold text-lg">15%</p>
                            <p class="text-white/50 text-[10px]">MacBook</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl p-5 flex items-center gap-3" style="background-color: var(--color-surface); border: 1px solid var(--color-border);">
                <div class="w-10 h-10 rounded-xl bg-primary/10 border border-primary/20 flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; color: var(--color-text);">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
                        <circle cx="12" cy="10" r="3"/>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-text">Service Lokasi</h4>
                    <p class="text-text-muted text-xs mt-0.5">Bisa service di lokasi langsung</p>
                </div>
            </div>
        </div>

        {{-- KPI Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="card p-5 animate-slide-up">
                <div class="flex items-center gap-4">
                    <div class="kpi-icon bg-gradient-to-br from-primary/20 to-primary/5 border border-primary/20">
                        <i class="ph ph-package text-xl text-primary-light"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="metric-label">Total Produk</p>
                        <p class="metric-value">{{ $totalProduk }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-3 divider flex items-center gap-1.5 text-xs text-text-muted">
                    <i class="ph ph-cube"></i>
                    <span>Jumlah produk tersedia</span>
                </div>
            </div>

            <div class="card p-5 animate-slide-up" style="animation-delay:50ms">
                <div class="flex items-center gap-4">
                    <div class="kpi-icon bg-gradient-to-br from-accent-cyan/20 to-accent-cyan/5 border border-accent-cyan/20">
                        <i class="ph ph-tag text-xl text-accent-cyan"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="metric-label">Total Kategori</p>
                        <p class="metric-value">{{ $totalKategori }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-3 divider flex items-center gap-1.5 text-xs text-text-muted">
                    <i class="ph ph-folder-open"></i>
                    <span>Kelompok produk</span>
                </div>
            </div>

            <div class="card p-5 animate-slide-up" style="animation-delay:100ms">
                <div class="flex items-center gap-4">
                    <div class="kpi-icon bg-gradient-to-br from-accent-orange/20 to-accent-orange/5 border border-accent-orange/20">
                        <i class="ph ph-receipt text-xl text-accent-orange"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="metric-label">Total Transaksi</p>
                        <p class="metric-value">{{ $totalTransaksi }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-3 divider flex items-center gap-1.5 text-xs text-text-muted">
                    <i class="ph ph-arrow-circle-right"></i>
                    <span>Seluruh transaksi</span>
                </div>
            </div>

            <div class="card p-5 animate-slide-up" style="animation-delay:150ms">
                <div class="flex items-center gap-4">
                    <div class="kpi-icon bg-gradient-to-br from-accent-green/20 to-accent-green/5 border border-accent-green/20">
                        <i class="ph ph-currency-circle-dollar text-xl text-accent-green"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="metric-label">Total Omzet</p>
                        <p class="metric-value text-accent-green">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="mt-4 pt-3 divider flex items-center gap-1.5 text-xs text-text-muted">
                    <i class="ph ph-trend-up"></i>
                    <span>Pendapatan keseluruhan</span>
                </div>
            </div>
        </div>

        {{-- Main Grid: Recent Transactions + Top Products --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Recent Transactions --}}
            <div class="lg:col-span-2 card overflow-hidden animate-slide-up" style="animation-delay:200ms">
                <div class="card-header">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-primary/10 border border-primary/20 flex items-center justify-center">
                            <i class="ph ph-clock-counter-clockwise text-base text-primary-light"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-sm text-text">Transaksi Terbaru</h2>
                            <p class="text-text-muted text-xs">{{ $transaksiTerbaru->count() }} transaksi terakhir</p>
                        </div>
                    </div>
                    <a href="{{ route('transaksi.index') }}" class="btn-ghost !px-3 !py-1.5 text-xs">
                        Lihat Semua
                        <i class="ph ph-arrow-right text-xs"></i>
                    </a>
                </div>

                @if ($transaksiTerbaru->count())
                    <div class="divide-y divide-border/30">
                        @foreach ($transaksiTerbaru as $t)
                        <div class="flex items-center justify-between px-6 py-3.5 hover:bg-glass-white transition-colors">
                            <div class="flex items-center gap-4 min-w-0">
                                <div class="w-10 h-10 rounded-xl bg-surface-100 border border-border flex items-center justify-center shrink-0">
                                    <span class="font-mono font-bold text-xs text-text-muted">#{{ str_pad($t->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold text-sm text-text">{{ $t->user->name ?? '-' }}</span>
                                        <span class="text-text-muted text-xs">{{ \Carbon\Carbon::parse($t->tanggal)->format('d M') }}</span>
                                    </div>
                                    <span class="text-text-muted text-xs">{{ $t->detail->sum('qty') }} item terjual</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0 ml-4">
                                <p class="font-mono font-bold text-sm text-text">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-14 text-text-muted">
                        <div class="w-14 h-14 rounded-2xl bg-surface-100 border border-border flex items-center justify-center mb-3">
                            <i class="ph ph-receipt text-2xl text-text-dim"></i>
                        </div>
                        <p class="font-medium text-sm">Belum ada transaksi</p>
                        <p class="text-xs text-text-dim mt-0.5">Mulai catat penjualan sekarang</p>
                    </div>
                @endif
            </div>

            {{-- Top Products --}}
            <div class="card overflow-hidden animate-slide-up" style="animation-delay:250ms">
                <div class="card-header">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-accent-orange/15 to-accent-yellow/5 border border-accent-orange/20 flex items-center justify-center">
                            <i class="ph ph-trend-up text-base text-accent-orange"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-sm text-text">Produk Terlaris</h2>
                            <p class="text-text-muted text-xs">Berdasarkan jumlah terjual</p>
                        </div>
                    </div>
                </div>

                @if ($produkTerlaris->count())
                    <div class="divide-y divide-border/30">
                        @foreach ($produkTerlaris as $item)
                        <div class="flex items-center gap-4 px-6 py-3.5 hover:bg-glass-white transition-colors">
                            <span class="font-bold text-lg w-7 text-center {{ $loop->first ? 'text-accent-orange' : ($loop->index < 3 ? 'text-text-muted' : 'text-text-dim') }}">{{ $loop->iteration }}</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-text truncate">{{ $item->produk->nama_produk ?? '-' }}</p>
                                <p class="text-text-muted text-xs">{{ $item->produk->kategori->nama_kategori ?? '' }}</p>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="font-mono font-bold text-sm text-primary-light">{{ $item->total_qty }}x</p>
                                <p class="text-text-muted text-xs">terjual</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-14 text-text-muted">
                        <div class="w-14 h-14 rounded-2xl bg-surface-100 border border-border flex items-center justify-center mb-3">
                            <i class="ph ph-package text-2xl text-text-dim"></i>
                        </div>
                        <p class="font-medium text-sm">Belum ada data</p>
                        <p class="text-xs text-text-dim mt-0.5">Produk akan muncul setelah terjual</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Bottom Grid: Low Stock + Quick Actions --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

            {{-- Low Stock --}}
            <div class="card overflow-hidden animate-slide-up" style="animation-delay:300ms">
                <div class="card-header">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-accent-red/10 border border-accent-red/20 flex items-center justify-center">
                            <i class="ph ph-warning-circle text-base text-accent-red"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-sm text-text">Stok Menipis</h2>
                            <p class="text-text-muted text-xs">Produk dengan stok kritis</p>
                        </div>
                    </div>
                    <a href="{{ route('produk.index') }}" class="btn-ghost !px-3 !py-1.5 text-xs">
                        Lihat Semua
                        <i class="ph ph-arrow-right text-xs"></i>
                    </a>
                </div>

                @if ($stokMenipis->count())
                    <div class="divide-y divide-border/30">
                        @foreach ($stokMenipis as $p)
                        <div class="flex items-center justify-between px-6 py-3.5 hover:bg-glass-white transition-colors">
                            <div class="flex items-center gap-3 min-w-0">
                                @if ($p->gambar)
                                    <img src="{{ imgUrl($p->gambar) }}" class="w-10 h-10 object-cover rounded-xl border border-border shrink-0" loading="lazy">
                                @else
                                    <div class="w-10 h-10 rounded-xl bg-surface-100 border border-border flex items-center justify-center shrink-0 text-text-muted text-xs">&mdash;</div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-text truncate">{{ $p->nama_produk }}</p>
                                    <p class="text-text-muted text-xs">{{ $p->kategori->nama_kategori ?? '' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 shrink-0 ml-3">
                                <div class="w-20 progress-bar">
                                    <div class="progress-fill {{ $p->stok == 0 ? 'bg-accent-red' : 'bg-accent-orange' }}" style="width: {{ min(($p->stok / 10) * 100, 100) }}%"></div>
                                </div>
                                <span class="font-mono font-bold text-sm min-w-[3ch] text-right {{ $p->stok == 0 ? 'text-accent-red' : 'text-accent-orange' }}">{{ $p->stok }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-14 text-text-muted">
                        <div class="w-14 h-14 rounded-2xl bg-surface-100 border border-border flex items-center justify-center mb-3">
                            <i class="ph ph-check-circle text-2xl text-accent-green"></i>
                        </div>
                        <p class="font-medium text-sm">Semua stok aman</p>
                        <p class="text-xs text-text-dim mt-0.5">Tidak ada produk dengan stok kritis</p>
                    </div>
                @endif
            </div>

            {{-- Quick Actions --}}
            <div class="card overflow-hidden animate-slide-up" style="animation-delay:350ms">
                <div class="card-header">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-accent-green/10 border border-accent-green/20 flex items-center justify-center">
                            <i class="ph ph-lightning text-base text-accent-green"></i>
                        </div>
                        <div>
                            <h2 class="font-bold text-sm text-text">Akses Cepat</h2>
                            <p class="text-text-muted text-xs">Tindakan bisnis harian</p>
                        </div>
                    </div>
                </div>
                <div class="p-5 grid grid-cols-2 gap-3">
                    <a href="{{ route('transaksi.create') }}" class="flex flex-col items-center justify-center gap-2.5 p-5 rounded-2xl bg-surface-100 border border-border hover:border-accent-green/25 hover:bg-accent-green/[0.02] transition-all group">
                        <div class="w-11 h-11 rounded-2xl bg-accent-green/10 border border-accent-green/20 flex items-center justify-center group-hover:bg-accent-green/15 transition-colors">
                            <i class="ph ph-plus-circle text-xl text-accent-green"></i>
                        </div>
                        <span class="text-sm font-bold text-text">Transaksi Baru</span>
                        <span class="text-xs text-text-muted">Catat penjualan</span>
                    </a>
                    <a href="{{ route('produk.create') }}" class="flex flex-col items-center justify-center gap-2.5 p-5 rounded-2xl bg-surface-100 border border-border hover:border-primary/25 hover:bg-primary/[0.02] transition-all group">
                        <div class="w-11 h-11 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center group-hover:bg-primary/15 transition-colors">
                            <i class="ph ph-package-plus text-xl text-primary-light"></i>
                        </div>
                        <span class="text-sm font-bold text-text">Tambah Produk</span>
                        <span class="text-xs text-text-muted">Input produk baru</span>
                    </a>
                    <a href="{{ route('kategori.create') }}" class="flex flex-col items-center justify-center gap-2.5 p-5 rounded-2xl bg-surface-100 border border-border hover:border-accent-cyan/25 hover:bg-accent-cyan/[0.02] transition-all group">
                        <div class="w-11 h-11 rounded-2xl bg-accent-cyan/10 border border-accent-cyan/20 flex items-center justify-center group-hover:bg-accent-cyan/15 transition-colors">
                            <i class="ph ph-tag-plus text-xl text-accent-cyan"></i>
                        </div>
                        <span class="text-sm font-bold text-text">Kategori Baru</span>
                        <span class="text-xs text-text-muted">Buat kelompok produk</span>
                    </a>
                    <a href="{{ route('produk.index') }}?search=" class="flex flex-col items-center justify-center gap-2.5 p-5 rounded-2xl bg-surface-100 border border-border hover:border-accent-orange/25 hover:bg-accent-orange/[0.02] transition-all group">
                        <div class="w-11 h-11 rounded-2xl bg-accent-orange/10 border border-accent-orange/20 flex items-center justify-center group-hover:bg-accent-orange/15 transition-colors">
                            <i class="ph ph-magnifying-glass text-xl text-accent-orange"></i>
                        </div>
                        <span class="text-sm font-bold text-text">Cari Produk</span>
                        <span class="text-xs text-text-muted">Temukan produk cepat</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
