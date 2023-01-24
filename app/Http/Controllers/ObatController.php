<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ObatController extends Controller
{
    public function index() {
        $datas = ambil_satudata('datas', 4);
        $obats = ambil_semuadata('obats');
        return view('obat', ['obats'=> $obats], ['datas'=>$datas]);
    }

    public function save_obat(Request $request) {
        $this->validate($request, [
            'obat' => 'required|min:4|max:25',
            'jenis' => 'required',
            'satuan' => 'required',
            'dosis' => 'required|numeric|digits_between:1,7',
            'harga' => 'required|numeric|digits_between:1,7',
            'stok' => 'required|numeric|digits_between:1,5'
        ]);

        DB::table('obats')->insert([
            'obat' => $request->obat,
            'jenis' => $request->jenis,
            'satuan' => $request->satuan,
            'dosis' => $request->dosis,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $ids = DB::table('obats')->orderby('id','desc')->first();
        switch($request->save) {
            case 'save':
                $buka = route('obat', $ids->id);
                $pesan = 'Data Obat Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function update_obat(Request $request) {
        $this->validate($request, [
            'obat' => 'required|min:4|max:25',
            'jenis' => 'required',
            'dosis' => 'required|numeric|digits_between:1,7',
            'satuan' => 'required',
            'harga' => 'required|numeric|digits_between:1,7',
            'stok' => 'required|numeric|digits_between:1,5'
        ]);

        DB::table('obats')->where('id', $request->id)->update([
            'obat' => $request->obat,
            'jenis' => $request->jenis,
            'dosis' => $request->dosis,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'updated_at' => Carbon::now()
        ]);

        switch($request->save) {
            case 'save':
                $buka = route('obat', $request->id);
                $pesan = 'Data Obat Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function edit_obat($id) {
        $datas = ambil_satudata('datas', 6);
        $temps = ambil_satudata('obats', $id);
        if($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        return view('edit-obat', ['datas'=>$datas], ['temps'=>$temps]);
    }

    public function remove_obat($id) {
        DB::table('obats')->where('id', $id)->update([
            'deleted' => 1,
        ]);
        $pesan = "Data Obat Berhasil Dihapus!";

        return redirect(route("obat"))->with('pesan', $pesan);
    }
}
