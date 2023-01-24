@extends('main')
@foreach ($datas as $data)
    @section('judul_halaman')
        {{$data->judul}}
    @endsection
@endforeach
@section('content')
                        <!-- List Pasien -->
                        <div class="card shadow mb-4 ml-0">
                            <a href="#pilihPasien" class="d-block card-header py-3 {{$cont['col']}}" data-toggle="collapse" role="button" aria-expanded="{{$cont['aria']}}" aria-controls="pilihPasien">
                                <h6 class="m-0 font-weight-bold text-primary">Pilih Pasien</h6>
                            </a>
                            <div class="collapse {{$cont['show']}}" id="pilihPasien" style="">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="pasien" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="120px">No.Pasien</th>
                                                    <th>Nama Pasien</th>
                                                    <th>Nomor Hp</th>
                                                    <th width="120px">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pasiens as $pasien)
                                                    <tr>
                                                        <td>{{str_pad($pasien->id, 4, '0', STR_PAD_LEFT)}}</td>
                                                        <td>{{$pasien->nama}}</td>
                                                        <td>{{$pasien->telpnumber}}</td>
                                                        <td>
                                                            <a href="{{route('rekammedis_add', $pasien->id)}}" class="btn btn-primary btn-icon-split">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-check"></i>
                                                                </span>
                                                                <span class="text">Pilih</span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <!-- List Table Data -->
                            <div class="col-xl-5 col-lg-5">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Identitas Pasien</h6>
                                    </div>
                                    <div class="card-body">
                                        @if (isset($idens))
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
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Tambah Rekam Medis -->
                            <div class="col-lg-7">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Input Rekam Medis</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('rekammedis_save')}}" class="user" method="POST">
                                            {{csrf_field()}}
                                            @foreach ($idens as $iden)
                                                <input type="hidden" name="idpasien" value="{{$iden->id}}">
                                            @endforeach
                                            <div class="form-group">
                                                <div class="mb-3 ml-2 row">
                                                    <label for="pemeriksa" class="col-sm-2 col-form-label">Pemeriksa:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="pemeriksa" placeholder="Dokter Pemeriksa">
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="gejala" class="col-sm-2 col-form-label">Gejala:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <textarea class="form-control" name="gejala" rows="3" placeholder="Gejala" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="umur" class="col-sm-2 col-form-label">Anamnesis:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <textarea class="form-control" name="anamnesis" rows="3" placeholder="Amamnesis"></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="pfisik" class="col-sm-2 col-form-label">Pemeriksaan Fisik:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <textarea class="form-control" name="pfisik" rows="3" placeholder="Pemeriksaan Fisik"></textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="plab" class="col-sm-2 col-form-label">Pemeriksaan Lab:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <select class="form-select col-sm-10 mb-3 mb-sm-0" id="plab" name="plab">
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
                                                        <table id="addOnTable"></table>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="diagnosis" class="col-sm-2 col-form-label">Diagnosis:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="diagnosis" placeholder="Diagnosis">
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="resepList" class="col-sm-2 col-form-label">Resep:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <select class="form-select col-sm-7 mb-3 mb-sm-0" name="resepList" id="resepList">
                                                            <option selected disabled>Pilih salah satu</option>
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
                                                        <table width="100%" id="addOnTable2"></table>
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
                            var i=0;
                            var a=0;

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
