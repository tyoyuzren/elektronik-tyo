<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="font-heading font-bold text-2xl text-text tracking-tight">Transaksi Baru</h1>
            <p class="text-text-muted text-sm mt-1">Pilih produk dan masukkan jumlah</p>
        </div>

        <div class="card">
            <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi">
                @csrf

                <div id="produkContainer" class="space-y-4">
                    <div class="produk-row p-5 bg-surface-100 border border-border rounded-xl">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                            <div class="md:col-span-2">
                                <label class="label">Produk</label>
                                <select name="produk[0][id]" class="produk-select select" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach ($produks as $p)
                                        <option value="{{ $p->id }}" data-harga="{{ $p->harga }}" data-stok="{{ $p->stok }}">
                                            {{ $p->nama_produk }} (Stok: {{ $p->stok }}) - Rp {{ number_format($p->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="label">Jumlah</label>
                                <input type="number" name="produk[0][qty]" class="produk-qty input" min="1" required>
                            </div>
                            <div>
                                <label class="label">Subtotal</label>
                                <input type="text" class="produk-subtotal input bg-surface-50 !text-text-muted" readonly value="Rp 0">
                            </div>
                            <div>
                                <button type="button" class="remove-row btn-danger !px-3 !py-2 w-full text-center text-sm">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6 mb-6">
                    <button type="button" id="addRow" class="btn-ghost text-sm">
                        <i class="ph ph-plus-circle"></i>
                        Tambah Produk
                    </button>
                </div>

                <div class="border-t border-border/50 pt-5 mb-6">
                    <div class="flex justify-end items-center gap-4">
                        <h3 class="font-heading font-bold text-text-muted text-lg">Total:</h3>
                        <span id="totalBayar" class="font-heading font-bold text-2xl text-accent-green">Rp 0</span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-success">
                        <i class="ph ph-check"></i>
                        Simpan Transaksi
                    </button>
                    <a href="{{ route('transaksi.index') }}" class="btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        let rowIndex = 1;

        document.getElementById('addRow').addEventListener('click', function() {
            const container = document.getElementById('produkContainer');
            const template = container.querySelector('.produk-row').cloneNode(true);

            template.querySelectorAll('select, input').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\d+/, rowIndex));
                }
                if (el.tagName === 'SELECT') {
                    el.selectedIndex = 0;
                } else if (el.classList.contains('produk-qty')) {
                    el.value = '';
                } else if (el.classList.contains('produk-subtotal')) {
                    el.value = 'Rp 0';
                }
            });

            container.appendChild(template);
            rowIndex++;
        });

        document.getElementById('produkContainer').addEventListener('change', function(e) {
            if (e.target.classList.contains('produk-select')) {
                hitungSubtotal(e.target);
            }
        });

        document.getElementById('produkContainer').addEventListener('input', function(e) {
            if (e.target.classList.contains('produk-qty')) {
                const row = e.target.closest('.produk-row');
                const select = row.querySelector('.produk-select');
                hitungSubtotal(select);
            }
        });

        document.getElementById('produkContainer').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const rows = document.querySelectorAll('.produk-row');
                if (rows.length > 1) {
                    e.target.closest('.produk-row').remove();
                    hitungTotal();
                }
            }
        });

        function hitungSubtotal(select) {
            const row = select.closest('.produk-row');
            const qty = row.querySelector('.produk-qty').value || 0;
            const harga = select.options[select.selectedIndex]?.dataset?.harga || 0;
            const subtotal = qty * harga;
            row.querySelector('.produk-subtotal').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
            hitungTotal();
        }

        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.produk-subtotal').forEach(el => {
                const angka = parseInt(el.value.replace(/[^0-9]/g, '')) || 0;
                total += angka;
            });
            document.getElementById('totalBayar').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
        }
    </script>
    @endpush
</x-app-layout>
