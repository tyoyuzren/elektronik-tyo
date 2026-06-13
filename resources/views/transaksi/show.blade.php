<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="font-heading font-bold text-2xl text-text tracking-tight">Detail Transaksi</h1>
            <p class="text-text-muted text-sm mt-1">Nota transaksi penjualan</p>
        </div>

        <div class="card max-w-4xl">
            <div class="mb-6 p-5 bg-surface-100 border border-border rounded-xl">
                <div class="flex items-center gap-3 mb-3 pb-3 border-b border-border/30">
                    <div class="w-9 h-9 bg-primary/10 border border-primary/20 rounded-xl flex items-center justify-center">
                        <i class="ph ph-receipt text-base text-primary-light"></i>
                    </div>
                    <div>
                        <span class="text-xs text-text-muted font-semibold uppercase tracking-wider">No. Transaksi</span>
                        <p class="font-mono font-bold text-text">INV-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-text-muted font-semibold">Tanggal</span>
                        <p class="font-mono text-text mt-0.5">{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</p>
                    </div>
                    <div>
                        <span class="text-text-muted font-semibold">Kasir</span>
                        <p class="font-semibold text-text mt-0.5">{{ $transaksi->user->name ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->detail as $d)
                        <tr>
                            <td class="font-mono text-text-muted">{{ $loop->iteration }}</td>
                            <td class="font-semibold">{{ $d->produk->nama_produk ?? '-' }}</td>
                            <td class="font-mono">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                            <td class="font-mono">{{ $d->qty }}</td>
                            <td class="font-mono font-bold text-primary-light">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 p-5 bg-surface border border-border rounded-xl">
                <div class="flex justify-between items-center">
                    <span class="font-heading font-bold text-lg text-text-muted">Total</span>
                    <span class="font-heading font-bold text-2xl text-accent-green">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-border/50 flex gap-3">
                <a href="{{ route('transaksi.cetak', $transaksi) }}" class="btn-primary">
                    <i class="ph ph-printer"></i>
                    Cetak Resi
                </a>
                <a href="{{ route('transaksi.index') }}" class="btn-ghost">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
