<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kategori_id = $request->input('kategori_id');

        $produks = Produk::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('nama_produk', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($q) use ($search) {
                        $q->where('nama_kategori', 'like', "%{$search}%");
                    });
            })
            ->when($kategori_id, function ($query, $kategori_id) {
                $query->where('category_id', $kategori_id);
            })
            ->latest()
            ->get();

        return view('produk.index', compact('produks', 'search', 'kategori_id'));
    }

    public function create()
    {
        $kategoris = KategoriProduk::all();
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:tb_kategori_produk,id',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_url' => 'nullable|url|max:2048',
        ]);

        $data = $request->only(['category_id', 'nama_produk', 'harga', 'stok']);

        if ($request->filled('gambar_url')) {
            $data['gambar'] = $request->input('gambar_url');
        } elseif ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('kategori');
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $kategoris = KategoriProduk::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'category_id' => 'required|exists:tb_kategori_produk,id',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_url' => 'nullable|url|max:2048',
        ]);

        $data = $request->only(['category_id', 'nama_produk', 'harga', 'stok']);

        if ($request->filled('gambar_url')) {
            if ($produk->gambar && !str_starts_with($produk->gambar, 'http')) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->input('gambar_url');
        } elseif ($request->hasFile('gambar')) {
            if ($produk->gambar && !str_starts_with($produk->gambar, 'http')) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($data);

        $redirect = $request->input('previous_url', route('produk.index'));

        return redirect()->to($redirect)->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar && !str_starts_with($produk->gambar, 'http')) {
            Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
