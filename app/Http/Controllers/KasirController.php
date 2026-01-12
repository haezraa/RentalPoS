<?php

namespace App\Http\Controllers;

use App\Models\PsUnit;

class KasirController extends Controller
{
    public function index()
    {
        $psUnits = PsUnit::orderBy('nama_ps')->get();
        return view('kasir.index', compact('psUnits'));
    }
}
