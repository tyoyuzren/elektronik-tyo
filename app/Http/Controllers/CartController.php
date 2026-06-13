<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected CartService $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $cartItems = $this->cart->getCart();
        $total = $this->cart->total();
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:tb_produk,id',
            'qty'       => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if ($produk->stok < $request->qty) {
            return back()->with('error', "Stok {$produk->nama_produk} tidak mencukupi. Sisa: {$produk->stok}");
        }

        $this->cart->add($request->produk_id, $request->qty);

        return redirect()->route('cart.index')->with('success', "{$produk->nama_produk} ditambahkan ke keranjang.");
    }

    public function addQuick(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'qty'       => 'required|integer|min:1',
        ]);

        $ids = is_array($request->produk_id) ? $request->produk_id : [$request->produk_id];
        $added = [];

        foreach ($ids as $pid) {
            $produk = Produk::find($pid);
            if (!$produk) continue;
            if ($produk->stok < $request->qty) continue;

            $this->cart->add($pid, $request->qty);
            $added[] = $produk->nama_produk;
        }

        if (empty($added)) {
            return back()->with('error', 'Tidak ada produk yang dapat ditambahkan.');
        }

        $msg = count($added) > 1
            ? count($added) . ' produk ditambahkan ke keranjang.'
            : $added[0] . ' ditambahkan ke keranjang.';

        return back()->with('success', $msg);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        $this->cart->update($id, $request->qty);

        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
    }

    public function remove(int $id)
    {
        $this->cart->remove($id);
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        $this->cart->clear();
        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }

    public function checkout()
    {
        $cartItems = $this->cart->getCart();

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $transaksi = DB::transaction(function () use ($cartItems) {
            $total = 0;
            $details = [];

            foreach ($cartItems as $item) {
                $produk = Produk::findOrFail($item['id']);

                if ($produk->stok < $item['qty']) {
                    throw new \Exception("Stok {$produk->nama_produk} tidak mencukupi. Sisa: {$produk->stok}");
                }

                $subtotal = $produk->harga * $item['qty'];
                $total += $subtotal;

                $details[] = [
                    'product_id' => $produk->id,
                    'qty'        => $item['qty'],
                    'harga'      => $produk->harga,
                    'subtotal'   => $subtotal,
                ];

                $produk->decrement('stok', $item['qty']);
            }

            $transaksi = Transaksi::create([
                'user_id'     => auth()->id(),
                'tanggal'     => now()->toDateString(),
                'total_harga' => $total,
            ]);

            foreach ($details as $detail) {
                $detail['transaction_id'] = $transaksi->id;
                DetailTransaksi::create($detail);
            }

            return $transaksi;
        });

        $this->cart->clear();

        return redirect()->route('transaksi.cetak', $transaksi);
    }

    public function buyNow(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:tb_produk,id',
            'qty'       => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        if ($produk->stok < $request->qty) {
            return back()->with('error', "Stok {$produk->nama_produk} tidak mencukupi. Sisa: {$produk->stok}");
        }

        $transaksi = DB::transaction(function () use ($produk, $request) {
            $subtotal = $produk->harga * $request->qty;

            $transaksi = Transaksi::create([
                'user_id'     => auth()->id(),
                'tanggal'     => now()->toDateString(),
                'total_harga' => $subtotal,
            ]);

            DetailTransaksi::create([
                'transaction_id' => $transaksi->id,
                'product_id'     => $produk->id,
                'qty'            => $request->qty,
                'harga'          => $produk->harga,
                'subtotal'       => $subtotal,
            ]);

            $produk->decrement('stok', $request->qty);

            return $transaksi;
        });

        return redirect()->route('transaksi.cetak', $transaksi);
    }
}
