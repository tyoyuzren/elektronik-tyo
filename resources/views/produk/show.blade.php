<x-app-layout>
    <div class="p-6">
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('produk.index') }}" class="btn-ghost !px-2.5 !py-2">
                <i class="ph ph-arrow-left text-base"></i>
            </a>
            <div>
                <h1 class="font-bold text-2xl text-text tracking-tight">Detail Produk</h1>
                <p class="text-text-muted text-sm mt-1">Informasi lengkap produk</p>
            </div>
        </div>

        <div class="card max-w-4xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    @if ($produk->gambar)
                        <img src="{{ imgUrl($produk->gambar) }}" class="w-full rounded-xl border border-border">
                    @else
                        <div class="bg-surface-100 border border-border rounded-xl aspect-square flex items-center justify-center">
                            <div class="text-center">
                                <i class="ph ph-package text-6xl text-border block"></i>
                                <span class="text-border text-sm mt-2 block">Tidak ada gambar</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <div class="mb-4">
                        <span class="badge-neutral text-xs">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                    </div>
                    <h1 class="font-bold text-2xl text-text mb-4 leading-tight">{{ $produk->nama_produk }}</h1>
                    <p class="font-mono font-bold text-3xl text-primary-light mb-6">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>

                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-sm font-bold text-text-muted">Stok:</span>
                        <span class="font-mono font-bold text-xl {{ $produk->stok > 10 ? 'text-accent-green' : ($produk->stok > 0 ? 'text-accent-orange' : 'text-accent-red') }}">{{ $produk->stok }}</span>
                        @if ($produk->stok == 0)
                            <span class="badge-danger text-xs">Stok Habis</span>
                        @elseif ($produk->stok <= 5)
                            <span class="badge-warning text-xs">Stok Menipis</span>
                        @else
                            <span class="badge-success text-xs">Stok Tersedia</span>
                        @endif
                    </div>

                    <div class="border-t border-border/50 pt-4 mb-6">
                        <table class="w-full text-sm">
                            <tr>
                                <td class="py-1.5 font-bold text-text-muted w-1/3">Dibuat</td>
                                <td class="py-1.5 text-text">{{ $produk->created_at->format('d M Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="py-1.5 font-bold text-text-muted">Diperbarui</td>
                                <td class="py-1.5 text-text">{{ $produk->updated_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>

                    @if ($produk->stok > 0)
                    <div class="border-t border-border/50 pt-4 mb-4">
                        <div class="flex items-center gap-3 mb-4">
                            <label class="text-sm font-bold text-text-muted">Jumlah:</label>
                            <div class="flex items-center border border-border rounded-lg bg-surface-200">
                                <button type="button" id="qtyDec" class="w-9 h-9 flex items-center justify-center text-text-muted hover:text-text text-sm rounded-l-lg">-</button>
                                <input type="text" id="qtyDisplay" class="w-12 text-center bg-transparent text-text text-sm font-mono font-bold border-x border-border" value="1" readonly>
                                <button type="button" id="qtyInc" class="w-9 h-9 flex items-center justify-center text-text-muted hover:text-text text-sm rounded-r-lg" data-max="{{ $produk->stok }}">+</button>
                            </div>
                            <span class="text-xs text-text-muted">Maks. {{ $produk->stok }}</span>
                        </div>
                        <div class="flex gap-3">
                            <form action="{{ route('cart.addQuick') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <input type="hidden" name="qty" id="cartQty" value="1">
                                <button type="submit" class="w-full btn-ghost !px-4 !py-2.5 text-sm">
                                    <i class="ph ph-shopping-cart text-base"></i>
                                    Tambah ke Keranjang
                                </button>
                            </form>
                            <form action="{{ route('buy.now') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <input type="hidden" name="qty" id="buyQty" value="1">
                                <button type="submit" class="w-full btn-primary !px-4 !py-2.5 text-sm">
                                    <i class="ph ph-lightning text-base"></i>
                                    Beli Langsung
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="border-t border-border/50 pt-4 mb-4">
                        <button disabled class="w-full btn-ghost !px-4 !py-2.5 text-sm opacity-50 cursor-not-allowed">
                            <i class="ph ph-x-circle text-base"></i>
                            Stok Habis
                        </button>
                    </div>
                    @endif

                    <div class="flex gap-3">
                        <a href="{{ route('produk.edit', $produk) }}" class="btn-primary !px-3 !py-1.5 text-xs">
                            <i class="ph ph-pencil-simple"></i> Edit
                        </a>
                        <form action="{{ route('produk.destroy', $produk) }}" method="POST" onsubmit="return confirm('Yakin hapus {{ $produk->nama_produk }}?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger !px-3 !py-1.5 text-xs">
                                <i class="ph ph-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const qtyDisplay = document.getElementById('qtyDisplay');
        const qtyDec = document.getElementById('qtyDec');
        const qtyInc = document.getElementById('qtyInc');
        const cartQty = document.getElementById('cartQty');
        const buyQty = document.getElementById('buyQty');
        const maxQty = parseInt(qtyInc.dataset.max) || 1;

        function updateQty(val) {
            qtyDisplay.value = val;
            cartQty.value = val;
            buyQty.value = val;
        }

        qtyDec.addEventListener('click', () => {
            let val = parseInt(qtyDisplay.value) || 1;
            if (val > 1) updateQty(val - 1);
        });

        qtyInc.addEventListener('click', () => {
            let val = parseInt(qtyDisplay.value) || 1;
            if (val < maxQty) updateQty(val + 1);
        });
    </script>
    @endpush
</x-app-layout>
