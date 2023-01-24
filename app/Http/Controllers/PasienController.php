<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PasienController extends Controller
{
    public function index() {
        $datas = ambil_satudata('datas', 1);
        $pasiens = ambil_semuadata('pasiens');
        return view('pasien', ['pasiens'=> $pasiens], ['datas'=>$datas]);
    }

    public function save_pasien(Request $request) {
        $this->validate($request, [
            'nama' => 'required|min:5|max:35',
            'umur' => 'required|numeric|digits_between:1,2',
            'alamat' => 'required',
            'telpnumber' => 'required|numeric|digits_between:1,13'
        ]);

        DB::table('pasiens')->insert([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'telpnumber' => $request->telpnumber,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $ids = DB::table('pasiens')->latest('created_at')->first();
        switch($request->save) {
            case 'save':
                $buka = route('pasien', $ids->id);
                $pesan = 'Data Pasien Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function update_pasien(Request $request) {
        $this->validate($request, [
            'nama' => 'required|min:5|max:35',
            'umur' => 'required|numeric|digits_between:1,2',
            'alamat' => 'required',
            'telpnumber' => 'required|numeric|digits_between:1,13'
        ]);

        DB::table('pasiens')->where('id', $request->id)->update([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'alamat' => $request->alamat,
            'telpnumber' => $request->telpnumber,
            'updated_at' => Carbon::now(),
        ]);

        switch($request->save) {
            case 'save':
                $buka = route('pasien_update', $request->id);
                $pesan = 'Data Pasien Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function edit_pasien($id) {
        $datas = ambil_satudata('datas', 3);
        $temps = ambil_satudata('pasiens', $id);
        if($temps->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        return view('edit-pasien', ['temps'=>$temps], ['datas'=>$datas]);
    }

    public function remove_pasien($id) {
        DB::table('pasiens')->where('id', $id)->update([
            'deleted' => 1,
        ]);
        $pesan = "Data Pasien Berhasil Dihapus!";

        return redirect(route("pasien"))->with('pesan', $pesan);
    }
}
