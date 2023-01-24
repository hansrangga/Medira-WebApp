<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

    function hitung_hari($tgl_lhr) {
        $tglskrg =Carbon::now();
        $tgl_lhr = Carbon::parse($tgl_lhr);
        $usia = $tglskrg->diffInYears($tgl_lhr);
        $satuan = "Tahun";
        if ($usia < 1) {
            $usia = $tglskrg->diffInMonths($tgl_lhr);
            $satuan = "Bulan";
        }
        if ($usia < 1) {
            $usia = $tglskrg->diffInDays($tgl_lhr);
            $satuan = "Hari";
        }
        if ($usia < 1) {
            $usia = $tglskrg->diffInHours($tgl_lhr);
            $satuan = "Jam";
        }
        if ($usia < 1) {
            $usia = $tglskrg->diffInMinutes($tgl_lhr);
            $satuan = "Menit";
        }
        $output = $usia . ' ' . $satuan;
        return ($output);
    }

    function ambil_semuadata($tabel) {
        if (Schema::hasColumn($tabel, 'deleted')) {
            $temp = DB::table($tabel)->orderBy('id', 'desc')->where('deleted', '<>', 1)->get();
        }
        else {
            $temp = DB::table($tabel)->orderBy('id', 'desc')->get();
        }

        return ($temp);
    }

    function ambil_satudata($tabel, $id) {
        if (Schema::hasColumn($tabel, 'deleted')) {
            $temp = DB::table($tabel)->where('id', $id)->where('deleted', '<>', 1)->get();
        }
        else {
            $temp = DB::table($tabel)->where('id', $id)->get();
        }

        return ($temp);
    }

    function rupiah($angka){
        if(is_numeric($angka)) {
            $rupiah = 'Rp ' . number_format($angka, '2', ',', '.');
            return $rupiah;
        }
        else {
            return "$rupiah" . " bukan angka yang valid!" . "\n";
        }
    }

    function set_menu($uri, $output = 'active') {
        if(is_array($uri)) {
            foreach ($uri as $u) {
                if(Route::is($u)) {
                    return $output;
                }
            }
        }
        else {
            if(Route::is($uri)) {
                return $output;
            }
        }
    }

    function set_show($uri, $output = 'show') {
        if(is_array($uri)) {
            foreach ($uri as $u) {
                if(Route::is($u)) {
                    return $output;
                }
            }
        }
        else {
            if(Route::is($uri)) {
                return $output;
            }
        }
    }

    function decode($input, $tipe, $request) {
        $output = "";
        foreach ($request as $key => $value) {
            $q = ($value[$tipe]);
            $output = $output ."|". $q;
        }

        $output = substr($output, 1);
        return $output;
    }

    function encode($string) {
        $output = explode("|", "$string");
        return $output;
    }

    function format_date($date) {
        $output = Carbon::parse($date);
        $output = $output->format('d M Y');
        return $output;
    }

    function get_value($tabel, $id, $col){
        $output = NULL;
        $temp = DB::table($tabel)->where('id', $id)->get();
        foreach ($temp as $t) {
            $output = $t->$col;
        }

        return $output;
    }

    function has_dupes($array) {
        return count($array) !== count(array_unique($array));
    }

    function total_harga($items) {
        $total = 0;
        foreach ($items as $item) {
            $total = $total + $item[2];
        }

        return $total;
    }

    function resultan_resep($oldresep, $newresep) {
        $resultranresep = array();
        foreach ($oldresep as $key => $value) {
            if(array_key_exists($key, $oldresep) === true && array_key_exists($key, $newresep) === true) {
                $resultranresep[$key] = $newresep[$key] - $value;
            }
            else if(array_key_exists($key, $oldresep) === true && array_key_exists($key, $newresep) === false) {
                $resultranresep[$key] = -$value;
            }
        }
        foreach ($newresep as $key => $value) {
            if(array_key_exists($key, $oldresep) === false && array_key_exists($key, $newresep) === true) {
                $resultranresep[$key] = $value;
            }
        }

        return $resultranresep;
    }

    function cek_stok($id, $jumlah) {
        $cek = get_value('obats', $id, 'stok') - $jumlah;
        if($cek < 0) {return false;}
        else {return true;}
    }

    function cek_stok_warning($min) {
        $obats = ambil_semuadata('obats');
        $minim = array();
        foreach ($obats as $obat) {
            if(cek_stok($obat->id, $min) === false) {
                array_push($minim, $obat->id);
            }
        }
        if(count($minim) > 0) {
            for ($i=0; $i<sizeof($minim); $i++) {
                $warning[$minim[$i]] = "Stok Obat " . get_value('obats', $minim[$i], 'obat') . " " . get_value('obats', $minim[$i], 'jenis') . " " . get_value('obats', $minim[$i], 'dosis') . " " . get_value('obats', $minim[$i], 'satuan') . " Mulai Menipis atau Habis";

            return $warning;
            }
        }

        $warning = array();
        return $warning;
    }

    function kurangi_stok($id, $jumlah) {
        $resultan = get_value('obats', $id, 'stok') - $jumlah;
        DB::table('obats')->where('id', $id)->update([
            'stok' => $resultan,
        ]);
    }

    function validasi_stok($resultranresep) {
        $habis = array();
        foreach ($resultranresep as $key => $value) {
            if(cek_stok($key, $value) === false) {
                array_push($habis, $key);
            }
        }
        if($habis !== NULL) {
            if(is_array($habis)) {
                $i = 0;
                foreach ($habis as $h) {
                    $errors['resep'[$i]] = 'Stok Obat' . get_value('obats', $h, 'obat') . ' ' . get_value('obats', $h, 'jenis'). ' ' . get_value('obats', $h, 'dosis') . ' ' . get_value('obats', $h, 'satuan') .' Tidak Cukup!';
                    $i++;
                }
                if(isset($errors)) {
                    return $errors;
                }
                else {
                    return NULL;
                }
            }
            else {
                $errors['resep'] = 'Stok Obat '. get_value('obats', $habis, 'obat') . ' ' . get_value('obats', $habis, 'jenis'). ' ' . get_value('obats', $habis, 'dosis') . ' ' . get_value('obats', $habis, 'satuan') .' Tidak Cukup!';
                if(isset($errors)) {
                    return $errors;
                }
                else {
                    return NULL;
                }
            }
        }
    }
?>
