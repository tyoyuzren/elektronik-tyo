<nav id="sidebar" class="fixed top-16 left-0 bottom-0 w-64 z-40 bg-surface/95 backdrop-blur-xl border-r border-border transform -translate-x-full md:hidden transition-transform duration-200 overflow-y-auto">
    <div class="p-4 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all duration-100
                  {{ request()->routeIs('dashboard') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-text-muted hover:text-text hover:bg-glass-white border border-transparent' }}">
            <span class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-primary/15 text-primary' : 'bg-surface-200 text-text-muted' }}">
                <i class="ph ph-layout text-sm"></i>
            </span>
            Dashboard
        </a>

        <a href="{{ route('kategori.index') }}"
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all duration-100
                  {{ request()->routeIs('kategori.*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-text-muted hover:text-text hover:bg-glass-white border border-transparent' }}">
            <span class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('kategori.*') ? 'bg-primary/15 text-primary' : 'bg-surface-200 text-text-muted' }}">
                <i class="ph ph-tag text-sm"></i>
            </span>
            Kategori
        </a>

        <a href="{{ route('produk.index') }}"
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all duration-100
                  {{ request()->routeIs('produk.*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-text-muted hover:text-text hover:bg-glass-white border border-transparent' }}">
            <span class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('produk.*') ? 'bg-primary/15 text-primary' : 'bg-surface-200 text-text-muted' }}">
                <i class="ph ph-package text-sm"></i>
            </span>
            Produk
        </a>

        <a href="{{ route('cart.index') }}"
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all duration-100
                  {{ request()->routeIs('cart.*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-text-muted hover:text-text hover:bg-glass-white border border-transparent' }}">
            <span class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('cart.*') ? 'bg-primary/15 text-primary' : 'bg-surface-200 text-text-muted' }}">
                <i class="ph ph-shopping-cart text-sm"></i>
            </span>
            Keranjang
            @php $cartCount = app(App\Services\CartService::class)->count(); @endphp
            @if ($cartCount > 0)
                <span class="ml-auto bg-accent-green text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center">{{ $cartCount }}</span>
            @endif
        </a>

        <a href="{{ route('transaksi.index') }}"
           class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all duration-100
                  {{ request()->routeIs('transaksi.*') ? 'bg-primary/10 text-primary border border-primary/20' : 'text-text-muted hover:text-text hover:bg-glass-white border border-transparent' }}">
            <span class="flex items-center justify-center w-8 h-8 rounded-xl {{ request()->routeIs('transaksi.*') ? 'bg-primary/15 text-primary' : 'bg-surface-200 text-text-muted' }}">
                <i class="ph ph-receipt text-sm"></i>
            </span>
            Transaksi
        </a>
    </div>

    <div class="border-t border-border px-6 py-4">
        <div class="flex items-center gap-2.5 text-xs text-text-muted">
            <div class="w-2 h-2 rounded-full bg-accent-green animate-pulse-soft"></div>
            TYO Elektronik v1.0
        </div>
    </div>
</nav>

{{-- Overlay --}}
<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('sidebarToggle');
        if (toggle) {
            toggle.addEventListener('click', toggleSidebar);
        }
    });
</script>
