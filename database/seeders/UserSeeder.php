<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'adminadmin',
        ]);

        User::create([
            'username' => 'fathan',
            'name' => 'Fathan Rangga',
            'email' => 'fathan@gmail.com',
            'password' => 'fathan123',
        ]);
    }
}
