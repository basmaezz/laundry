<!DOCTYPE html>
<html lang="IR-fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Admin Dashboard</title>

    <link href="{{asset('assets/admin/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/dest/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/customStyle.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/customers/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/customers/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/customers/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

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
                <a class="nav-link aside-toggle" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item dropdown" style="float: left;
padding-left: 74px;">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">

                    <span class="hidden-md-down">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-xs-center">

                    </div>
                    <a class="dropdown-item" href="{{route('users.profile')}}"><i class="fa fa-user"></i> ??????????????</a>
                    <a class="dropdown-item" href="{{route('users.editPassword')}}"><i class="fa fa-user"></i> ?????????? ???????? ????????????</a>
                    <div class="divider"></div>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="fa fa-lock"></i> ????????</button>
                    </form>
                </div>
            </li>
            <li class="nav-item">
            </li>

        </ul>
    </div>
</header>
<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/dashboard')}}"><i class="icon-speedometer"></i> ???????????????? <span class="tag tag-info">????????</span></a>
            </li>
            <li class="nav-title">
                ???????????? ????????????
            </li>
{{--                    @if(Auth::user()->can('users.index'))--}}
{{--            @if(Auth::user()->isAdmin())--}}
               <li class="nav-item">

            <a class="nav-link" href="{{route('users.index')}}"><i class="icon-user-follow"></i> ????????????  </a>

{{--                <a class="nav-link" href="{{route('user.create')}}"><i class="icon-user-follow"></i> ?????????? ????????  </a>--}}
                <a class="nav-link" href="{{route('roles.index')}}"><i class="icon-people"></i>  ?????????????? - ??????????????????</a>
                <a class="nav-link" href="{{route('customers.index')}}"><i class="icon-user-follow"></i> ?????????????? </a>
               </li>

            {{-- @endcan --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('delegates.index')}}"><i class="icon-docs"></i>   ????????????????</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('laundries.admins')}}"><i class="icon-user-follow"></i>  ???????? ??????????????  </a>
            </li> --}}

            <li class="nav-title">
                ??????????????
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> ??????????????</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('Categories.index')}}"><i class="icon-people"></i>  ??????????????????  </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('laundries.index')}}"><i class="icon-people"></i>  ???? ?????????????? </a>
                    </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('laundries.mainLaundries')}}"><i class="icon-people"></i>  ?????????????? ????????????????</a>
            </li>

                </ul>
            </li>
            <li class="nav-title">
                ??????????????
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> ??????????????</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('Order.index')}}"><i class="icon-people"></i> ?????????????? </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('Order.pendingDeliveryAcceptance')}}"><i class="icon-people"></i> ???????????? ???????? ?????????????? </a>
                    </li>
                    <li class="nav-item">
                <a class="nav-link" href="{{route('Order.DeliveryOnWay')}}"><i class="icon-people"></i> ?????????????? ???? ???????????? ???????????? </a>
                    </li>
                    <li class="nav-item">
                <a class="nav-link" href="{{route('Order.WayToLaundry')}}"><i class="icon-people"></i>   ?????????????? ???? ???????????? ?????????????? </a>
                    </li>
                    <li class="nav-item">

                <a class="nav-link" href="{{route('Order.DeliveredToLaundry')}}"><i class="icon-people"></i> ???? ??????????????  </a>
                    </li>
                    <li class="nav-item">
                <a class="nav-link" href="{{route('Order.readyPickUp')}}"><i class="icon-people"></i>????????????????  ???? ???????????? </a>

                    </li>
                    <li class="nav-item">
                <a class="nav-link" href="{{route('Order.WaitingForDeliveryToReceiveOrder')}}"><i class="icon-people"></i> ???????????? ???????????? ?????????????? </a>

                    </li>
                    <li class="nav-item">
                <a class="nav-link" href="{{route('Order.DeliveryOnTheWayToYou')}}"><i class="icon-people"></i>???? ???????????? ????????????</a>

                    </li>
                    <li class="nav-item">
                <a class="nav-link" href="{{route('Order.completed')}}"><i class="icon-people"></i>?????????????? ???????????????? </a>

                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('coupons.index')}}"><i class="icon-people"></i> ?????????????????? </a>
            </li>
        </ul>
    </nav>
</div>

@yield('content')
<footer class="footer">
        <span class="text-left">
        </span>
    <span class="pull-right">
        </span>
</footer>

<script src="{{asset('assets/admin/js/libs/tether.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/pace.min.js')}}"></script>
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script src="{{asset('assets/admin/js/views/main.js')}}"></script>
<script src="{{asset('assets/customers/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/customers/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/customers/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/customers/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/customers/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
@stack('scripts')

</body>

</html>
