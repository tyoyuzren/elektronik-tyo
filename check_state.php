<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use App\Models\KategoriProduk;
use App\Models\Produk;

echo "=== SEBELUM ===\n";
foreach (KategoriProduk::withCount('produk')->orderBy('id')->get() as $k) {
    echo "  {$k->nama_kategori}: {$k->produk_count} produk\n";
}
