<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Console;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Hitung Pemasukan Hari Ini
        $pemasukan_hari_ini = Transaction::whereDate('created_at', Carbon::today())
                                ->sum('total_price');

        // Hitung Berapa Unit yang Lagi main
        $unit_sedang_main = Console::where('status', 'main')->count();

        // Hitung Total Transaksi Hari Ini
        $total_transaksi = Transaction::whereDate('created_at', Carbon::today())->count();

        // Ambil 5 Riwayat Terakhir (Biar halaman gak sepi)
        $riwayat_terbaru = Transaction::with('console')
                            ->latest() // Urutkan dari yang paling baru
                            ->take(5)  // Ambil 5 aja
                            ->get();

        return view('home', compact(
            'pemasukan_hari_ini',
            'unit_sedang_main',
            'total_transaksi',
            'riwayat_terbaru'
        ));
    }
}
