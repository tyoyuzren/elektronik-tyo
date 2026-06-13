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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('tb_produk', function (Blueprint $table) {
    $table->id();

    $table->foreignId('category_id')
    ->constrained('tb_kategori_produk')
    ->onDelete('cascade');

    $table->string('nama_produk');

    $table->integer('harga');

    $table->integer('stok');

    $table->string('gambar')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produk');
        Schema::dropIfExists('produks');
    }
};
