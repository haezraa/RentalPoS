<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Tanggal dari Filter (Default: Hari ini)
        $startDate = $request->start_date ? Carbon::parse($request->start_date) : Carbon::today();
        $endDate = $request->end_date ? Carbon::parse($request->end_date) : Carbon::today();

        // 2. Ambil Data Transaksi Berdasarkan Range Tanggal & Status Selesai
        $transactions = Transaction::with(['console', 'details.product']) // Eager load biar ringan
                                   ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
                                   ->where('status', 'finished') // Cuma ambil yang udah bayar
                                   ->latest()
                                   ->get();

        // 3. Hitung Total
        $total_income = $transactions->sum('total_price');
        $total_transaksi = $transactions->count();

        // Kirim $startDate dan $endDate ke View biar gak error "Undefined variable"
        return view('reports.index', compact('transactions', 'total_income', 'total_transaksi', 'startDate', 'endDate'));
    }
}
