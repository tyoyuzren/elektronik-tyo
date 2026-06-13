<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('user', 'detail.produk')->latest()->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $produks = Produk::with('kategori')->where('stok', '>', 0)->get();
        return view('transaksi.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk' => 'required|array|min:1',
            'produk.*.id' => 'required|exists:tb_produk,id',
            'produk.*.qty' => 'required|integer|min:1',
        ]);

        $transaksi = DB::transaction(function () use ($request) {
            $total = 0;
            $details = [];

            foreach ($request->produk as $item) {
                $produk = Produk::findOrFail($item['id']);

                if ($produk->stok < $item['qty']) {
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi.");
                }

                $subtotal = $produk->harga * $item['qty'];
                $total += $subtotal;

                $details[] = [
                    'product_id' => $produk->id,
                    'qty' => $item['qty'],
                    'harga' => $produk->harga,
                    'subtotal' => $subtotal,
                ];

                $produk->decrement('stok', $item['qty']);
            }

            $transaksi = Transaksi::create([
                'user_id' => auth()->id(),
                'tanggal' => now()->toDateString(),
                'total_harga' => $total,
            ]);

            foreach ($details as $detail) {
                $detail['transaction_id'] = $transaksi->id;
                DetailTransaksi::create($detail);
            }

            return $transaksi;
        });

        return redirect()->route('transaksi.cetak', $transaksi);
    }

    public function cetak(Transaksi $transaksi)
    {
        $transaksi->load('user', 'detail.produk.kategori');
        return view('transaksi.cetak', compact('transaksi'));
    }

    public function show(Transaksi $transaksi)
    {
        $transaksi->load('user', 'detail.produk.kategori');
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit(Transaksi $transaksi)
    {
        abort(404);
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        abort(404);
    }

    public function destroy(Transaksi $transaksi)
    {
        abort(404);
    }
}
