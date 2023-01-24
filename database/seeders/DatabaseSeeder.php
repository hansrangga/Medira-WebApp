<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DatasSeeder::class);
        $this->call(LabSeeder::class);
        $this->call(ObatSeeder::class);
        $this->call(PasienSeeder::class);
        $this->call(RekamMedisSeeder::class);
    }
}
