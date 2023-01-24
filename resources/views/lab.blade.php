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
                                        <h6 class="m-0 font-weight-bold text-primary">Input Data Lab</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('lab_save')}}" class="user" method="POST">
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <div class="mb-3 ml-2 row">
                                                    <label for="lab" class="col-sm-2 col-form-label">Nama Lab:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="lab" placeholder="Nama Pemeriksaan Lab" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="satuan" class="col-sm-2 col-form-label">Satuan:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="satuan" placeholder="Satuan" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 ml-2 row">
                                                    <label for="harga" class="col-sm-2 col-form-label">Harga:</label>
                                                    <div class="col-sm-10 mb-3 mb-sm-0">
                                                        <input type="text" class="form-control" name="harga" placeholder="Harga" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mt-4 justify-content-center">
                                                <div class="col-sm-2">
                                                    <a href="{{route('lab')}}" class="btn btn-danger btn-block">
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
                                        <h6 class="m-0 font-weight-bold text-primary">Data Lab</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Lab</th>
                                                        <th>Harga</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($labs as $lab)
                                                        <tr>
                                                            <td>{{$lab->id}}</td>
                                                            <td>{{$lab->lab}}</td>
                                                            <td>{{rupiah($lab->harga)}}</td>
                                                            <td>
                                                                <a href="{{route('lab_edit', $lab->id)}}" class="btn btn-sm btn-circle btn-primary">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="javascript:;" class="btn btn-sm btn-circle btn-warning" data-toggle="modal" onclick="deleteData({{$lab->id}})" data-target="#deleteModal">
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
                                var url = '{{route('lab_delete', ':id')}}';
                                url = url.replace(':id', id);
                                $("#deleteForm").attr('action', url);
                            }

                            function formSubmit(){
                                $("#deleteForm").submit();
                            }
                        </script>
@endsection
