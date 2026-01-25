<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Console;
use Illuminate\Support\Facades\Storage;

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
        // 1. Validasi
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi Gambar (Max 2MB)
        ]);

        // 2. Siapin Data
        $data = $request->all();

        // 3. Cek apakah ada file gambar yang diupload?
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'public/storage/products'
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        // 4. Simpan ke Database
        Product::create($data);

        return back()->with('success', 'Menu berhasil ditambah!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        // ... (Validasi biarin sama) ...
        $request->validate([
            // ...
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // 1. CEK VALIDITAS FILE (Debugging)
            if (!$file->isValid()) {
                dd("File Corrupt/Kegedean. Cek php.ini upload_max_filesize");
            }

            // 2. HAPUS GAMBAR LAMA (Pake cara aman)
            if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                unlink(storage_path('app/public/' . $product->image));
            }

            // 3. --- JURUS MANUAL (MOVE) ---
            // Kita bikin nama file sendiri
            $filename = time() . '_' . $file->getClientOriginalName();

            // Kita paksa pindahin ke folder storage/app/public/products
            // move(tujuan, nama_file)
            $file->move(storage_path('app/public/products'), $filename);

            // Simpan path ke database
            $data['image'] = 'products/' . $filename;
        }

        $product->update($data);

        return back()->with('success', 'Menu berhasil diupdate!');
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
