<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('tb_detail_transaksi', function (Blueprint $table) {

    $table->id();

    $table->foreignId('transaction_id')
    ->constrained('tb_transaksi')
    ->onDelete('cascade');

    $table->foreignId('product_id')
    ->constrained('tb_produk')
    ->onDelete('cascade');

    $table->integer('qty');

    $table->integer('harga');

    $table->integer('subtotal');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_transaksi');
        Schema::dropIfExists('detail_transaksis');
    }
};
