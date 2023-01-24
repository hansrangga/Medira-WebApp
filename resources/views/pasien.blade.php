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

                        <!-- Input Data and Table Data -->
                        <div class="row mt-4">

                            <!-- Input Data -->
                            <div class="col-xl-5 col-lg-5">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Input Data Pasien</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('pasien_save')}}" class="user" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <div class="mb-3 ml-2 row">
                                                    <label for="namalengkap" class="col-sm-2 col-form-label">Nama:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="umur" class="col-sm-2 col-form-label">Umur:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="umur" placeholder="Umur" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="alamat" placeholder="Alamat Lengkap" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="telpnumber" class="col-sm-2 col-form-label">Nomor Hp:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="telpnumber" placeholder="Nomor Telepon" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-4 justify-content-center">
                                                <div class="col-sm-2">
                                                    <a href="{{route('pasien')}}" class="btn btn-danger btn-block">
                                                        Clear
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit" class="btn btn-success btn-block" name="save" value="save">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- Table Data -->
                            <div class="col-xl-7 col-lg-7">
                                <div class="card shadow mb-4">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Umur</th>
                                                        <th>Alamat</th>
                                                        <th>No.Hp</th>
                                                        <th>Transaksi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pasiens as $pasien)
                                                        <tr>
                                                            <td width="10%">{{str_pad($pasien->id, 4, '0', STR_PAD_LEFT)}}</td>
                                                            <td>{{$pasien->nama}}</td>
                                                            <td>{{$pasien->umur}}</td>
                                                            <td class="text-truncate" style="max-width: 150px;">{{$pasien->alamat}}</td>
                                                            <td>{{$pasien->telpnumber}}</td>
                                                            <td>{{$pasien->created_at}}</td>
                                                            <td>
                                                                <a href="{{route('pasien_edit', $pasien->id)}}" title="Edit" class="btn btn-sm btn-circle btn-primary">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="javascript:;" class="btn btn-sm btn-circle btn-warning" data-toggle="modal" onclick="deleteData({{$pasien->id}})" data-target="#deleteModal">
                                                                    <i class="fas fa-trash-alt"></i>
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
                        </div>

                    <script type="text/javascript">
                        function deleteData(id){
                            var id = id;
                            var url = '{{route('pasien_delete', ':id')}}';
                            url = url.replace(':id', id);
                            $("#deleteForm").attr('action', url);
                        }

                        function formSubmit(){
                            $("#deleteForm").submit();
                        }
                    </script>
@endsection
