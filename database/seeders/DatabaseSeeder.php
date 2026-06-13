<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([HpSeeder::class, LaptopAksesorisSeeder::class]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tyo.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir',
            'email' => 'kasir@tyo.com',
            'password' => bcrypt('password'),
            'role' => 'kasir',
        ]);

        $laptop = KategoriProduk::create(['nama_kategori' => 'Laptop Gaming', 'deskripsi' => 'Laptop khusus gaming performa tinggi']);
        $hp = KategoriProduk::create(['nama_kategori' => 'Smartphone', 'deskripsi' => 'Smartphone berbagai merek']);
        $aksesoris = KategoriProduk::create(['nama_kategori' => 'Aksesoris', 'deskripsi' => 'Aksesoris elektronik']);

        Produk::create(['category_id' => $laptop->id, 'nama_produk' => 'ASUS ROG Zephyrus G14', 'harga' => 25000000, 'stok' => 10]);
        Produk::create(['category_id' => $laptop->id, 'nama_produk' => 'Lenovo Legion 5 Pro', 'harga' => 22000000, 'stok' => 8]);
        Produk::create(['category_id' => $hp->id, 'nama_produk' => 'Samsung Galaxy S24', 'harga' => 15000000, 'stok' => 15]);
        Produk::create(['category_id' => $hp->id, 'nama_produk' => 'iPhone 15 Pro', 'harga' => 20000000, 'stok' => 12]);
        Produk::create(['category_id' => $aksesoris->id, 'nama_produk' => 'Wireless Mouse Logitech', 'harga' => 250000, 'stok' => 50]);
        Produk::create(['category_id' => $aksesoris->id, 'nama_produk' => 'Keyboard Mechanical Rexus', 'harga' => 350000, 'stok' => 30]);
    }
}
