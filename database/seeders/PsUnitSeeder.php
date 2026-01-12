<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PsUnit;

class PsUnitSeeder extends Seeder
{
    public function run(): void
    {
        $psUnits = [
            [
                'nama_ps' => 'PS 1',
                'tipe_ps' => 'PS5',
                'harga_per_jam' => 2000,
                'status' => 'available',
            ],
            [
                'nama_ps' => 'PS 2',
                'tipe_ps' => 'PS5',
                'harga_per_jam' => 3000,
                'status' => 'available',
            ],
            [
                'nama_ps' => 'PS 3',
                'tipe_ps' => 'PS4',
                'harga_per_jam' => 4000,
                'status' => 'available',
            ],
            [
                'nama_ps' => 'PS 4',
                'tipe_ps' => 'PS4',
                'harga_per_jam' => 5000,
                'status' => 'available',
            ],
            [
                'nama_ps' => 'PS 5',
                'tipe_ps' => 'PS5',
                'harga_per_jam' => 6000,
                'status' => 'available',
            ],
        ];

        foreach ($psUnits as $ps) {
            PsUnit::create($ps);
        }
    }
}
