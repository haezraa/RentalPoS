<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'nama_product' => 'Es Teh',
                'harga' => 4000,
                'stok' => 50,
                'status' => true,
            ],
            [
                'nama_product' => 'Pop Mie',
                'harga' => 7000,
                'stok' => 30,
                'status' => true,
            ],
            [
                'nama_product' => 'Air Mineral',
                'harga' => 2000,
                'stok' => 100,
                'status' => true,
            ],
            [
                'nama_product' => 'Kopi Sachet',
                'harga' => 5000,
                'stok' => 40,
                'status' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
