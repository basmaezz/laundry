

    <!DOCTYPE html>
<html lang="IR-fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->
    <title>CoreUI Bootstrap 4 Admin Template</title>
    <!-- Icons -->
    <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/simple-line-icons.css')}}" rel="stylesheet">
    <!-- Main st{{asset('assets/admin/yles for t')}}his application -->
    <link href="{{asset('assets/admin/dest/style.css')}}" rel="stylesheet">
</head>

<body class="navbar-fixed sidebar-nav fixed-nav">
<header class="navbar">
    <div class="container-fluid">
        <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
        <a class="navbar-brand" href="#"></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-left hidden-md-down">
            <li class="nav-item">
                <a class="nav-link aside-toggle" href="#"><i class="icon-bell"></i><span class="tag tag-pill tag-danger">5</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-list"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-location-pin"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="img/avatars/6.jpg" class="img-avatar" alt="admin@bootstrapmaster.com">
                    <span class="hidden-md-down">مدیر</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-xs-center">
                        <strong>تنظیمات</strong>
                    </div>
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> پروفایل</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> تنظیمات</a>
                    <!--<a class="dropdown-item" href="#"><i class="fa fa-usd"></i> Payments<span class="tag tag-default">42</span></a>-->
                    <div class="divider"></div>
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> خروج</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link navbar-toggler aside-toggle" href="#">&#9776;</a>
            </li>

        </ul>
    </div>
</header>
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="index.html"><i class="icon-speedometer"></i> الرئيسيه <span class="tag tag-info">جدید</span></a>
            </li>

               <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}"><i class="icon-user-follow"></i> عرض الكل </a>
                <a class="nav-link" href="{{route('user.create')}}"><i class="icon-user-follow"></i> اضافه أدمن  </a>
                <a class="nav-link" href="#"><i class="icon-people"></i>  الأدوار - الصلاحيات</a>
{{--                   <a class="nav-link" href="{{route('user.create')}}"><i class="icon-user-follow"></i> اضافه عميل  </a>--}}

               </li>

            <li class="nav-title">
                مقدمين الخدمه
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="icon-docs"></i>   المناديب</a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{route('laundries.index')}}"><i class="icon-people"></i> اداره المغاسل</a>
                <a class="nav-link" href="{{route('laundries.admins')}}"><i class="icon-user-follow"></i>  أدمن المغاسل  </a>
            </li>
        </ul>
    </nav>
</div>
<!-- Main content -->

@yield('content')
<footer class="footer">
        <span class="text-left">
        </span>
    <span class="pull-right">
        </span>
</footer>
<script src="{{asset('assets/admin/js/libs/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/tether.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/pace.min.js')}}"></script>
{{--<script src="{{asset('assets/admin/js/libs/Chart.min.js')}}"></script>--}}
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script src="{{asset('assets/admin/js/views/main.js')}}"></script>

<script src="//localhost:35729/livereload.js"></script>
</body>

</html>
