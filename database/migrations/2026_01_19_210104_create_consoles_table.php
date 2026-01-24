<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consoles', function (Blueprint $table) {
            $table->id();
            $table->string('name');   // Nama TV (TV 1, TV 2)
            $table->string('type');   // Tipe (PS3, PS4, PS5)
            $table->string('status')->default('ready'); // ready atau main
            $table->integer('price_per_hour')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consoles');
    }
};
