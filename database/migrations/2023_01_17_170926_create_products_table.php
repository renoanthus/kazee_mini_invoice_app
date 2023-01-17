<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->comment('');
            $table->integer('id', true);
            $table->string('kode_produk', 10);
            $table->string('nama_produk', 100);
            $table->bigInteger('harga_produk');
            $table->integer('sisa_stok');
            $table->string('foto_produk', 200);
            $table->text('keterangan_produk');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
