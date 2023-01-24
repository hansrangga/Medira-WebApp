<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Obat::create([
            'obat' => 'Paracetamol',
            'satuan' => 'ml',
            'jenis' => 'Sirup',
            'dosis' => 60,
            'stok' => 4,
            'harga' => 15000,
        ]);

        Obat::create([
            'obat' => 'Sanmol',
            'satuan' => 'mg/5ml',
            'jenis' => 'Sirup',
            'dosis' => 120,
            'stok' => 14,
            'harga' => 15000,
        ]);

        Obat::create([
            'obat' => 'Combatrin',
            'satuan' => 'mg',
            'jenis' => 'Tablet',
            'dosis' => 500,
            'stok' => 1,
            'harga' => 21000,
        ]);

        Obat::create([
            'obat' => 'Enervon-C',
            'satuan' => 'mg',
            'jenis' => 'Tablet',
            'dosis' => 200,
            'stok' => 21,
            'harga' => 20000,
        ]);

        Obat::create([
            'obat' => 'Cerebrovit',
            'satuan' => 'mg',
            'jenis' => 'Kapsul',
            'dosis' => '500',
            'stok' => 40,
            'harga' => 45000,
        ]);
    }
}
