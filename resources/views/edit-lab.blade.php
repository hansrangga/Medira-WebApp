@extends('main')
@foreach ($datas as $datas)
    @section('judul_halaman')
        {{$datas->judul}}
    @endsection
@endforeach
@section('content')
                        <!-- Input Data and Table Data -->
                        <div class="row mt-4">

                            <!-- Input Data -->
                            @foreach ($temps as $temp)
                                <div class="col-xl-5 col-lg-5 m-auto mt-5">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Edit Data Lab</h6>
                                        </div>
                                        <div class="card-body">
                                            <code class="mb-6">Data terakhir diperbaharui {{ hitung_hari($temp->updated_at) }} yang lalu</code>
                                            <form action="{{route('lab_update')}}" class="user" method="POST">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$temp->id}}">
                                                <div class="form-group">
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="lab" class="col-sm-2 col-form-label">Nama Lab:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="lab" value="{{$temp->lab}}" placeholder="Nama Pemeriksaan Lab" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="satuan" class="col-sm-2 col-form-label">Satuan:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="satuan" value="{{$temp->satuan}}" placeholder="Satuan" required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="harga" class="col-sm-2 col-form-label">Harga:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="harga" value="{{$temp->harga}}" placeholder="Harga" required>
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
                            @endforeach
                        </div>
@endsection
