<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    // Ini biar kita bisa ngisi data langsung banyak sekaligus
    protected $fillable = [
        'name',
        'type',
        'status',
        'price_per_hour'
    ];

    // Tambahin ini di dalam class Console
    public function transactions()
    {
        // Satu console punya banyak transaksi
        return $this->hasMany(Transaction::class);
    }

    public function activeTransaction()
    {
        // FIX: Pake whereIn biar bisa baca yang 'ongoing' DAN 'paused'
        return $this->hasOne(Transaction::class)
            ->whereIn('status', ['ongoing', 'paused'])
            ->latestOfMany();
    }
}
