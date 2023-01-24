@extends('main')
@foreach ($datas as $datas)
    @section('judul_halaman')
        {{$datas->judul}}
    @endsection
@endforeach
@section('content')
                        <div class="row mt-4">
                            <!-- List Table Data -->
                            <div class="col-xl-5 col-lg-5">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Identitas Pasien</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($idens as $iden)
                                            <form action="" class="user" method="post">
                                                <div class="form-group">
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="nama" class="col-sm-2 col-form-label">Nama:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="nama" value="{{$iden->nama}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="umur" class="col-sm-2 col-form-label">Umur:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="umur" value="{{$iden->umur}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="alamat" value="{{$iden->alamat}}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="telpnumber" class="col-sm-2 col-form-label">Nomor Hp:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="telpnumber" value="{{$iden->telpnumber}}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Tambah Rekam Medis -->
                            @foreach ($temps as $temp)
                                <div class="col-lg-7">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Edit Rekam Medis</h6>
                                        </div>
                                        <div class="card-body">
                                            <code class="mb-6">Data terakhir diperbaharui {{ hitung_hari($temp->updated_at) }} yang lalu</code>
                                            <form action="{{route('rekammedis_update')}}" class="user" method="POST">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <input type="hidden" name="id" value="{{$temp->id}}">
                                                    <input type="hidden" name="idpasien" value="{{$temp->idpasien}}">
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="pemeriksa" class="col-sm-2 col-form-label">Pemeriksa:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="pemeriksa" value="{{$temp->pemeriksa}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="gejala" class="col-sm-2 col-form-label">Gejala:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <textarea class="form-control" name="gejala" rows="3" required>{{$temp->gejala}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="umur" class="col-sm-2 col-form-label">Anamnesis:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <textarea class="form-control" name="anamnesis" rows="3" required>{{$temp->anamnesis}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="pfisik" class="col-sm-2 col-form-label">Pemeriksaan Fisik:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <textarea class="form-control" name="pfisik" rows="3" required>{{$temp->pfisik}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="plab" class="col-sm-2 col-form-label">Pemeriksaan Lab:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <select num="{{$num['lab']}}" class="form-select col-sm-10 mb-3 mb-sm-0" id="plab" name="plab">
                                                                <option selected disabled>Pilih salah satu</option>
                                                                @foreach ($labs as $lab)
                                                                    <option satuan="{{$lab->satuan}}" value="{{$lab->id}}">{{$lab->lab}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <a href="javascript:;" onclick="addLab()" type="button" name="add" id="add" class="btn btn-success">Tambahkan</a>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <table id="addOnTable" width="100%">
                                                                @if ($temp->lab != NULL)
                                                                    @for ($i=0; $i<$num['lab']; $i++)
                                                                    <tr>
                                                                        <td><input type="hidden" name="lab[{{$i}}][id]" value="{{array_keys($temp->labhasil)[$i]}}" class="form-control" readonly></td>
                                                                        <td width="50%"><input type="text" name="lab[{{$i}}][nama]" value="{{get_value('labs',array_keys($temp->labhasil)[$i],'lab')}}" class="form-control" readonly></td>
                                                                        <td width="30%"><input type="text" name="lab[{{$i}}][hasil]" value="{{$temp->labhasil[array_keys($temp->labhasil)[$i]]}}" placeholder="Hasil" class="form-control" required>
                                                                        <td width="45%"><input class="form-control" value='{{get_value('labs',array_keys($temp->labhasil)[$i],'satuan')}}' readonly></td></td>
                                                                        <td><button type="button" class="btn btn-danger remove-plab">Hapus</button></td>
                                                                    </tr>
                                                                    @endfor
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="diagnosis" value="{{$temp->diagnosis}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="resepList" class="col-sm-2 col-form-label">Resep:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <select num="{{$num['resep']}}" class="form-select col-sm-7 mb-3 mb-sm-0" name="resepList" id="resepList">
                                                                <option value="" selected disabled>Pilih salah satu</option>
                                                                @foreach ($obats as $obat)
                                                                    <option value="{{$obat->id}}">{{$obat->obat}} {{$obat->jenis}} {{$obat->dosis}}{{$obat->satuan}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <a href="javascript:;" onclick="addResep()" type="button" name="addresep" id="addresep" class="btn btn-success">Tambahkan</a>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 ml-2 row">
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <table width="75%" id="addOnTable2">
                                                                @if ($temp->resep != NULL)
                                                                    @for ($i=0; $i<$num['resep']; $i++)
                                                                    <tr>
                                                                        <td><input type="hidden" name="resep[{{$i}}][id]" value="{{array_keys($temp->allresep)[$i]}}" class="form-control" readonly></td>
                                                                        <td width="30%"><input type="text" name="resep[{{$i}}][nama]" value="{{get_value('obats',array_keys($temp->allresep)[$i],'obat')}} {{get_value('obats',array_keys($temp->allresep)[$i],'jenis')}} {{get_value('obats',array_keys($temp->allresep)[$i],'dosis')}} {{get_value('obats',array_keys($temp->allresep)[$i],'satuan')}}" class="form-control" readonly></td>
                                                                        <td width="10%"><input type="text" name="resep[{{$i}}][jumlah]" value="{{$temp->jum[$i]}}" placeholder="Jumlah" class="form-control" required></td>
                                                                        <td width ="30%"><input type="text" name="resep[{{$i}}][aturan]" value="{{$temp->allresep[array_keys($temp->allresep)[$i]]}}" placeholder="Aturan" class="form-control" required></td>
                                                                        <td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td>
                                                                    </tr>
                                                                    @endfor
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-4 justify-content-center">
                                                    <div class="col-sm-4">
                                                        <button type="submit" class="btn btn-success btn-block" name="save" value="save">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="submit" class="btn btn-success btn-block" name="save" value="save_tagihan">
                                                            Simpan & Buat Tagihan
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <script>
                            $(document).ready(function() {
                                var table = $('#pasien').DataTable( {
                                    pageLength: 10,
                                    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
                                })
                            });
                        </script>

                        <script type="text/javascript">
                            var i = $('#plab').attr('num');
                            var a = $('#resepList').attr('num');

                            function addLab(){
                                ++i;
                                var pl = $("#plab option:selected").html();
                                var plid = $("#plab").val();
                                var satuan = $('#plab option:selected').attr('satuan');
                                if (plid !== null) {
                                    $("#addOnTable").append('<tr><td><input type="hidden" name="lab['+i+'][id]" value="'+plid+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][nama]" value="'+pl+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][hasil]" placeholder="Hasil" class="form-control" required><td width=20%"><input class="form-control" value='+satuan+' readonly></td></td><td><button type="button" class="btn btn-danger remove-plab">Hapus</button></td></tr>');
                                }
                            };

                            function addResep(){
                                ++a;
                                var res = $("#resepList option:selected").html();
                                var resid = $("#resepList").val();
                                if (resid !== null) {
                                    $("#addOnTable2").append('<tr><td><input type="hidden" name="resep['+a+'][id]" value="'+resid+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][nama]" value="'+res+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][jumlah]" placeholder="Jumlah" class="form-control" required><td><input type="text" name="resep['+a+'][aturan]" placeholder="Aturan pakai" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
                                }
                            };

                            $($document).on('click', '.remove-plab', function(){
                                $(this).parents('tr').remove();
                            });

                            $($document).on('click', '.remove-res', function(){
                                $(this).parents('tr').remove();
                            });
                        </script>
@endsection
