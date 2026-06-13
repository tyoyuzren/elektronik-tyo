<x-app-layout>
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="font-heading font-bold text-2xl text-text tracking-tight">Kategori</h1>
                <p class="text-text-muted text-sm mt-1">Jelajahi kategori produk elektronik</p>
            </div>
            <a href="{{ route('kategori.create') }}" class="btn-primary !px-3 !py-1.5 text-sm">
                <i class="ph ph-plus"></i>
                Tambah Kategori
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

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
            @forelse ($kategoris as $k)
            <div class="bg-surface-50 border border-border rounded-xl overflow-hidden group transition-all duration-150 hover:shadow-card hover:translate-x-[-2px] hover:translate-y-[-2px] hover:border-border-light active:translate-x-[1px] active:translate-y-[1px] active:shadow-none">
                <a href="{{ route('produk.index', ['kategori_id' => $k->id]) }}" class="block">
                    <div class="aspect-[4/3] bg-surface-100 overflow-hidden relative">
                        @if ($k->gambar)
                            <img src="{{ imgUrl($k->gambar) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="ph ph-tag text-4xl text-border"></i>
                            </div>
                        @endif
                        <div class="absolute top-2.5 right-2.5 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                            <a href="{{ route('kategori.edit', $k) }}" class="bg-surface/80 backdrop-blur-sm border border-border rounded-lg p-1.5 text-text-muted hover:text-primary-light transition-colors" title="Edit">
                                <i class="ph ph-pencil-simple text-sm"></i>
                            </a>
                            <form action="{{ route('kategori.destroy', $k) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori {{ $k->nama_kategori }}? Semua produk dalam kategori ini juga akan terhapus.')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-surface/80 backdrop-blur-sm border border-border rounded-lg p-1.5 text-text-muted hover:text-accent-red transition-colors cursor-pointer" title="Hapus">
                                    <i class="ph ph-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </a>
                <a href="{{ route('produk.index', ['kategori_id' => $k->id]) }}" class="block p-3.5">
                    <h3 class="font-semibold text-sm text-text group-hover:text-primary-light transition-colors truncate">{{ $k->nama_kategori }}</h3>
                    <p class="text-xs text-text-muted mt-1 font-mono">{{ $k->produk_count }} produk</p>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-16 h-16 bg-surface-100 border border-border rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="ph ph-tag text-3xl text-border"></i>
                </div>
                <p class="text-text-muted mb-4">Belum ada kategori.</p>
            <a href="{{ route('kategori.create') }}" class="btn-primary !px-3 !py-1.5 text-sm">
                    <i class="ph ph-plus"></i>
                    Tambah Kategori
                </a>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
