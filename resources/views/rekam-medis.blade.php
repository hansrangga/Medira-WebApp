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
                                <form action="" id="deleteForm" method="POST">
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
                        <div class="card shadow mb-4 mt-lg-5">
                            <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pilih Pasien</h6>
                            </div>
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

                        <!-- List Table Data -->
                        <div class="card shadow mb-4 mt-lg-5">
                            <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medis</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="pasien" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID RM</th>
                                                <th>ID Pasien</th>
                                                <th>Tanggal Periksa</th>
                                                <th>Gejala</th>
                                                <th>Lab</th>
                                                <th>Diagnosis</th>
                                                <th>Terapi</th>
                                                <th width="120px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rekam_medis as $rm)
                                                <tr>
                                                    <td>{{str_pad($rm->id, 4, '0', STR_PAD_LEFT)}}</td>
                                                    <td>{{str_pad($rm->idpasien, 4, '0', STR_PAD_LEFT)}}</td>
                                                    <td>{{format_date($rm->created_at)}}</td>
                                                    <td>{{$rm->gejala}}</td>
                                                    <td>
                                                        @if ($rm->lab != NULL)
                                                            @for ($i=0; $i<sizeof($lab=encode($rm->lab)); $i++)
                                                                @if ($has=encode($rm->hasil))
                                                                    <li>{{get_value('labs', $lab[$i], 'lab')}} : {{$has[$i]}} {{get_value('labs', $lab[$i], 'satuan')}}</li>
                                                                @endif
                                                            @endfor
                                                        @endif
                                                    </td>
                                                    <td>{{$rm->diagnosis}}</td>
                                                    <td>
                                                        @if ($rm->resep != NULL)
                                                            @for ($i=0; $i<sizeof($resep=encode($rm->resep)); $i++)
                                                                @if ($aturan=encode($rm->aturan))
                                                                    <li>{{get_value('obats', $resep[$i], 'obat')}} {{get_value('obats', $resep[$i], 'jenis')}} {{get_value('obats', $resep[$i], 'dosis')}} {{get_value('obats', $resep[$i], 'dosis')}} {{get_value('obats', $resep[$i], 'satuan')}} : {{$aturan[$i]}}</li>
                                                                @endif
                                                            @endfor
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{route('rekammedis_edit', $rm->id)}}" class="btn btn-circle btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn btn-circle btn-danger" data-toggle="modal" onclick="deleteData({{$rm->id}})" data-target="#deleteModal">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                        <a href="{{route('rekammedis_view', $rm->id)}}" class="btn btn-circle btn-success">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{route('tagihan', $rm->id)}}" class="btn btn-circle btn-warning">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <script type="text/javascript">
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
                                var url = '{{route('rekammedis_delete', ':id')}}';
                                url = url.replace(':id', id);
                                $("#deleteForm").attr('action', url);
                            }

                            function formSubmit(){
                                $("#deleteForm").submit();
                            }
                        </script>
@endsection
