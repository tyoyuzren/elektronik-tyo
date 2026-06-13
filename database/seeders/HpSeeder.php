<?php

namespace Database\Seeders;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class HpSeeder extends Seeder
{
    public function run(): void
    {
        $android = KategoriProduk::create([
            'nama_kategori' => 'Smartphone Android',
            'deskripsi' => 'Smartphone Android berbagai merek'
        ]);

        $iphone = KategoriProduk::create([
            'nama_kategori' => 'iPhone',
            'deskripsi' => 'Apple iPhone series'
        ]);

        $androidProducts = [
            // Samsung Galaxy S Series
            ['nama_produk' => 'Samsung Galaxy S23 Ultra', 'harga' => 16000000, 'stok' => 8],
            ['nama_produk' => 'Samsung Galaxy S24', 'harga' => 12500000, 'stok' => 10],
            ['nama_produk' => 'Samsung Galaxy S24 Plus', 'harga' => 15000000, 'stok' => 7],
            ['nama_produk' => 'Samsung Galaxy S24 Ultra', 'harga' => 19000000, 'stok' => 5],
            ['nama_produk' => 'Samsung Galaxy S25', 'harga' => 14000000, 'stok' => 6],
            ['nama_produk' => 'Samsung Galaxy S25 Plus', 'harga' => 16500000, 'stok' => 4],
            ['nama_produk' => 'Samsung Galaxy S25 Ultra', 'harga' => 21000000, 'stok' => 3],
            // Samsung Galaxy A Series
            ['nama_produk' => 'Samsung Galaxy A15', 'harga' => 2500000, 'stok' => 25],
            ['nama_produk' => 'Samsung Galaxy A25', 'harga' => 3500000, 'stok' => 20],
            ['nama_produk' => 'Samsung Galaxy A35', 'harga' => 4500000, 'stok' => 18],
            ['nama_produk' => 'Samsung Galaxy A55', 'harga' => 5500000, 'stok' => 15],
            // Samsung Z Series
            ['nama_produk' => 'Samsung Galaxy Z Flip 6', 'harga' => 15000000, 'stok' => 5],
            ['nama_produk' => 'Samsung Galaxy Z Fold 6', 'harga' => 25000000, 'stok' => 3],
            // Xiaomi
            ['nama_produk' => 'Xiaomi Redmi Note 13', 'harga' => 3000000, 'stok' => 20],
            ['nama_produk' => 'Xiaomi Redmi Note 13 Pro', 'harga' => 4500000, 'stok' => 15],
            ['nama_produk' => 'Xiaomi 14T', 'harga' => 7000000, 'stok' => 10],
            ['nama_produk' => 'Xiaomi 14 Ultra', 'harga' => 14000000, 'stok' => 5],
            ['nama_produk' => 'Xiaomi Poco X6 Pro', 'harga' => 4500000, 'stok' => 12],
            ['nama_produk' => 'Xiaomi Poco F6', 'harga' => 5500000, 'stok' => 10],
            // OPPO
            ['nama_produk' => 'OPPO Reno 12', 'harga' => 6000000, 'stok' => 10],
            ['nama_produk' => 'OPPO Reno 12 Pro', 'harga' => 8000000, 'stok' => 8],
            ['nama_produk' => 'OPPO Find X8', 'harga' => 12000000, 'stok' => 5],
            ['nama_produk' => 'OPPO A79', 'harga' => 3500000, 'stok' => 15],
            // vivo
            ['nama_produk' => 'vivo V40', 'harga' => 5500000, 'stok' => 10],
            ['nama_produk' => 'vivo V40 Pro', 'harga' => 8000000, 'stok' => 7],
            ['nama_produk' => 'vivo X200 Pro', 'harga' => 15000000, 'stok' => 4],
            ['nama_produk' => 'vivo Y28', 'harga' => 2500000, 'stok' => 18],
            // Realme
            ['nama_produk' => 'Realme 12 Plus', 'harga' => 3500000, 'stok' => 15],
            ['nama_produk' => 'Realme GT 6', 'harga' => 6500000, 'stok' => 8],
            ['nama_produk' => 'Realme C67', 'harga' => 2500000, 'stok' => 20],
            // Google Pixel
            ['nama_produk' => 'Google Pixel 8', 'harga' => 10000000, 'stok' => 5],
            ['nama_produk' => 'Google Pixel 8 Pro', 'harga' => 13000000, 'stok' => 3],
            ['nama_produk' => 'Google Pixel 9', 'harga' => 11000000, 'stok' => 4],
            ['nama_produk' => 'Google Pixel 9 Pro', 'harga' => 15000000, 'stok' => 3],
            // Nothing
            ['nama_produk' => 'Nothing Phone (2a)', 'harga' => 4500000, 'stok' => 10],
            ['nama_produk' => 'Nothing Phone (3)', 'harga' => 8000000, 'stok' => 6],
        ];

        $iphoneProducts = [
            // iPhone XS Series
            ['nama_produk' => 'iPhone XS', 'harga' => 5000000, 'stok' => 5],
            ['nama_produk' => 'iPhone XS Max', 'harga' => 5500000, 'stok' => 4],
            ['nama_produk' => 'iPhone XR', 'harga' => 4500000, 'stok' => 6],
            // iPhone 11 Series
            ['nama_produk' => 'iPhone 11', 'harga' => 6000000, 'stok' => 8],
            ['nama_produk' => 'iPhone 11 Pro', 'harga' => 7500000, 'stok' => 4],
            ['nama_produk' => 'iPhone 11 Pro Max', 'harga' => 8000000, 'stok' => 3],
            // iPhone 12 Series
            ['nama_produk' => 'iPhone 12 Mini', 'harga' => 6500000, 'stok' => 5],
            ['nama_produk' => 'iPhone 12', 'harga' => 7500000, 'stok' => 8],
            ['nama_produk' => 'iPhone 12 Pro', 'harga' => 10000000, 'stok' => 4],
            ['nama_produk' => 'iPhone 12 Pro Max', 'harga' => 11000000, 'stok' => 3],
            // iPhone 13 Series
            ['nama_produk' => 'iPhone 13 Mini', 'harga' => 8000000, 'stok' => 5],
            ['nama_produk' => 'iPhone 13', 'harga' => 9000000, 'stok' => 10],
            ['nama_produk' => 'iPhone 13 Pro', 'harga' => 12000000, 'stok' => 4],
            ['nama_produk' => 'iPhone 13 Pro Max', 'harga' => 13000000, 'stok' => 3],
            // iPhone SE
            ['nama_produk' => 'iPhone SE (2022)', 'harga' => 6000000, 'stok' => 8],
            // iPhone 14 Series
            ['nama_produk' => 'iPhone 14', 'harga' => 10000000, 'stok' => 8],
            ['nama_produk' => 'iPhone 14 Plus', 'harga' => 11000000, 'stok' => 5],
            ['nama_produk' => 'iPhone 14 Pro', 'harga' => 14000000, 'stok' => 4],
            ['nama_produk' => 'iPhone 14 Pro Max', 'harga' => 15000000, 'stok' => 3],
            // iPhone 15 Series
            ['nama_produk' => 'iPhone 15', 'harga' => 12000000, 'stok' => 10],
            ['nama_produk' => 'iPhone 15 Plus', 'harga' => 13000000, 'stok' => 6],
            ['nama_produk' => 'iPhone 15 Pro', 'harga' => 17000000, 'stok' => 5],
            ['nama_produk' => 'iPhone 15 Pro Max', 'harga' => 20000000, 'stok' => 3],
            // iPhone 16 Series
            ['nama_produk' => 'iPhone 16', 'harga' => 13000000, 'stok' => 8],
            ['nama_produk' => 'iPhone 16 Plus', 'harga' => 14000000, 'stok' => 5],
            ['nama_produk' => 'iPhone 16 Pro', 'harga' => 18000000, 'stok' => 4],
            ['nama_produk' => 'iPhone 16 Pro Max', 'harga' => 22000000, 'stok' => 3],
            ['nama_produk' => 'iPhone 16e', 'harga' => 10000000, 'stok' => 6],
        ];

        foreach ($androidProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $android->id]));
        }

        foreach ($iphoneProducts as $p) {
            Produk::create(array_merge($p, ['category_id' => $iphone->id]));
        }
    }
}
