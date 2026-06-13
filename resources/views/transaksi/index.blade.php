<x-app-layout>
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-heading font-bold text-2xl text-text tracking-tight">Transaksi</h1>
                <p class="text-text-muted text-sm mt-1">Riwayat transaksi penjualan</p>
            </div>
            <a href="{{ route('transaksi.create') }}" class="btn-success !px-3 !py-1.5 text-xs text-sm">
                <i class="ph ph-plus"></i>
                Transaksi Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 animate-slide-down">
                <div class="flex items-center gap-2.5 px-5 py-3 bg-accent-green/10 border border-accent-green/30 rounded-lg text-sm font-semibold text-accent-green">
                    <i class="ph ph-check-circle text-base"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="bg-surface-50 border border-border rounded-xl overflow-hidden">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Total Item</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $t)
                    <tr>
                        <td class="font-mono text-text-muted">{{ $loop->iteration }}</td>
                        <td class="font-mono">{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center">
                                    <i class="ph ph-user text-[10px] text-primary-light"></i>
                                </div>
                                {{ $t->user->name ?? '-' }}
                            </div>
                        </td>
                        <td class="font-mono">{{ $t->detail->sum('qty') }}</td>
                        <td class="font-mono font-bold text-accent-green">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('transaksi.show', $t) }}" class="btn-primary !px-3 !py-1.5 text-xs">
                                <i class="ph ph-eye"></i>
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-text-muted py-10">Belum ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
