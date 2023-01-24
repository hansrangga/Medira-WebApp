@extends('main')
@foreach ($datas as $data)
    @section('judul_halaman')
        {{$data->judul}}
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
                                            <h6 class="m-0 font-weight-bold text-primary">Edit Data Obat</h6>
                                        </div>
                                        <div class="card-body">
                                            <code class="mb-6">Data terakhir diperbaharui {{ hitung_hari($temp->updated_at) }} yang lalu</code>
                                            <form action="{{route('obat_update')}}" class="user" method="POST">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{$temp->id}}">
                                                <div class="form-group">
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="obat" class="col-sm-2 col-form-label">Obat:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="obat" value="{{$temp->obat}}" placeholder="Nama Obat">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="satuan" class="col-sm-2 col-form-label">Satuan:</label>
                                                        <div class="input-group col-sm-10 mb-3 mb-sm-0">
                                                            <select class="form-select col-sm-12 mb-3 mb-sm-0" id="satuan">
                                                                <option selected disabled>Satuan</option>
                                                                <option value="gr" {{$temp->satuan == 'g' ? 'selected' : '' }}>gr</option>
                                                                <option value="mg" {{$temp->satuan == 'mg' ? 'selected' : '' }}>mg</option>
                                                                <option value="mcg" {{$temp->satuan == 'mcg' ? 'selected' : '' }}>mcg</option>
                                                                <option value="mg/5ml" {{$temp->satuan == 'mg/5ml' ? 'selected' : '' }}>mg/5ml</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="jenis" class="col-sm-2 col-form-label">Jenis:</label>
                                                        <div class="input-group col-sm-10 mb-3 mb-sm-0">
                                                            <select class="form-select col-sm-12 mb-3 mb-sm-0" id="jenis">
                                                                <option selected disabled>Jenis</option>
                                                                <option value="Sirup" {{$temp->jenis == 'Sirup' ? 'selected' : '' }}>Sirup</option>
                                                                <option value="Tablet" {{$temp->jenis == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                                                                <option value="Kapsul" {{$temp->jenis == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="dosis" class="col-sm-2 col-form-label">Dosis:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="dosis" value="{{$temp->dosis}}" placeholder="Dosis Obat">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="stok" class="col-sm-2 col-form-label">Stok:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="stok" value="{{$temp->stok}}" placeholder="Stok Obat">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 ml-2 row">
                                                        <label for="harga" class="col-sm-2 col-form-label">Harga:</label>
                                                        <div class="col-sm-10 mb-3 mb-sm-0">
                                                            <input type="text" class="form-control" name="harga" value="{{$temp->harga}}" placeholder="Harga Obat">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mt-4 justify-content-center">
                                                    <div class="col-sm-2">
                                                        <a href="{{route('obat')}}" class="btn btn-danger btn-block">
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
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                        </div>
@endsection
