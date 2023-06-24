<!DOCTYPE html>
<html lang="IR-fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="">
    <title>Laundry Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('assets/admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/customStyle.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/newLayout/dest/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
</head>
<style>
    .custom{
        width: 90px;
        height: 32px;
    }
    .customOrder{
        width: 35px;
        height: 20px;
    }
    .customRole{
        width: 100px;
    }
    .form-control{
        color: black;
    }
</style>
<body class="navbar-fixed sidebar-nav fixed-nav">
<header class="navbar">
    <div>
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
                    <a class="dropdown-item" href="{{route('users.profile')}}"><i class="fa fa-user"></i> پروفایل</a>
                    <a class="dropdown-item" href="{{route('users.editPassword')}}"><i class="fa fa-user"></i> تغيير كلمه المرور</a>
                    <div class="divider"></div>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fa fa-lock"></i> خروج</button>
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
                <a class="nav-link" href="{{url('/dashboard')}}"><i class="icon-speedometer"></i> الرئيسيه <span class="tag tag-info">جدید</span></a>
            </li>
            <li class="nav-title">
                مقدمين الخدمه
            </li>
            <li class="nav-item">
                @can('admins.index')
                    <a class="nav-link" href="{{route('users.index')}}"><i class="icon-user-follow"></i> الأدمن  </a>
                    <a class="nav-link" href="{{route('users.adminTrashed')}}"><i class="icon-user-follow"></i> الأدمن المحذوفين   </a>
                @endcan
                @can('roles.index')
                    <a class="nav-link" href="{{route('roles.index')}}"><i class="icon-people"></i>  الأدوار - الصلاحيات</a>
                @endcan
                @can('customers.index')
                    <a class="nav-link" href="{{route('customers.index')}}"><i class="icon-user-follow"></i> العملاء </a>
                @endcan
            </li>
            @can('delegates.index')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> المناديب</a>
                    <ul class="nav-dropdown-items">

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('delegates.index')}}"><i class="icon-people"></i>   المناديب  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('delegate.registrationRequests')}}"><i class="icon-people"></i>   طلبات التسجيل  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('delegate.rejectionRequests')}}"><i class="icon-people"></i>  طلبات التسجيل المرفوضه   </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('delegate.trashedDelegates')}}"><i class="icon-people"></i>  المناديب المحذوفه   </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('subCategory.index')
                <li class="nav-title">
                    المغاسل
                </li>

                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> المغاسل</a>
                    <ul class="nav-dropdown-items">
                        @can('categories.index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('Categories.index')}}"><i class="icon-people"></i>  التصنيفات  </a>
                            </li>
                        @endcan

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('laundries.index')}}"><i class="icon-people"></i>  كل المغاسل </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('laundries.mainLaundries')}}"><i class="icon-people"></i>  المغاسل الرئيسيه</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('laundries.viewTrashedLaundries')}}"><i class="icon-people"></i>  المغاسل المحذوفه</a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can('Orders.index')
                <li class="nav-title">
                    الطلبات
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> الطلبات</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.index')}}"><i class="icon-people"></i> الطلبات </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.pendingDeliveryAcceptance')}}"><i class="icon-people"></i> انتظار قبول المندوب </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.DeliveryOnWay')}}"><i class="icon-people"></i> المندوب فى الطريق للعميل </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.WayToLaundry')}}"><i class="icon-people"></i>   المندوب فى الطريق للمغسله </a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link" href="{{route('Order.DeliveredToLaundry')}}"><i class="icon-people"></i> فى المغسله  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.readyPickUp')}}"><i class="icon-people"></i>الأنتهاء  من الغسيل </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.WaitingForDeliveryToReceiveOrder')}}"><i class="icon-people"></i> انتظار موافقه المندوب </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.DeliveryOnTheWayToYou')}}"><i class="icon-people"></i>فى الطريق للعميل</a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('Order.completed')}}"><i class="icon-people"></i>الطلبات المنتهيه </a>

                        </li>
                    </ul>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="{{route('notification.create')}}"><i class="icon-people"></i> الاشعارات </a>
            </li>
            @can('Coupons.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('coupons.index')}}"><i class="icon-people"></i> الكوبونات </a>
                </li>
            @endcan
            @can('settings.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('settings.index')}}"><i class="icon-people"></i> الاعدادات </a>
                </li>
            @endcan
            @can('banks.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('banks.index')}}"><i class="icon-people"></i> البنوك </a>
                </li>
            @endcan

        </ul>
    </nav>
</div>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/newLayout/js/libs/jquery.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/libs/tether.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/libs/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/libs/pace.min.js') }}"></script>
{{--<script src="{{ asset('assets/newLayout/js/libs/Chart.min.js') }}"></script>--}}
<script src="{{ asset('assets/newLayout/js/app.js') }}"></script>
<script src="{{ asset('assets/newLayout/js/views/main.js') }}"></script>
<script src="{{asset('assets/admin/js/libs/jquery.timeago.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/jquery.timeago.ar.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{--<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

<script src="{{asset('assets/admin/js/mdb.min.js')}}" ></script>

<script>
    jQuery(document).ready(function() {
        jQuery("time.timeago").timeago();
    });
</script>
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
</html>
