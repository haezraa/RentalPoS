<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    // --- TAMBAHIN INI BRO ---
    public function console()
    {
        // Artinya: Transaksi ini MILIK satu Console
        return $this->belongsTo(Console::class);
    }
}
