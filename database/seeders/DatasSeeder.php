<?php

namespace Database\Seeders;

use App\Models\Datas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Datas::create([
            'judul' => 'Daftar Pasien',
            'deskripsi' => 'Merupakan list pasien yang sudah terdaftar di klinik anda.',
        ]);

        Datas::create([
            'judul' => 'Tambah Pasien',
            'deskripsi' => 'Isi biodata berikut untuk menambah pasien baru.',
        ]);

        Datas::create([
            'judul' => 'Edit Pasien',
            'deskripsi' => 'Lakukan pengeditan pasien sesuai kolom yang tertera.',
        ]);

        Datas::create([
            'judul' => 'Daftar Obat',
            'deskripsi' => 'Daftar obat-obatan yang terdaftar di klinik.',
        ]);

        Datas::create([
            'judul' => 'Tambah Obat Baru',
            'deskripsi' => 'Tambahkan obat baru kedalam database dengan mengisi formulir berikut',
        ]);

        Datas::create([
            'judul' => 'Edit Obat',
            'deskripsi' => 'Lakukan perubahan informasi mengenai obat yang anda inginkan dengan menuliskannya di formulir berikut.',
        ]);

        Datas::create([
            'judul' => 'Daftar Pemeriksaan Lab',
            'deskripsi' => 'Daftar pemeriksaan lab yang tersedia di klinik.',
        ]);

        Datas::create([
            'judul' => 'Tambah Pemeriksaan Lab',
            'deskripsi' => 'Tambahkan fasilitas lab kedalam database dengan mengisi formulir berikut.',
        ]);

        Datas::create([
            'judul' => 'Edit Lab',
            'deskripsi' => 'Lakukan perubahan informasi mengenai obat yang anda inginkan dengan menuliskannya di formulir berikut.',
        ]);

        Datas::create([
            'judul' => 'Lihat Rekam Medis',
            'deskripsi' => 'Lihat rekam medis yang tersdia pada pasien yang dipilih.',
        ]);

        Datas::create([
            'judul' => 'Tambah Rekam Medis',
            'deskripsi' => 'Tambahkan rekam medis pada pasien yang dipilih.',
        ]);

        Datas::create([
            'judul' => 'List Rekam Medis Pasien',
            'deskripsi' => 'Jejak rekam medis pasien di klinik anda.',
        ]);

        Datas::create([
            'judul' => 'Edit Rekam Medis',
            'deskripsi' => 'Lakukan Pengeditan rekam medis.',
        ]);

        Datas::create([
            'judul' => 'Buat Tagihan Kunjungan',
            'deskripsi' => 'Berikut adalah tagihan tehadap pasien yang diperiksa.',
        ]);

        Datas::create([
            'judul' => 'Dashboard',
            'deskripsi' => 'Halaman muka dari klinik anda, overview hal-hal mengenai klinik anda.',
        ]);
    }
}
