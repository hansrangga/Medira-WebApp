<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function index() {
        $datas = ambil_satudata('datas', 12);
        $rekam_medis = ambil_semuadata('rekam_medis');
        $pasiens = ambil_semuadata('pasiens');
        $cont = [
            'aria' => 'true',
            'show' => 'show',
            'col' => ''
        ];

        return view('rekam-medis', compact('rekam_medis', 'datas', 'pasiens', 'cont'));
    }

    public function remove_rekam_medis($id) {
        DB::table('rekam_medis')->where('id', $id)->update([
            'deleted' => 1,
        ]);
        $pesan = "Data Rekam Medis Berhasil Dihapus!";

        return redirect(route("rekam_medis"))->with('pesan', $pesan);
    }

    public function update_rekam_medis(Request $request) {
        $this->validate($request, [
            'idpasien' => 'required|numeric|digits_between:1,4',
            'pemeriksa' => 'required|min:5|max:40',
            'gejala' => 'required|max:40',
            'anamnesis' => 'required|max:1000',
            'pfisik' => 'required|max:1000',
            'diagnosis' => 'required|max:40',
        ]);

        if(isset($request->lab)) {
            if(has_dupes(array_column($request->lab, 'id'))){
                $errors = new MessageBag(['lab' => ['Lab yang sama tidak boleh dimasukkan berulang']]);
                return back()->withErrors($errors);
            }

            $this->validate($request, [
                'lab.*.hasil' => 'required|numeric|digits_between:1,4',
            ]);

            $lab_id = decode('lab', 'id', $request->lab);
            $lab_hasil = decode('lab', 'hasil', $request->lab);
        }
        else {
            $lab_id = "";
            $lab_hasil = "";
        }

        if(isset($request->resep)) {
            if(has_dupes(array_column($request->resep, 'id'))){
                $errors = new MessageBag(['lab' => ['Resep yang sama tidak boleh dimasukkan berulang']]);
                return back()->withErrors($errors);
            }

            $this->validate($request, [
                'resep.*.jumlah' => 'required|numeric|digits_between:1,3',
                'resep.*.aturan' => 'required'
            ]);

            $resep_id = decode('resep', 'id', $request->resep);
            $resep_jumlah = decode('resep', 'jumlah', $request->resep);
            $resep_dosis = decode('resep', 'aturan', $request->resep);
        }
        else {
            $resep_id = "";
            $resep_jumlah = "";
            $resep_dosis = "";
        }

        $newresep = array();
        $oldresep = array_combine(encode(get_value('rekam_medis', $request->id, 'resep')), encode(get_value('rekam_medis', $request->id, 'jumlah')));
        foreach($request->resep as $resep) {
            $newresep[$resep['id']] = $resep['jumlah'];
        }

        if(empty($oldresep)) {
            $resultanresep = resultan_resep($oldresep, $newresep);
        }
        else {
            $resultanresep = $newresep;
        }

        $errors = validasi_stok($resultanresep);
        if($errors !== NULL) {
            return back()->withErrors($errors);
        }

        foreach ($resultanresep as $key => $value) {
            $perintah = kurangi_stok($key, $value);
            if($perintah === false) {$habis = array_push($habis, $key);}
        }

        DB::table('rekam_medis')->where('id', $request->id)->update([
            'idpasien' => $request->idpasien,
            'pemeriksa' => $request->pemeriksa,
            'gejala' => $request->gejala,
            'anamnesis' => $request->anamnesis,
            'pfisik' => $request->pfisik,
            'lab' => $lab_id,
            'hasil' => $lab_hasil,
            'diagnosis' => $request->diagnosis,
            'resep' => $resep_id,
            'jumlah' => $resep_jumlah,
            'aturan' => $resep_dosis,
            'updated_at' => Carbon::now(),
        ]);

        switch($request->save) {
            case 'save':
                $buka = route('rekam_medis', $request->id);
                $pesan = 'Data Rekam Medis Berhasil Disimpan!';
            break;
            case 'save_tagihan':
                $buka = route('tagihan', $request->id);
                $pesan = 'Data Rekam Medis Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function edit_rekam_medis($id) {
        $datas = ambil_satudata('datas', 13);
        $temps = ambil_satudata('rekam_medis', $id);

        if($temps->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        foreach($temps as $temp) {
            if($temp->idpasien != NULL) {
                $idpasien = $temp->idpasien;
                $idens = DB::table('pasiens')->where('id', $idpasien)->get();
            }

            if($temp->lab != NULL) {
                $temp->labhasil = array_combine(encode($temp->lab), encode($temp->hasil));
                $num['lab'] = sizeof($temp->labhasil);
            }
            else {
                $num['lab'] = 0;
            }

            if ($temp->resep != NULL) {
                $temp->allresep=array_combine(encode($temp->resep),encode($temp->aturan));
                $temp->jum=encode($temp->jumlah);
                $num['resep']=sizeof($temp->allresep);
            }
            else {
                $num['resep'] = 0;
            }
        }

        $labs = ambil_semuadata('labs');
        $obats = ambil_semuadata('obats');

        return view('edit-rm', compact('datas','temps', 'idens', 'labs', 'obats', 'num'));
    }

    public function btn_show_iden($idpasien){
        $datas = ambil_satudata('datas', 11);
        $pasiens = ambil_semuadata('pasiens');
        $idens = ambil_satudata('pasiens', $idpasien);
        $labs = ambil_semuadata('labs');
        $obats = ambil_semuadata('obats');
        $cont = [
            'aria' => 'false',
            'show' => '',
            'col' => 'collapsed'
        ];

        return view('add-rm', compact('datas', 'pasiens', 'idens', 'cont', 'labs', 'obats'));
    }

    public function save_rekam_medis(Request $request) {
        $this->validate($request, [
            'idpasien' => 'required|numeric|digits_between:1,4',
            'pemeriksa' => 'required|min:5|max:40',
            'gejala' => 'required|max:40',
            'anamnesis' => 'required|max:1000',
            'pfisik' => 'required|max:1000',
            'diagnosis' => 'required|max:40',
        ]);

        if(isset($request->lab)) {
            if(has_dupes(array_column($request->lab, 'id'))){
                $errors = new MessageBag(['lab' => ['Lab yang sama tidak boleh dimasukkan berulang']]);
                return back()->withErrors($errors);
            }

            $this->validate($request, [
                'lab.*.hasil' => 'required|numeric|digits_between:1,4',
            ]);

            $lab_id = decode('lab', 'id', $request->lab);
            $lab_hasil = decode('lab', 'hasil', $request->lab);
        }
        else {
            $lab_id = "";
            $lab_hasil = "";
        }

        if(isset($request->resep)) {
            if(has_dupes(array_column($request->resep, 'id'))){
                $errors = new MessageBag(['lab' => ['Resep yang sama tidak boleh dimasukkan berulang']]);
                return back()->withErrors($errors);
            }

            $this->validate($request, [
                'resep.*.jumlah' => 'required|numeric|digits_between:1,3',
                'resep.*.aturan' => 'required'
            ]);

            $resep_id = decode('resep', 'id', $request->resep);
            $resep_jumlah = decode('resep', 'jumlah', $request->resep);
            $resep_dosis = decode('resep', 'aturan', $request->resep);
        }
        else {
            $resep_id = "";
            $resep_jumlah = "";
            $resep_dosis = "";
        }

        $newresep = array();
        $oldresep = array();

        foreach($request->resep as $resep) {
            $newresep[$resep['id']] = $resep['jumlah'];
        }

        if(empty($oldresep)) {
            $resultanresep = resultan_resep($oldresep, $newresep);
        }
        else {
            $resultanresep = $newresep;
        }

        $errors = validasi_stok($resultanresep);
        if($errors !== NULL) {
            return back()->withErrors($errors);
        }

        foreach ($resultanresep as $key => $value) {
            $perintah = kurangi_stok($key, $value);
            if($perintah === false) {$habis = array_push($habis, $key);}
        }

        DB::table('rekam_medis')->insert([
            'idpasien' => $request->idpasien,
            'pemeriksa' => $request->pemeriksa,
            'gejala' => $request->gejala,
            'anamnesis' => $request->anamnesis,
            'pfisik' => $request->pfisik,
            'lab' => $lab_id,
            'hasil' => $lab_hasil,
            'diagnosis' => $request->diagnosis,
            'resep' => $resep_id,
            'jumlah' => $resep_jumlah,
            'aturan' => $resep_dosis,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $ids = DB::table('rekam_medis')->latest('created_at')->first();
        switch($request->save) {
            case 'save':
                $buka = route('rekam_medis', $ids->id);
                $pesan = 'Data Pasien Berhasil Disimpan!';
            break;
            case 'save_tagihan':
                $buka = route('tagihan', $request->id);
                $pesan = 'Data Rekam Medis Berhasil Disimpan!';
            break;
        }

        return redirect($buka)->with('pesan', $pesan);
    }

    public function tagihan($id) {
        $datas = ambil_satudata('datas', 14);
        $pasiens = ambil_semuadata('pasiens');
        $temps = ambil_satudata('rekam_medis', $id);
        $cont = [
            'aria' => 'false',
            'show' => '',
            'col' => 'collapsed'
        ];

        foreach($temps as $temp) {
            $idpasien = $temp->idpasien;
            $labs_id = encode($temp->lab);
            $obats_id = encode($temp->resep);
            $jumlah_obat = encode($temp->jumlah);
        }

        $idens = DB::table('pasiens')->where('id', $idpasien)->get();
        $items = array();

        foreach($labs_id as $lab_id) {
            $entries = ambil_satudata('labs', $lab_id);

            foreach($entries as $entry) {
                $items[$entry->lab] = [$entry->harga, $n=1, $entry->harga * $n];
            }
        }

        for($i=0; $i<sizeof($obats_id); $i++) {
            $entries = ambil_satudata('obats', $obats_id[$i]);

            foreach($entries as $entry) {
                $items[$entry->obat] = [$entry->harga, $n=$jumlah_obat[$i], $entry->harga * $n];
            }
        }

        return view('tagihan', compact('datas', 'pasiens', 'cont', 'idens', 'items'));
    }

    public function view_rm($id) {
        $datas = ambil_satudata('datas', 15);
        $pasiens = ambil_semuadata('pasiens');
        $temps = ambil_satudata('rekam_medis', $id);
        $cont = [
            'aria' => 'false',
            'show' => '',
            'col' => 'collapsed'
        ];

        if($temps->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan');
        }

        foreach($temps as $temp) {
            $idpasien = $temp->idpasien;

            if($temp->lab != NULL) {
                $temp->labhasil = array_combine(encode($temp->lab), encode($temp->hasil));
                $num['lab'] = sizeof($temp->labhasil);
            }
            else {
                $num['lab'] = 0;
            }

            if($temp->resep != NULL) {
                $temp->allresep = array_combine(encode($temp->resep), encode($temp->aturan));
                $temp->jum = encode($temp->jumlah);
                $num['resep'] = sizeof($temp->allresep);
            }
            else {
                $num['resep'] = 0;
            }
        }
        $labs = ambil_semuadata('labs');
        $obats = ambil_semuadata('obats');
        $idens = DB::table('pasiens')->where('id', $idpasien)->get();

        return view('view-rm', compact('datas', 'pasiens', 'idens', 'temps', 'cont', 'labs', 'obats', 'num'));
    }
}
