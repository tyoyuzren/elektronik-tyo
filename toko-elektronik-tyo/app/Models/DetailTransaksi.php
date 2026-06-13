<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'tb_detail_transaksi';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'harga',
        'subtotal'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'product_id');
    }
}