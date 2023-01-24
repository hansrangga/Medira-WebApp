@extends('main')
@foreach ($datas as $data)
    @section('judul_halaman')
        {{$data->judul }}
    @endsection
@endforeach
@section('content')

                        <!-- Card Row -->
                        <div class="row">

                            <!-- Jumlah Pasien -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="{{route('pasien')}}" class="text-decoration-none card bg-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Pasien Terdaftar</div>
                                                <div class="h5 mb-0 font-weight-bold text-white">{{$jumlah['pasien']}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-users fa-3x text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Jumlah Kunjungan Mingguan-->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="{{route('rekam_medis')}}" class="text-decoration-none card bg-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Kunjungan Minggu Ini</div>
                                                <div class="h5 mb-0 font-weight-bold text-white">{{$jumlah['kunjungan']}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-eye fa-3x text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Jumlah Fasilitas Lab-->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="{{route('lab')}}" class="text-decoration-none card bg-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Fasilitas Lab</div>
                                                <div class="h5 mb-0 font-weight-bold text-white">{{$jumlah['lab']}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-flask fa-3x text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Jumlah Obat-->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="{{route('obat')}}" class="text-decoration-none card bg-danger shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Jumlah Obat</div>
                                                <div class="h5 mb-0 font-weight-bold text-white">{{$jumlah['obat']}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-prescription-bottle-alt fa-3x text-white"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Graph and Task Row -->
                        <div class="row mt-4">

                            <!-- Graph -->
                            <div class="col-xl-7 col-lg-7">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Grafik Kunjungan Minggu Ini</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="chart-area">
                                                <canvas id="myAreaChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Task -->
                            <div class="col-xl-5 col-lg-5">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Tugas Hari Ini</h6>
                                        <a href="" class="d-none d-sm-inline-block btn btn-success btn-sm shadow-sm right-side-style">
                                            <i class="fas fa-plus-circle"> Tambah Tugas</i>
                                        </a>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="#">Mark All</a>
                                                <a class="dropdown-item" href="#">Clear Mark</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-5">
                                        <ul class="list-group mb-0 mt-0">
                                            <li
                                              class="list-group-item d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">
                                              <div class="d-flex align-items-center ml-3">
                                                <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
                                                Input Stok Obat
                                              </div>
                                              <a href="#!" data-mdb-toggle="tooltip" title="Remove item">
                                                <i class="fas fa-times-circle text-danger"></i>
                                              </a>
                                            </li>
                                            <li
                                              class="list-group-item d-flex d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">
                                              <div class="d-flex align-items-center ml-3">
                                                <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." checked />
                                                Review Stok Obat
                                              </div>
                                              <a href="#!" data-mdb-toggle="tooltip" title="Remove item">
                                                <i class="fas fa-times-circle text-danger"></i>
                                              </a>
                                            </li>
                                            <li
                                              class="list-group-item d-flex d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">
                                              <div class="d-flex align-items-center ml-3">
                                                <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
                                                Review Data Pasien
                                              </div>
                                              <a href="#!" data-mdb-toggle="tooltip" title="Remove item">
                                                <i class="fas fa-times-circle text-danger"></i>
                                              </a>
                                            </li>
                                            <li
                                              class="list-group-item d-flex d-flex justify-content-between align-items-center border-start-0 border-top-0 border-end-0 border-bottom rounded-0 mb-2">
                                              <div class="d-flex align-items-center ml-3">
                                                <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
                                                Review Laporan
                                              </div>
                                              <a href="#!" data-mdb-toggle="tooltip" title="Remove item">
                                                <i class="fas fa-times-circle text-danger"></i>
                                              </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection
