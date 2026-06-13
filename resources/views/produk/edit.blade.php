<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="font-bold text-2xl text-text tracking-tight">Edit Produk</h1>
            <p class="text-text-muted text-sm mt-1">Perbarui data produk</p>
        </div>

        <div class="card max-w-2xl">
            <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <input type="hidden" name="previous_url" value="{{ url()->previous() }}">

                <div class="mb-5">
                    <label class="label">Nama Produk</label>
                    <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="input" required>
                    @error('nama_produk') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="label">Kategori</label>
                    <div class="relative">
                        <i class="ph ph-tag absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted/40 text-sm pointer-events-none"></i>
                        <select name="category_id" class="select pl-10" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('category_id', $produk->category_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-5">
                        <label class="label">Harga (Rp)</label>
                        <div class="relative">
                            <i class="ph ph-currency-circle-dollar absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted/40 text-sm pointer-events-none"></i>
                            <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="input pl-10" required>
                        </div>
                        @error('harga') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div class="mb-5">
                        <label class="label">Stok</label>
                        <div class="relative">
                            <i class="ph ph-cube absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted/40 text-sm pointer-events-none"></i>
                            <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" class="input pl-10" required>
                        </div>
                        @error('stok') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-5">
                    <label class="label">URL Gambar</label>
                    <div class="relative">
                        <i class="ph ph-image absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted/40 text-sm pointer-events-none"></i>
                        <input type="url" name="gambar_url" value="{{ old('gambar_url') }}" class="input pl-10" placeholder="https://example.com/gambar.jpg">
                    </div>
                    @error('gambar_url') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="label">Atau Upload File Gambar</label>
                    @if ($produk->gambar)
                        <div class="mb-2.5">
                            <img src="{{ imgUrl($produk->gambar) }}" class="w-20 h-20 object-cover rounded-lg border border-border">
                        </div>
                    @endif
                    <div class="relative">
                        <input type="file" name="gambar" class="input file:mr-3 file:px-3 file:py-1.5 file:rounded-lg file:border file:border-border file:bg-surface-100 file:text-text file:text-sm file:font-semibold file:cursor-pointer hover:file:bg-surface-200 transition-all">
                    </div>
                    @error('gambar') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="btn-primary"><i class="ph ph-check"></i> Update</button>
                    <a href="{{ route('produk.index') }}" class="btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
