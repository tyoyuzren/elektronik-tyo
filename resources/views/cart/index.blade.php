<x-app-layout>
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-bold text-2xl text-text tracking-tight">Keranjang Belanja</h1>
                <p class="text-text-muted text-sm mt-1">Kelola produk sebelum checkout</p>
            </div>
            <a href="{{ route('produk.index') }}" class="btn-ghost !px-3 !py-1.5 text-xs">
                <i class="ph ph-package text-sm"></i>
                Lanjut Belanja
            </a>
        </div>

        @if (session('error'))
            <div class="mb-4 animate-slide-down">
                <div class="flex items-center gap-2.5 px-5 py-3 bg-accent-red/10 border border-accent-red/30 rounded-lg text-sm font-semibold text-accent-red">
                    <i class="ph ph-x-circle text-base"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (empty($cartItems))
            <div class="card text-center py-16">
                <div class="w-20 h-20 bg-surface-100 border border-border rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ph ph-shopping-cart text-4xl text-border"></i>
                </div>
                <h2 class="font-bold text-lg text-text mb-2">Keranjang Kosong</h2>
                <p class="text-text-muted text-sm mb-6">Belum ada produk di keranjang Anda</p>
                <a href="{{ route('produk.index') }}" class="btn-primary">
                    <i class="ph ph-package text-sm"></i>
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @php $produkIds = array_keys($cartItems); @endphp
                    @foreach ($cartItems as $id => $item)
                    <div class="card p-4 flex flex-col sm:flex-row gap-4">
                        <div class="w-full sm:w-24 h-24 bg-surface-100 rounded-xl border border-border overflow-hidden shrink-0">
                            @if ($item['gambar'])
                                <img src="{{ imgUrl($item['gambar']) }}" class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="ph ph-package text-2xl text-border"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-sm text-text">{{ $item['nama'] }}</h3>
                            <p class="font-mono font-bold text-base text-primary-light mt-1">Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-border/30">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <label class="text-xs font-semibold text-text-muted">Qty:</label>
                                    <div class="flex items-center gap-1">
                                        <button type="button" class="qty-minus w-8 h-8 rounded-lg bg-surface-200 border border-border text-text-muted hover:text-text transition-colors text-sm flex items-center justify-center" data-id="{{ $id }}">-</button>
                                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stok'] }}"
                                               class="qty-input w-14 text-center input !py-1.5 !px-1 text-sm" data-id="{{ $id }}">
                                        <button type="button" class="qty-plus w-8 h-8 rounded-lg bg-surface-200 border border-border text-text-muted hover:text-text transition-colors text-sm flex items-center justify-center" data-id="{{ $id }}">+</button>
                                    </div>
                                    <button type="submit" class="btn-ghost !px-2 !py-1 text-xs">
                                        <i class="ph ph-check text-sm"></i>
                                    </button>
                                </form>
                                <div class="flex items-center gap-3">
                                    <span class="font-mono font-bold text-sm text-accent-green">Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-text-muted/60 hover:text-accent-red transition-colors p-1.5" title="Hapus">
                                            <i class="ph ph-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Summary --}}
                <div class="lg:col-span-1">
                    <div class="card p-5 sticky top-24">
                        <h3 class="font-bold text-sm text-text mb-4">Ringkasan Belanja</h3>
                        <div class="space-y-3 text-sm">
                            @php $totalItems = array_sum(array_column($cartItems, 'qty')); @endphp
                            <div class="flex justify-between text-text-muted">
                                <span>Total Barang</span>
                                <span class="font-semibold text-text">{{ $totalItems }} item</span>
                            </div>
                            <div class="border-t border-border/30 pt-3 flex justify-between items-center">
                                <span class="font-bold text-text">Total Harga</span>
                                <span class="font-mono font-bold text-xl text-accent-green">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-success w-full text-sm">
                                    <i class="ph ph-check-circle text-base"></i>
                                    Checkout ({{ $totalItems }})
                                </button>
                            </form>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-danger w-full text-sm" onclick="return confirm('Kosongkan keranjang?')">
                                    <i class="ph ph-trash text-base"></i>
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.qty-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.qty-input');
                let val = parseInt(input.value) || 1;
                if (val > 1) input.value = val - 1;
            });
        });
        document.querySelectorAll('.qty-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.qty-input');
                const max = parseInt(input.getAttribute('max')) || 999;
                let val = parseInt(input.value) || 1;
                if (val < max) input.value = val + 1;
            });
        });
    </script>
    @endpush
</x-app-layout>
