<?php

namespace Database\Seeders;

use App\Models\Lab;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lab::create([
            'lab' => 'Gula Darah 2 Jam PP',
            'harga' => 15000,
            'satuan' => 'mg/dl',
        ]);

        Lab::create([
            'lab' => 'Gula Darah Sewaktu',
            'harga' => 15000,
            'satuan' => 'mg/dl',
        ]);

        Lab::create([
            'lab' => 'Asam Urat',
            'harga' => 15000,
            'satuan' => 'mg/dl',
        ]);

        Lab::create([
            'lab' => 'Kolesterol',
            'harga' => 15000,
            'satuan' => 'mg/dl',
        ]);
    }
}
