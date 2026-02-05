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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        // foreignId artinya kolom ini nyambung ke tabel consoles
        // onDelete('cascade') artinya kalau TV-nya dihapus, riwayat transaksinya ikut kehapus
        $table->foreignId('console_id')->constrained()->onDelete('cascade');

        $table->string('customer_name')->default('Guest'); // Nama penyewa (opsional)
        $table->integer('duration_minutes'); // Durasi main
        $table->dateTime('start_time');      // Jam mulai
        $table->dateTime('end_time');        // Jam selesai (otomatis dihitung)
        $table->integer('total_price');      // Total bayar
        $table->string('status')->default('ongoing'); // ongoing / finished
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
