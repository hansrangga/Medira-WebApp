<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class LabController extends Controller
{
    public function index() {
        $datas = ambil_satudata('datas', 7);
        $labs = ambil_semuadata('labs');
        return view('lab', ['labs'=> $labs], ['datas'=> $datas]);
    }

    public function save_lab(Request $request) {
        $this->validate($request, [
            'lab' => 'required|min:4|max:25',
            'harga' => 'required|numeric|digits_between:1,7',
            'satuan' => 'required|max:10'
        ]);

        DB::table('labs')->insert([
            'lab' => $request->lab,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $ids = DB::table('labs')->orderby('id','desc')->first();
        switch($request->save) {
            case 'save':
                $buka = route('lab', $ids->id);
                $pesan = 'Data Lab Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function update_lab(Request $request) {
        $this->validate($request, [
            'lab' => 'required|min:4|max:25',
            'harga' => 'required|numeric|digits_between:1,7',
            'satuan' => 'required|max:10',
        ]);

        DB::table('labs')->where('id', $request->id)->update([
            'lab' => $request->lab,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'updated_at' => Carbon::now(),
        ]);

        switch($request->save) {
            case 'save':
                $buka = route('lab_update', $request->id);
                $pesan = 'Data Lab Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function edit_lab($id) {
        $datas = ambil_satudata('datas', 9);
        $temps = ambil_satudata('labs', $id);
        if($temps->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        return view('edit-lab', ['temps'=>$temps], ['datas'=>$datas]);
    }

    public function remove_lab($id) {
        DB::table('labs')->where('id', $id)->update([
            'deleted' => 1,
        ]);
        $pesan = "Data Lab Berhasil Dihapus!";

        return redirect(route("lab"))->with('pesan', $pesan);
    }
}
