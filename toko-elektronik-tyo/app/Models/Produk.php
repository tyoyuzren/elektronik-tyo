<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 class Produk extends Model
{
    protected $table = 'tb_produk';

    protected $fillable = [
        'category_id',
        'nama_produk',
        'harga',
        'stok',
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class,'category_id');
    }
}
