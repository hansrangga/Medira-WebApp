<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Web Application Management Clinic">
        <meta name="author" content="Mediera">

        <title>@yield('judul_halaman')</title>

        <!-- Custom Style CSS-->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Fontawesome CSS-->
        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Font Nunito CSS -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    </head>
    <body id="top-page">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-sidebar-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Brand -->
                <a href="{{route('dashboard')}}" class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon">
                        <img src="{{url ('img/logo-bidan.png')}}" width="50px">
                    </div>
                    <div class="sidebar-brand-text m-3">Mediera</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Dashboard -->
                <li class="nav-item {{ set_menu('dashboard') }}">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span> Dashboard</span>
                    </a>
                </li>

                <!-- Pasien -->
                <li class="nav-item {{ set_menu(['pasien']) }}">
                    <a href="{{route('pasien')}}" class="nav-link">
                        <i class="fas fa-user-edit"></i>
                        <span> Pasien</span>
                    </a>
                </li>

                <!-- Lab -->
                <li class="nav-item {{ set_menu(['lab']) }}">
                    <a href="{{route('lab')}}" class="nav-link">
                        <i class="fas fa-flask"></i>
                        <span> Lab</span>
                    </a>
                </li>

                <!-- Obat -->
                <li class="nav-item {{ set_menu(['obat']) }}">
                    <a href="{{route('obat')}}" class="nav-link">
                        <i class="fas fa-prescription-bottle-alt"></i>
                        <span> Obat</span>
                    </a>
                </li>

                <!-- Rekam Medis -->
                <li class="nav-item {{ set_menu(['rekam_medis'])}}">
                    <a href="{{route('rekam_medis')}}" class="nav-link">
                        <i class="fas fa-file-medical"></i>
                        <span> Rekam Medis</span>
                    </a>
                </li>

                {{-- Laporan
                <li class="nav-item {{ set_menu(['laporan']) }}">
                    <a href="{{route('laporan')}}" class="nav-link ">
                        <i class="fas fa-file-signature"></i>
                        <span> Laporan</span>
                    </a>
                </li>
                --}}
            </ul>
            <!-- End of Sidebar -->

            <!-- Content -->
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <button class="btn btn-link mr-3 btn-sidebar" id="sidebarToggleTop">
                            <i class="fas fa-bars"></i>
                        </button>

                        <!-- User Information -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-900">{{ ucfirst(Auth::user()->name) }}</span>
                                    <img src="{{url('img/profile.svg')}}" alt="" class="img-profile rounded-circle" width="60px">
                                </a>

                                <!-- Dropdown User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a href="" class="dropdown-item">
                                        <i class="fas fa-cog"></i>
                                        Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="" class="dropdown-item" data-toggle="modal" data-target="#popLogout">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <div class="container-fluid" id="contentPage">

                        <!-- Heading -->

                        <!-- Errors -->
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger dismissible fade show" role="alert">
                                    <p class="mb-0">
                                        {{ $error }}
                                    </p>
                                    <button class="close" type="button" data-dismiss="alert" aria-label="Exit">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endforeach
                        @endif

                        <!-- Warning -->
                        @if (Route::is('dashboard'))
                            @if (count($warning) > 0)
                                @foreach ($warning as $id => $pesan)
                                    <div class="alert alert-warning alert-dismissible fade show" alert="alert">
                                        <p class="mb-0">
                                            <a href="{{route('obat_edit', $id)}}" class="text-decoration-none text-dark">
                                                {{$pesan}}
                                            </a>
                                        </p>
                                        <button class="close" type="button" data-dismiss="alert" aria-label="Exit">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        @endif

                        <!-- Datapage -->
                        @yield('content')

                        <!-- Modal LogOut -->
                        <div class="modal fade" id="popLogout" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="logoutModalLabel">Are you sure to Logout?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Exit">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Click Logout if you want to end session</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a href="{{route('logout')}}" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout')}}</a>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!--JQuery JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts -->
        <script src="{{ asset('js/script.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

        <!-- DataTables JavaScript -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Chart Plugin JavaScript -->
        <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Chart JavaScript -->
        <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    </body>
</html>
