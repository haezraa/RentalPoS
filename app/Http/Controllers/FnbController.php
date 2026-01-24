<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Console;

class FnbController extends Controller
{
    // Halaman Utama FnB (List Menu)
    public function index()
    {
        $products = Product::all();
        return view('fnb.index', compact('products'));
    }

    // Simpan Menu Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        Product::create($request->all());

        return back()->with('success', 'Menu baru berhasil ditambah!');
    }

    // Hapus Menu
    public function destroy($id)
    {
        Product::find($id)->delete();
        return back()->with('success', 'Menu dihapus.');
    }

    // Update Stok (Nambah/Kurang dikit)
    public function updateStock(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update(['stock' => $request->stock]);
        return back();
    }

    public function cashier()
    {
        // Ambil menu yang stoknya ada
        $products = Product::where('stock', '>', 0)->get();

        // Ambil Unit TV yang lagi MAIN atau PAUSE (biar bisa dipesenin makan)
        // whereIn statusnya 'main' atau 'paused'
        $active_consoles = Console::whereIn('status', ['main', 'paused'])->get();

        return view('fnb.cashier', compact('products', 'active_consoles'));
    }
}
