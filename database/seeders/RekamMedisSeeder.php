<?php

namespace Database\Seeders;

use App\Models\Rekam_Medis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekamMedisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rekam_Medis::create([
            'idpasien' => 1,
            'pemeriksa' => 'Bidan Hj.Siti Maryam',
            'gejala' => 'Demam & Pusing',
            'anamnesis' => 'Demam 10 Hari',
            'pfisik' => 'T:38.7',
            'lab' => '3|1|2',
            'hasil' => '150|260|10',
            'diagnosis' => 'Febris',
            'resep' => '1|2',
            'jumlah' => '1|6',
            'aturan' => '3x1|3x1',
        ]);

        Rekam_Medis::create([
            'idpasien' => 2,
            'pemeriksa' => 'Bidan Hj.Siti Maryam',
            'gejala' => 'Pegal',
            'anamnesis' => 'Pegal Linu',
            'pfisik' => 'Nyeri tekan di otot biceps',
            'lab' => '',
            'hasil' => '',
            'diagnosis' => 'Myalgia',
            'resep' => '1',
            'jumlah' => '2',
            'aturan' => '2x1',
        ]);

        Rekam_Medis::create([
            'idpasien' => 1,
            'pemeriksa' => 'Bidan Hj.Siti Maryam',
            'gejala' => 'Pilek',
            'anamnesis' => 'Pilek 2 Hari',
            'pfisik' => 'Hanya pilek biasa',
            'lab' => '',
            'hasil' => '',
            'diagnosis' => 'Typhoid Fever',
            'resep' => '2',
            'jumlah' => '10',
            'aturan' => '2x1',
        ]);
    }
}
