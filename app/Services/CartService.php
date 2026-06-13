<?php

namespace App\Services;

use App\Models\Produk;

class CartService
{
    protected string $sessionKey = 'cart';

    public function getCart(): array
    {
        return session($this->sessionKey, []);
    }

    public function add(int $productId, int $qty = 1): array
    {
        $cart = $this->getCart();
        $produk = Produk::findOrFail($productId);

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $qty;
        } else {
            $cart[$productId] = $this->buildItem($produk, $qty);
        }

        if ($cart[$productId]['qty'] > $produk->stok) {
            $cart[$productId]['qty'] = $produk->stok;
        }

        $cart[$productId]['subtotal'] = $cart[$productId]['harga'] * $cart[$productId]['qty'];

        session([$this->sessionKey => $cart]);

        return $cart;
    }

    public function update(int $productId, int $qty): array
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $produk = Produk::find($productId);
            $maxQty = $produk ? $produk->stok : $qty;
            $cart[$productId]['qty'] = min(max($qty, 1), $maxQty);
            $cart[$productId]['subtotal'] = $cart[$productId]['harga'] * $cart[$productId]['qty'];
        }

        session([$this->sessionKey => $cart]);

        return $cart;
    }

    public function remove(int $productId): array
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        session([$this->sessionKey => $cart]);
        return $cart;
    }

    public function clear(): void
    {
        session()->forget($this->sessionKey);
    }

    public function count(): int
    {
        return array_sum(array_column($this->getCart(), 'qty'));
    }

    public function total(): int
    {
        return array_sum(array_column($this->getCart(), 'subtotal'));
    }

    public function isEmpty(): bool
    {
        return empty($this->getCart());
    }

    protected function buildItem(Produk $produk, int $qty): array
    {
        return [
            'id'      => $produk->id,
            'nama'    => $produk->nama_produk,
            'harga'   => $produk->harga,
            'gambar'  => $produk->gambar,
            'stok'    => $produk->stok,
            'qty'     => $qty,
            'subtotal' => $produk->harga * $qty,
        ];
    }
}
