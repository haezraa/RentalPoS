<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil Tanggal dari Filter (Default: Hari Ini)
        $startDate = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : Carbon::today();
        $endDate   = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now();

        // 2. Query Transaksi yang SUDAH SELESAI (finished)
        // with(['console', 'details.product']) -> ini teknik Eager Loading biar loadingnya cepet
        $transactions = Transaction::with(['console', 'details.product'])
                        ->where('status', 'finished')
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->latest() // Urutin dari yang paling baru
                        ->get();

        // 3. Hitung Ringkasan
        $total_income = $transactions->sum('total_price');
        $total_transaksi = $transactions->count();

        return view('reports.index', compact('transactions', 'total_income', 'total_transaksi', 'startDate', 'endDate'));
    }
}
