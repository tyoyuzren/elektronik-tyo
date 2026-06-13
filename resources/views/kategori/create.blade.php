<x-app-layout>
    <div class="p-6">
        <div class="mb-6">
            <h1 class="font-heading font-bold text-2xl text-text tracking-tight">Tambah Kategori</h1>
            <p class="text-text-muted text-sm mt-1">Buat kategori produk baru</p>
        </div>

        <div class="card max-w-2xl">
            <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label class="label">Nama Kategori</label>
                    <div class="relative">
                        <i class="ph ph-tag absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted/40 text-sm pointer-events-none"></i>
                        <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" class="input pl-10" required>
                    </div>
                    @error('nama_kategori') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="mb-5">
                    <label class="label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="input">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
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
                    <div class="relative">
                        <input type="file" name="gambar" class="input file:mr-3 file:px-3 file:py-1.5 file:rounded-lg file:border file:border-border file:bg-surface-100 file:text-text file:text-sm file:font-semibold file:cursor-pointer hover:file:bg-surface-200 transition-all">
                    </div>
                    @error('gambar') <p class="text-accent-red text-xs mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="btn-primary"><i class="ph ph-check"></i> Simpan</button>
                    <a href="{{ route('kategori.index') }}" class="btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
