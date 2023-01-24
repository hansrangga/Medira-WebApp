@extends('main')
@foreach ($datas as $datas)
    @section('judul_halaman')
        {{$datas->judul}}
    @endsection
@endforeach
@section('content')
                        <!-- Confirmation Delete -->
                        <div class="modal fade text-danger" id="deleteModal" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">

                                <!-- Popup Content -->
                                <form action="" id="deleteForm:action" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h4 class="modal-title text-center text-white">Konfirmasi Penghapusan</h4>
                                            <button type="button" class="close" data-dismiss="modal" arial-label="Exit">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <p class="text-center">Data yang dihapus tidak bisa dikembalikan! Apakah sudah yakin?</p>
                                        </div>
                                        <div class="model-footer">
                                            <center>
                                                <button class="btn btn-succes" type="button" data-dismiss="modal">Batal</button>
                                                <button class="btn btn-danger" type="button" name="" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
                                            </center>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

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

                            <!-- Lihat Rekam Medis -->
                            @foreach ($temps as $temp)
                                <div class="col-lg-7">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Rekam Medis Pasien</h6>
                                        </div>
                                        <div class="card-body">
                                            <form action="" class="user" method="post">
                                                <div class="form-group">
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="tglinput" class="col-sm-4 col-form-label">Tanggal Periksa:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="tglinput" class="col-sm-5 col-form-label">{{date($temp->created_at)}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="pemeriksa" class="col-sm-4 col-form-label">Pemeriksa:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="pemeriksa" class="col-sm-8 col-form-label">{{$temp->pemeriksa}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="gejala" class="col-sm-4 col-form-label">Gejala:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="gejala" class="col-sm-8 col-form-label">{{$temp->gejala}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="anamnesis" class="col-sm-4 col-form-label">Anamnesis:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="gejala" class="col-sm-8 col-form-label">{{$temp->anamnesis}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="pfisik" class="col-sm-4 col-form-label">Pemeriksaan Fisik:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="pfisik" class="col-sm-8 col-form-label">{{$temp->pfisik}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="plab" class="col-sm-4 col-form-label">Pemeriksaan Lab:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="plab" class="col-sm-8 col-form-label">
                                                                @if ($temp->lab != NULL)
                                                                    @for ($i=0; $i<$num['lab']; $i++)
                                                                        <li>{{get_value('labs',array_keys($temp->labhasil)[$i],'lab')}} : {{$temp->labhasil[array_keys($temp->labhasil)[$i]]}} {{get_value('labs',array_keys($temp->labhasil)[$i],'satuan')}}</li>
                                                                    @endfor
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="diagnosis" class="col-sm-4 col-form-label">Diagnosis:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="diagnosis" class="col-sm-8 col-form-label">{{$temp->diagnosis}}</label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="resepList" class="col-sm-4 col-form-label">Resep:</label>
                                                        <div class="col-sm-8 mb-3 mb-sm-0">
                                                            <label for="resepList" class="col-sm-8 col-form-label">
                                                                @if ($temp->resep != NULL)
                                                                    @for ($i=0; $i<$num['resep']; $i++)
                                                                        <li>{{get_value('obats',array_keys($temp->allresep)[$i],'obat')}} {{get_value('obats',array_keys($temp->allresep)[$i],'jenis')}} {{get_value('obats',array_keys($temp->allresep)[$i],'dosis')}}  {{$temp->allresep[array_keys($temp->allresep)[$i]]}}</li>
                                                                    @endfor
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-4 justify-content-center">
                                                    <div class="col-sm-3">
                                                        <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$temp->id}})" data-target="#deleteModal" class="btn btn-danger btn-block">
                                                            <i class="fas fa-trash"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <a href="{{route('rekammedis_edit', $temp->id)}}" class="btn btn-warning btn-block">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <a href="javascript:;" class="btn btn-primary btn-block" data-toggle="modal" onclick="print()">
                                                            <i class="fas fa-print"></i>
                                                            Print
                                                        </a>
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
                                    $("#addOnTable").append('<tr><td><input type="hidden" name="lab['+i+'][id]" value="'+plid+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][nama]" value="'+pl+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][hasil]" placeholder="Hasil" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td></tr>');
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

                        <script type="text/javascript">
                            function deleteData(id){
                                var id = id;
                                var url = '{{route("rekammedis_delete", ":id")}}';
                                url = url.replace(':id', id);
                                $("#deleteForm").attr('action', url);
                            }

                            function formSubmit(){
                                $("#deleteForm").submit();
                            }

                            function print(){
                                $('#PrintRM').printThis();
                            }
                        </script>
@endsection
