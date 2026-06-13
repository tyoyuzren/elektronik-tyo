<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="font-heading font-bold text-2xl text-text tracking-tight">Detail Kategori</h1>
            <p class="text-text-muted text-sm mt-1">Informasi lengkap kategori</p>
        </div>

        <div class="card max-w-2xl">
            <div class="flex gap-6">
                <div class="shrink-0">
                    @if ($kategori->gambar)
                        <img src="{{ imgUrl($kategori->gambar) }}" class="w-32 h-24 object-cover rounded-xl border border-border">
                    @else
                        <div class="w-32 h-24 bg-surface-100 border border-border rounded-xl flex items-center justify-center">
                            <i class="ph ph-tag text-3xl text-border"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <table class="w-full">
                        <tr>
                            <td class="py-2 font-bold text-text-muted text-sm w-1/3">Nama Kategori</td>
                            <td class="py-2 text-text font-semibold">{{ $kategori->nama_kategori }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-bold text-text-muted text-sm">Deskripsi</td>
                            <td class="py-2 text-text">{{ $kategori->deskripsi ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 font-bold text-text-muted text-sm">Dibuat</td>
                            <td class="py-2 text-text">{{ $kategori->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-border/50 flex gap-3">
                <a href="{{ route('kategori.index') }}" class="btn-ghost">Kembali</a>
                <a href="{{ route('produk.index', ['kategori_id' => $kategori->id]) }}" class="btn-primary !px-3 !py-1.5 text-sm">
                    <i class="ph ph-package"></i> Lihat Produk
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
