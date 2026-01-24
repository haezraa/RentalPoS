<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // Panggil Model Transaksi
use App\Models\Console;     // Panggil Model Console
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Hitung Pemasukan Hari Ini
        $pemasukan_hari_ini = Transaction::whereDate('created_at', Carbon::today())
                                ->sum('total_price');

        // 2. Hitung Berapa Unit yang Lagi MAIN
        $unit_sedang_main = Console::where('status', 'main')->count();

        // 3. Hitung Total Transaksi Hari Ini
        $total_transaksi = Transaction::whereDate('created_at', Carbon::today())->count();

        // 4. Ambil 5 Riwayat Terakhir (Biar halaman gak sepi)
        // with('console') biar kita tau dia main di TV berapa
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
