<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.2
 * @link http://coreui.io
 * Copyright (c) 2016 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="IR-fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="}">
    <title></title>
    <!-- Icons -->
    <link href="{{ asset('assets/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('assets/newLayout/dest/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

</head>

<body class="navbar-fixed sidebar-nav fixed-nav">
<header class="navbar">
<div>
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        <a class="navbar-brand" href="#" ></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
            </li>


        </ul>
        <ul class="nav navbar-nav pull-left hidden-md-down">

            <li class="nav-item dropdown" style="margin-left: 10px !important">
                {{ auth()->user()->name }}({{ auth()->user()->status }})</li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    <span class="hidden-md-down"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-xs-center">
                        <strong></strong>
                    </div>
                    <a class="dropdown-item" href=""><i
                            class="fa fa-user"></i></a>
                    <div class="divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                        {{ __('words.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    <span class="hidden-md-down"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">



                </div>
            </li>


            <li class="nav-item">

            </li>

        </ul>
    </div>
</header>

<!-- Main content -->
<main class="main" style="margin-top: 25px">
    @yield('body')
</main>



<footer class="footer">
    <a href="http://coreui.io" target="_blank"> <span class="text-left">كورس انشاء مدونة إلكترونية
                &copy; 2022.
            </span></a>

</footer>
<script src="{{ asset('assets/newLayout/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/libs/tether.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/libs/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/libs/pace.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/libs/Chart.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/app.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/views/main.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    var allEditors = document.querySelectorAll('#editor');
    for (var i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i]);
    }
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>


@stack('javascripts')
</body>

</html>
