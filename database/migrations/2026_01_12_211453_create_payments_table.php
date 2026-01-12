<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('id_payment');

            $table->unsignedBigInteger('id_transaksi');

            $table->enum('metode_bayar', ['cash', 'qris', 'ewallet']);
            $table->integer('jumlah_bayar');
            $table->integer('kembalian')->default(0);
            $table->dateTime('paid_at');

            $table->timestamps();

            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transactions');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
