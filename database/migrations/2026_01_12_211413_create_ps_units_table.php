<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ps_units', function (Blueprint $table) {
            $table->id('id_ps');
            $table->string('nama_ps');
            $table->enum('tipe_ps', ['PS4', 'PS5']);
            $table->integer('harga_per_jam');
            $table->enum('status', ['available', 'playing', 'maintenance'])
                  ->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ps_units');
    }
};
