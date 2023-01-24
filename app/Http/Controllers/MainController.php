<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{

    public function index() {
        $datas = ambil_satudata('datas', 17);
        $jumlah['pasien'] = DB::table('pasiens')->count();
        $jumlah['kunjungan'] = DB::table('rekam_medis')->count();
        $jumlah['lab'] = DB::table('labs')->count();
        $jumlah['obat'] = DB::table('obats')->count();
        $pasiens = ambil_semuadata('pasiens');
        $labs = ambil_semuadata('labs');
        $rekam_medis = ambil_semuadata('rekam_medis');
        $obats = ambil_semuadata('obats');
        $warning = cek_stok_warning(10);

        return view('index', compact('datas', 'jumlah', 'pasiens', 'rekam_medis', 'labs', 'obats', 'warning'));
    }
}
