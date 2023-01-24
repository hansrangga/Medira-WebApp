<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pasien::create([
            'nama' => 'Dian Pratiwi',
            'umur' => 22,
            'alamat' => 'Jl. Ibrahim RT.04/RW.04, Tangerang',
            'telpnumber' => '081245346231',
        ]);

        Pasien::create([
            'nama' => 'Abdul Saleh Hamaludin',
            'umur' => 25,
            'alamat' => 'Jl. Basuki No. 88, Tangerang',
            'telpnumber' => '083402713064',
        ]);

        Pasien::create([
            'nama' => 'Via Khaerunisa',
            'umur' => 18,
            'alamat' => 'Ki. Halim No. 668, Tangerang',
            'telpnumber' => '089345577090',
        ]);

        Pasien::create([
            'nama' => 'Gilang Romadhon',
            'umur' => 20,
            'alamat' => 'Gg. Gotong Royong No. 399, Tangerang',
            'telpnumber' => '08203144353',
        ]);

    }
}
