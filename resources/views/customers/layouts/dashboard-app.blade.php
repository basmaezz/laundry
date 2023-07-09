
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
{{--    @if(App::isLocale('en'))--}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/customers/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/customers/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/customers/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/customers/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" ></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/customers/dist/css/adminlte.min.css')}}">
{{--    @else--}}

{{--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">--}}
{{--        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/dist/css/AdminLTE.min.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/dist/css/skins/_all-skins.min.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/plugins/iCheck/flat/blue.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/plugins/morris/morris.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/plugins/datepicker/datepicker3.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/plugins/daterangepicker/daterangepicker-bs3.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/dist/fonts/fonts-fa.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/dist/css/bootstrap-rtl.min.css')}}">--}}
{{--        <link rel="stylesheet" href="{{asset('assets/customers/Arabic/dist/css/rtl.css')}}">--}}
{{--    @endif--}}

</head>

@section('content')
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link"></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">

                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('customer.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Main</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Products
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('Customer.Items.index',Auth::user()->subCategory_id)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>products and services</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                                <p>--}}
{{--                                    Items--}}
{{--                                    <i class="right fas fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('Customer.Items.index',Auth::user()->subCategory_id)}}" class="nav-link">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Items</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                                <p>--}}
{{--                                    Products--}}
{{--                                    <i class="right fas fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('Customer.Products.index',Auth::user()->subCategory_id)}}" class="nav-link">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Products</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                                <p>--}}
{{--                                    Services--}}
{{--                                    <i class="right fas fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('Customer.Products.viewAllServices',Auth::user()->subCategory_id)}}" class="nav-link">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>All Services</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Orders
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" style="background-color: #0a4e25">
                                    <a href="{{route('Customer.Orders.inProgress',Auth::user()->subCategory_id)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Orders In Progress</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('Customer.Orders.index',Auth::user()->subCategory_id)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Orders</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('Customer.Orders.finishedOrder',Auth::user()->subCategory_id)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Orders Finished</p>
                                    </a>
                                </li>
                                <li class="nav-item" style="background-color: red">
                                    <a href="{{route('Customer.Orders.canceledOrder',Auth::user()->subCategory_id)}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Canceled Orders</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <form method="post" action="{{ route('logoutLaundryAdmin') }}">
                                @csrf

                                <button type="submit" class="dropdown-item" style="background-color: whitesmoke">   <i class="far fa-circle nav-icon"></i>خروج</button>
                            </form>
{{--                            <a href="{{route('Customer.Orders.index',Auth::user()->subCategory_id)}}" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Logout</p>--}}
{{--                            </a>--}}
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="#" class="nav-link">--}}
{{--                                <i class="nav-icon fas fa-tachometer-alt"></i>--}}
{{--                                <p>--}}
{{--                                    Images--}}
{{--                                    <i class="right fas fa-angle-left"></i>--}}
{{--                                </p>--}}
{{--                            </a>--}}
{{--                            <ul class="nav nav-treeview">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('Customer.Items.index',Auth::user()->subCategory_id)}}" class="nav-link">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Images</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('Customer.Items.index',Auth::user()->subCategory_id)}}" class="nav-link">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>Upload Image</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                            </ul>--}}
{{--                        </li>--}}

                 </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        @yield('content')
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">

            </div>

        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="{{asset('assets/customers/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/customers/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <script src="{{asset('assets/customers/dist/js/adminlte.min.js')}}"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(function () {

            $('#quickForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    terms: "Please accept our terms"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    </body>
</html>
