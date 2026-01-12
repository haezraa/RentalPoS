<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id('id_item');

            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_product');

            $table->integer('qty');
            $table->integer('harga');
            $table->integer('subtotal');

            $table->timestamps();

            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transactions')
                  ->onDelete('cascade');

            $table->foreign('id_product')
                  ->references('id_product')
                  ->on('products');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
