<x-app-layout>
    <div class="p-6 pb-24" id="product-page">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-bold text-2xl text-text tracking-tight">Produk</h1>
                <p class="text-text-muted text-sm mt-1">Jelajahi produk Apple</p>
            </div>
            <div class="flex items-center gap-2">
                <button id="iosSelectBtn" class="ios-mode-btn" type="button" onclick="toggleSelectMode()">
                    <i class="ph ph-checks text-sm" id="selectBtnIcon"></i>
                    <span id="selectBtnText">Pilih</span>
                </button>
                <a href="{{ route('produk.create') }}" class="btn-primary !px-3 !py-1.5 text-xs">
                    <i class="ph ph-plus"></i>
                    Tambah
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 animate-slide-down">
                <div class="flex items-center gap-2.5 px-5 py-3 bg-accent-green/10 border border-accent-green/30 rounded-lg text-sm font-semibold text-accent-green">
                    <i class="ph ph-check-circle text-base"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <form method="GET" action="{{ route('produk.index') }}" class="mb-6">
            <div class="flex flex-wrap gap-3 items-center">
                <div class="flex gap-3 flex-1 min-w-[250px] max-w-lg">
                    <div class="relative flex-1">
                        <i class="ph ph-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted/40 text-sm"></i>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari produk..." class="input pl-10">
                    </div>
                    <button type="submit" class="btn-ghost !px-3">
                        <i class="ph ph-magnifying-glass text-lg"></i>
                    </button>
                    @if ($search || $kategori_id)
                        <a href="{{ route('produk.index') }}" class="btn-danger !px-3">
                            <i class="ph ph-x-circle text-lg"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>

        @if ($kategori_id)
            @php $filterKategori = \App\Models\KategoriProduk::find($kategori_id); @endphp
            @if ($filterKategori)
                <div class="mb-4 animate-slide-down">
                    <div class="flex items-center gap-2.5 px-4 py-2.5 bg-primary/10 border border-primary/20 rounded-lg text-sm font-semibold">
                        <i class="ph ph-funnel text-primary-light"></i>
                        Filter: <span class="text-primary-light">{{ $filterKategori->nama_kategori }}</span>
                        <a href="{{ route('produk.index') }}" class="text-accent-red text-xs font-semibold ml-auto hover:underline underline-offset-2">Hapus filter</a>
                    </div>
                </div>
            @endif
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="productGrid">
            @forelse ($produks as $p)
            <div class="product-card bg-surface-50 border border-border rounded-xl overflow-hidden flex flex-col group transition-all duration-150 hover:shadow-card hover:translate-x-[-2px] hover:translate-y-[-2px] hover:border-border-light active:translate-x-[1px] active:translate-y-[1px] active:shadow-none"
                 data-id="{{ $p->id }}"
                 data-harga="{{ $p->harga }}">
                <div class="ios-select-overlay"></div>
                <div class="ios-checkmark">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>

                <a href="{{ route('produk.show', $p) }}" class="block">
                    <div class="aspect-square bg-surface-100 overflow-hidden relative">
                        @if ($p->gambar)
                            <img src="{{ imgUrl($p->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <i class="ph ph-package text-5xl text-border block"></i>
                                    <span class="text-border text-xs mt-1 block">Tidak ada gambar</span>
                                </div>
                            </div>
                        @endif
                        <div class="absolute top-2.5 left-2.5">
                            <span class="inline-flex items-center px-2 py-0.5 bg-surface/100 backdrop-blur-sm text-text text-[10px] font-semibold rounded-md border border-border">
                                {{ $p->kategori->nama_kategori ?? '-' }}
                            </span>
                        </div>
                        @if ($p->stok == 0)
                            <div class="absolute inset-0 bg-surface/70 flex items-center justify-center">
                                <span class="bg-accent-red text-white text-xs font-bold px-3 py-1 -rotate-12 border border-border">HABIS</span>
                            </div>
                        @elseif ($p->stok <= 5)
                            <div class="absolute top-2.5 right-2.5">
                                <span class="inline-flex items-center px-1.5 py-0.5 bg-accent-orange/90 text-surface text-[10px] font-bold rounded-md border border-accent-orange">Sisa {{ $p->stok }}</span>
                            </div>
                        @endif
                    </div>
                </a>
                <div class="p-3.5 flex flex-col flex-1">
                    <a href="{{ route('produk.show', $p) }}">
                        <h3 class="font-semibold text-sm text-text group-hover:text-primary-light transition-colors leading-snug line-clamp-2">{{ $p->nama_produk }}</h3>
                    </a>
                    <div class="mt-auto pt-3">
                        <p class="font-mono font-bold text-base text-primary-light">Rp{{ number_format($p->harga, 0, ',', '.') }}</p>
                        <div class="flex items-center justify-between mt-2 pt-2 border-t border-border/30">
                            <span class="font-mono text-xs {{ $p->stok > 10 ? 'text-accent-green' : ($p->stok > 0 ? 'text-accent-orange' : 'text-accent-red') }}">
                                <i class="ph ph-cube text-xs mr-0.5"></i> {{ $p->stok }}
                            </span>
                            <div class="flex gap-0.5">
                                <a href="{{ route('produk.edit', $p) }}" class="text-text-muted/60 hover:text-primary-light transition-colors p-1.5 rounded-md hover:bg-surface-200" title="Edit">
                                    <i class="ph ph-pencil-simple text-sm"></i>
                                </a>
                                <form action="{{ route('produk.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin hapus {{ $p->nama_produk }}?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-text-muted/60 hover:text-accent-red transition-colors p-1.5 rounded-md hover:bg-surface-200" title="Hapus">
                                        <i class="ph ph-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @if ($p->stok > 0)
                        <div class="flex items-center gap-1.5 mt-2 pt-2 border-t border-border/30">
                            <div class="flex items-center border border-border rounded-lg bg-surface-200">
                                <button type="button" class="qty-dec w-7 h-7 flex items-center justify-center text-text-muted hover:text-text text-xs rounded-l-lg" data-id="{{ $p->id }}">-</button>
                                <input type="text" class="qty-display w-9 text-center bg-transparent text-text text-xs font-mono border-x border-border" value="1" readonly data-id="{{ $p->id }}">
                                <button type="button" class="qty-inc w-7 h-7 flex items-center justify-center text-text-muted hover:text-text text-xs rounded-r-lg" data-id="{{ $p->id }}" data-max="{{ $p->stok }}">+</button>
                            </div>
                            <form action="{{ route('cart.addQuick') }}" method="POST" class="inline-flex">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $p->id }}">
                                <input type="hidden" name="qty" class="qty-input-hidden" value="1" data-id="{{ $p->id }}">
                                <button type="submit" class="btn-ghost !px-2 !py-1 text-[10px]" title="Tambah ke Keranjang">
                                    <i class="ph ph-shopping-cart text-xs"></i>
                                </button>
                            </form>
                            <form action="{{ route('buy.now') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $p->id }}">
                                <input type="hidden" name="qty" class="qty-input-hidden" value="1" data-id="{{ $p->id }}">
                                <button type="submit" class="w-full btn-primary !px-2 !py-1 text-[10px]">
                                    <i class="ph ph-lightning text-xs"></i>
                                    Beli
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="mt-2 pt-2 border-t border-border/30">
                            <button disabled class="w-full btn-ghost !px-2 !py-1 text-[10px] opacity-50 cursor-not-allowed">
                                <i class="ph ph-x-circle text-xs"></i>
                                Stok Habis
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-16 h-16 bg-surface-100 border border-border rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ph ph-package text-3xl text-border"></i>
                </div>
                <p class="text-text-muted mb-4">Belum ada produk.</p>
            <a href="{{ route('produk.create') }}" class="btn-primary !px-3 !py-1.5 text-xs">
                    <i class="ph ph-plus"></i>
                    Tambah Produk
                </a>
            </div>
            @endforelse
        </div>

        {{-- iOS Selection Bar --}}
        <div class="ios-select-bar" id="iosSelectBar">
            <div>
                <div class="count" id="selectedCount">0 produk dipilih</div>
                <div class="text-xs text-text-muted mt-0.5" id="selectedTotal">Rp 0</div>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="clearSelection()" class="btn-ghost !px-3 !py-1.5 text-xs" id="clearBtn" style="display:none">
                    <i class="ph ph-x text-xs"></i>
                    Batal
                </button>
                <button onclick="addSelectedToCart()" class="btn-primary !px-4 !py-1.5 text-xs" id="addSelectedBtn" style="display:none">
                    <i class="ph ph-shopping-cart text-xs"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelectorAll('.qty-dec').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const display = document.querySelector(`.qty-display[data-id="${id}"]`);
                const hidden = document.querySelector(`.qty-input-hidden[data-id="${id}"]`);
                let val = parseInt(display.value) || 1;
                if (val > 1) {
                    val--;
                    display.value = val;
                    hidden.value = val;
                }
            });
        });
        document.querySelectorAll('.qty-inc').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const max = parseInt(this.dataset.max) || 999;
                const display = document.querySelector(`.qty-display[data-id="${id}"]`);
                const hidden = document.querySelector(`.qty-input-hidden[data-id="${id}"]`);
                let val = parseInt(display.value) || 1;
                if (val < max) {
                    val++;
                    display.value = val;
                    hidden.value = val;
                }
            });
        });
    </script>

    <script>
    let selectMode = false;
    let selected = new Set();

    function toggleSelectMode() {
        selectMode = !selectMode;
        if (!selectMode) clearSelection();

        const btn = document.getElementById('iosSelectBtn');
        const icon = document.getElementById('selectBtnIcon');
        const text = document.getElementById('selectBtnText');

        btn.classList.toggle('active', selectMode);
        icon.className = selectMode ? 'ph ph-x text-sm' : 'ph ph-checks text-sm';
        text.textContent = selectMode ? 'Selesai' : 'Pilih';
    }

    document.getElementById('productGrid').addEventListener('click', function(e) {
        const card = e.target.closest('.product-card');
        if (!card) return;

        const link = e.target.closest('a[href]');
        const form = e.target.closest('form');
        const qtyBtn = e.target.closest('.qty-dec, .qty-inc');

        if (link || form || qtyBtn) return;

        if (selectMode) {
            e.preventDefault();
            const id = parseInt(card.dataset.id);
            if (selected.has(id)) {
                selected.delete(id);
                card.classList.remove('ios-selected');
            } else {
                selected.add(id);
                card.classList.add('ios-selected');
            }
            updateSelectBar();
        }
    });

    document.querySelectorAll('.product-card a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (selectMode) e.stopPropagation();
        });
    });

    function updateSelectBar() {
        const bar = document.getElementById('iosSelectBar');
        const count = document.getElementById('selectedCount');
        const total = document.getElementById('selectedTotal');
        const clearBtn = document.getElementById('clearBtn');
        const addBtn = document.getElementById('addSelectedBtn');
        const len = selected.size;

        bar.classList.toggle('active', selectMode && len > 0);
        count.textContent = len + ' produk dipilih';

        let sum = 0;
        document.querySelectorAll('.product-card.ios-selected').forEach(card => {
            sum += parseInt(card.dataset.harga) || 0;
        });
        total.textContent = 'Rp ' + sum.toLocaleString('id-ID');

        clearBtn.style.display = len > 0 ? '' : 'none';
        addBtn.style.display = len > 0 ? '' : 'none';
    }

    function clearSelection() {
        document.querySelectorAll('.product-card.ios-selected').forEach(card => {
            card.classList.remove('ios-selected');
        });
        selected.clear();
        updateSelectBar();
    }

    function addSelectedToCart() {
        if (selected.size === 0) return;

        const ids = Array.from(selected);
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("cart.addQuick") }}';

        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = document.querySelector('meta[name="csrf-token"]').content;
        form.appendChild(csrf);

        const qty = document.createElement('input');
        qty.type = 'hidden';
        qty.name = 'qty';
        qty.value = 1;
        form.appendChild(qty);

        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'produk_id[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }
    </script>
    @endpush
</x-app-layout>
