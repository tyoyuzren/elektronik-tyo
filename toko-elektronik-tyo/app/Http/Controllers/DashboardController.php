<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\KategoriProduk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = KategoriProduk::count();
        $totalTransaksi = Transaksi::count();
        $totalOmzet = Transaksi::sum('total_harga');

        $stokMenipis = Produk::with('kategori')
            ->where('stok', '<=', 5)
            ->orderBy('stok')
            ->limit(8)
            ->get();

        $transaksiTerbaru = Transaksi::with('user', 'detail')
            ->latest()
            ->limit(5)
            ->get();

        $produkTerlaris = DetailTransaksi::select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->with('produk.kategori')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalKategori',
            'totalTransaksi',
            'totalOmzet',
            'stokMenipis',
            'transaksiTerbaru',
            'produkTerlaris'
        ));
    }
}
