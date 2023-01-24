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
    <body id="top-page">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column h-100 my-auto ">

                <!-- Main Content -->
                <div id="content">

                    <!-- Begin Page Content -->
                    <div class="container-fluid ">

                        <div class="modal show" style="padding-right: 19px; display: block;" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                <!-- 404 Error Text -->
                                <div class="text-center">
                                    <div class="error mx-auto" data-text="@yield('code')">@yield('code')</div>
                                    <p class="lead text-gray-800 mb-5">@yield('message')</p>
                                    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                                </div>
                                </div>
                                <div class="modal-footer flex-center">
                                <a class="btn btn-danger" href="{{route('dashboard')}}">&larr; Kembali</a>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->


            </div>
            <!-- End of Content Wrapper -->
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
