<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaksi');

            $table->unsignedBigInteger('id_ps');
            $table->unsignedBigInteger('id_user');

            $table->string('nama_pelanggan')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();

            $table->integer('total_durasi_menit')->nullable();
            $table->integer('biaya_rental')->default(0);
            $table->integer('total_bayar')->default(0);

            $table->enum('status', ['playing', 'finished', 'paid'])
                  ->default('playing');

            $table->timestamps();

            $table->foreign('id_ps')
                  ->references('id_ps')
                  ->on('ps_units');

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
