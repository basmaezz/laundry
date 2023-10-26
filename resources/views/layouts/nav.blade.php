<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <img src="{{asset('assets/landingPage/images/logo-home.png')}}" alt="" class="logoImage" />
            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name}}</span><span class="user-status">Admin</span></div><span class="avatar">
                        <img class="round" src="{{asset('assets/uploads/images/'.Auth::user()->avatar)}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item"  href="{{route('users.profile')}}"><i class="mr-50" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('users.editPassword')}}"><i class="mr-50" data-feather="user"></i> تغيير كلمه المرور</a>

                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="mr-50" data-feather="power"></i> خروج</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/rtl/horizontal-menu-template/index.html"><span class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                                <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span>
                        <h2 class="brand-text mb-0">Vuexy</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
    <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="index.html" data-toggle="dropdown"><i data-feather="home"></i><span data-i18n="Dashboard">لوحه التحكم</span></a>
            <ul class="dropdown-menu">
{{--                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="dashboard-analytics.html" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">احصائيات</span></a> </li>--}}
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{url('/dashboard')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">الرئيسيه</span></a> </li>
            </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="package"></i><span data-i18n="Apps"> المدراء</span></a>
            <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('users.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">مدراء التطبيق </span></a> </li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('users.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">مدراء المغاسل </span></a> </li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('users.adminTrashed')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">المدراء المحذوفين</span></a>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('roles.index')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">الأدوار - الصلاحيات</span></a>
                </li>
            </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="layers"></i><span data-i18n="User Interface">العملاء</span></a>
            <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('customers.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">عرض الكل</span></a>
                </li>
            </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="edit"></i><span data-i18n="Forms &amp; Tables">المناديب</span></a>
            <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('delegates.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">المناديب</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('delegate.registrationRequests')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">طلبات التسجيل</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('delegate.rejectionRequests')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">طلبات التسجيل المرفوضه </span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('delegate.trashedDelegates')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">المناديب المحذوفه</span></a></li>
            </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="edit"></i><span data-i18n="Forms &amp; Tables">المغاسل</span></a>
            <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Categories.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="home"></i><span data-i18n="Analytics">التصنيفات</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('laundries.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="home"></i><span data-i18n="Analytics">المغاسل </span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('laundries.viewTrashedLaundries')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">المغاسل المحذوفه</span></a></li>
            </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="shopping-cart"></i><span data-i18n="Pages">الطلبات</span></a>
            <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.index')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">الطلبات</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.pendingDeliveryAcceptance')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">انتظار قبول المندوب </span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.DeliveryOnWay')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">المندوب فى الطريق للعميل</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.WayToLaundry')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">المندوب فى الطريق للمغسله</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.DeliveredToLaundry')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">فى المغسله</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.readyPickUp')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">الأنتهاء  من الغسيل</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.WaitingForDeliveryToReceiveOrder')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">انتظار موافقه المندوب</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.DeliveryOnTheWayToYou')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">فى الطريق للعميل</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('Order.completed')}}" data-toggle="dropdown" data-i18n="eCommerce"><i data-feather="shopping-cart"></i><span data-i18n="eCommerce">الطلبات المنتهيه</span></a></li>

            </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="file-text"></i><span data-i18n="Pages">الاعدادات العامه</span></a>
            <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('settings.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">الاعدادات </span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('coupons.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">الكوبونات</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('banks.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">البنوك</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('cars.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">السيارات</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('cities.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">المدن</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('faqs.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">الاسئله الشائعه</span></a></li>
            </ul>
        </li>
        <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link d-flex align-items-center" href="#" data-toggle="dropdown"><i data-feather="file-text"></i><span data-i18n="Pages"> الاشعارات</span></a>
            <ul class="dropdown-menu">
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('notification.index')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">الاشعارات </span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('notification.create')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">اشعارات للمناديب</span></a></li>
                <li data-menu=""><a class="dropdown-item d-flex align-items-center" href="{{route('notification.customerNotification')}}" data-toggle="dropdown" data-i18n="Analytics"><i data-feather="activity"></i><span data-i18n="Analytics">اشعارات للعملاء</span></a></li>
            </ul>
        </li>

    </ul>