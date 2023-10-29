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
        Schema::create('detail_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order')->references('id')->on('orders');
            $table->foreignId('id_product')->references('id')->on('products');
            $table->foreignId('id_ukuran')->references('id')->on('variasi_ukurans');
            $table->foreignId('id_warna')->references('id')->on('variasi_warnas');
            $table->integer('qty');
            $table->string('harga_product');
            $table->string('total_item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orders');
    }
};
