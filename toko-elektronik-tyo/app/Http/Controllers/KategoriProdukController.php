<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriProdukController extends Controller
{
    public function index()
    {
        $kategoris = KategoriProduk::withCount('produk')->latest()->get();
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_url' => 'nullable|url|max:2048',
        ]);

        $data = $request->only(['nama_kategori', 'deskripsi']);

        if ($request->filled('gambar_url')) {
            $data['gambar'] = $request->input('gambar_url');
        } elseif ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('kategori', 'public');
        }

        KategoriProduk::create($data);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(KategoriProduk $kategori)
    {
        return view('kategori.show', compact('kategori'));
    }

    public function edit(KategoriProduk $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriProduk $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gambar_url' => 'nullable|url|max:2048',
        ]);

        $data = $request->only(['nama_kategori', 'deskripsi']);

        if ($request->filled('gambar_url')) {
            if ($kategori->gambar && !str_starts_with($kategori->gambar, 'http')) {
                Storage::disk('public')->delete($kategori->gambar);
            }
            $data['gambar'] = $request->input('gambar_url');
        } elseif ($request->hasFile('gambar')) {
            if ($kategori->gambar && !str_starts_with($kategori->gambar, 'http')) {
                Storage::disk('public')->delete($kategori->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('kategori', 'public');
        }

        $kategori->update($data);

        $redirect = $request->input('previous_url', route('kategori.index'));

        return redirect()->to($redirect)->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(KategoriProduk $kategori)
    {
        if ($kategori->gambar && !str_starts_with($kategori->gambar, 'http')) {
            Storage::disk('public')->delete($kategori->gambar);
        }
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
