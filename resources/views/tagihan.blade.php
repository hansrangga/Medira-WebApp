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

                                <!-- Tagihan Rekam Medis -->
                                <div class="col-lg-7" id="tagihan">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Tagihan Rekam Medis</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-4 mt-4">
                                                @foreach ($idens as $iden)
                                                    <div class="col-sm-12 row">
                                                        <h6 class="col-sm-3 letter-to">Kepada:</h6>
                                                        <strong>{{$iden->nama}}</strong>
                                                    </div>
                                                    <div class="col-sm-12 row">
                                                        <h6 class="col-sm-3 letter-to">Usia:</h6>
                                                        <strong>{{$iden->umur}}</strong>
                                                    </div>
                                                    <div class="col-sm-12 row">
                                                        <h6 class="col-sm-3 letter-to">Alamat:</h6>
                                                        <strong>{{$iden->alamat}}</strong>
                                                    </div>
                                                    <div class="col-sm-12 row">
                                                        <h6 class="col-sm-3 letter-to">No.Hp:</h6>
                                                        <strong>{{$iden->telpnumber}}</strong>
                                                    </div>
                                                @endforeach
                                                <div class="mt-4 table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="center">#</th>
                                                                <th>Item</th>
                                                                <th class="center">Harga</th>
                                                                <th class="center">Qty</th>
                                                                <th class="center">Subtotal</th>
                                                                <th class="center">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for ($n=0; $n<sizeof($items); $n++)
                                                                <tr>
                                                                    <td>{{$n + 1}}</td>
                                                                    <td>{{$item=array_keys($items)[$n]}}</td>
                                                                    @for ($i=0; $i<3; $i++)
                                                                        @if ($i != 1)
                                                                            <td>{{rupiah($items[$item][$i])}}</td>
                                                                        @else
                                                                            <td>{{$items[$item][$i]}}</td>
                                                                        @endif
                                                                    @endfor
                                                                    <td>
                                                                        <a href="javascript:;" class="btn btn-sm btn-circle btn-danger" data-toggle="modal" data-target="#deleteModal">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                            <tr>
                                                                <th class="center"></th>
                                                                <th>Total Harga</th>
                                                                <th class="center"></th>
                                                                <th class="center"></th>
                                                                <th class="center">{{rupiah(total_harga($items))}}</th>
                                                                <th class="center">
                                                                    <a href="javascript:;" class="btn btn-group btn-info" data-toggle="modal" onclick="print()">
                                                                        <i class="fas fa-print"></i>
                                                                    </a>
                                                                </th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-sm-12">
                                                <a href="{{route('rekam_medis')}}" class="btn btn-block btn-danger">
                                                    <span class="icon">
                                                        <i class="fa fa-arrow-left"> Kembali</i>
                                                    </span>
                                                </a>
                                                </div>
                                            </div>
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

                                function print(){
                                    $('#print').printThis();
                                }
                            </script>
@endsection
