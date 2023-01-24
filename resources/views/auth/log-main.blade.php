<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Web Application Management Clinic">
        <meta name="author" content="Mediera">

        <title>@yield('judul_halaman')</title>

        <!-- Custom Style CSS-->
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">

        <!-- Fontawesome CSS-->
        <link href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Font Nunito CSS -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    </head>
    <body class="bg-gradient-danger">

        <div class="container">
            <div class="justify-content-center row">
                <div class="col-xl-10 col-lg-12 col-md-9">

                    <!-- Login Page with cards -->
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-12 mt-5 bg-login-image"></div>
                                <div class="col-lg-12 text-center">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!--JQuery JavaScript-->
        <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts -->
        <script src="{{ URL::asset('js/script.js') }}"></script>
        <script src="{{ URL::asset('js/custom.js') }}"></script>

        <!-- DataTables JavaScript -->
        <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Chart Plugin JavaScript -->
        <script src="{{ URL::asset('vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Chart JavaScript -->
        <script src="{{ URL::asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ URL::asset('js/demo/datatables-demo.js') }}"></script>
    </body>
</html>
