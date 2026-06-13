<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'total_harga'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaction_id');
    }
}
