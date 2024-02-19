<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static   menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
            </ul>
            <ul class="nav navbar-nav">
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">

            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name}}</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="{{asset('assets/uploads/images/'.Auth::user()->avatar)}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('users.profile')}}">
                        <i class="mr-50" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('users.editPassword')}}">
                        <i class="mr-50" data-feather="mail"></i> Inbox</a><a class="dropdown-item"  href="">

                        <div class="dropdown-divider"></div>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="mr-50" data-feather="power"></i> خروج</button>
                        </form>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">

</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span></div>
        </a>
    </li>
</ul>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/rtl/vertical-collapsed-menu-template/index.html"><span class="brand-logo">
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
                    <h2 class="brand-text">Vuexy</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="dashboard-ecommerce.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="eCommerce">eCommerce</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">لوحه التحكم</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{url('/dashboard')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">الرئيسيه</span></a>
                    </li>

                </ul>
            </li>


            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">المدراء</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center"  href="{{route('users.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">مدراء التطبيق</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('users.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">مدراء المغاسل</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('users.adminTrashed')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">المدراء المحذوفين </span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('roles.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">الادوار والصلاحيات </span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">المناديب</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('delegates.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">عرض الكل </span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('delegate.registrationRequests')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">طلبات التسجيل </span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('delegate.rejectionRequests')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview"> طلبات التسجيل المرفوضه </span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('delegate.trashedDelegates')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">المناديب المحذوفه  </span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('customers.index')}}"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">العملاء</span></a>
            <li><a class="d-flex align-items-center" href="{{route('Categories.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">التصنيفات </span></a></li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('laundries.index')}}"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">مغاسل الملابس</span></a>
                <ul class="menu-content">

                    <li><a class="d-flex align-items-center" href="{{route('laundries.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">مغاسل الملابس </span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('laundries.viewTrashedLaundries')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Preview">المغاسل المحذوفه  </span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">طلبات الملابس</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('Order.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">الطلبات</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.pendingDeliveryAcceptance')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">انتظار قبول لمندوب</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.DeliveryOnWay')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">المندوب فى الطريق للعميل</span></a></li>
                    <li><a class="d-flex align-items-center"  href="{{route('Order.WayToLaundry')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">المندوب فى الطريق للمغسله</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.DeliveredToLaundry')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">فى المغسله</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.readyPickUp')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">الانتهاء من الغسيل</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.WaitingForDeliveryToReceiveOrder')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">انتظار موافقه المندوب</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.DeliveryOnTheWayToYou')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">فى الطريق للعميل </span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.completed')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">الطلبات المنتهيه</span></a></li>

                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('carpetLaundries.index')}}"><i data-feather="save"></i><span class="menu-title text-truncate" data-i18n="File Manager">مغاسل السجاد  </span></a>  </li>

            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="eCommerce">طلبات السجاد</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('Order.carpetOrders')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">الطلبات</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.pendingCarpetDeliveryAcceptance')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">انتظار قبول لمندوب</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.carpetDeliveryOnWay')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">المندوب فى الطريق للعميل</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.carpetDeliveryWayToLaundry')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">المندوب فى الطريق للمغسله</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.carpetsDeliveredToLaundry')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">فى المغسله</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.WaitingForCarpetDeliveryToReceiveOrder')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">انتظار موافقه المندوب</span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.carpetDeliveryOnTheWayToYou')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">فى الطريق للعميل </span></a></li>
                    <li><a class="d-flex align-items-center" href="{{route('Order.carpetOrdersCompleted')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">الطلبات المنتهيه</span></a></li>

                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{route('carLaundries.index')}}"><i data-feather="save"></i><span class="menu-title text-truncate" data-i18n="File Manager">مغاسل السيارات  </span></a>  </li>


            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Pages">الاعدادات العامه</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('settings.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">الاعدادات</span></a> </li>
                    <li><a class="d-flex align-items-center" href="{{route('coupons.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">الكوبونات</span></a> </li>
                    <li><a class="d-flex align-items-center" href="{{route('banks.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">البنوك</span></a> </li>
                    <li><a class="d-flex align-items-center" href="{{route('cars.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">السيارات</span></a> </li>
                    <li><a class="d-flex align-items-center" href="{{route('cities.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">المدن</span></a> </li>
                    <li><a class="d-flex align-items-center" href="{{route('faqs.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">الاسئله الشائعه</span></a> </li>

                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Pages">الاشعارات </span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('notification.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">الاشعارات</span></a> </li>
                    <li><a class="d-flex align-items-center" href="{{route('notification.create')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">اشعارات المناديب</span></a> </li>
                    <li><a class="d-flex align-items-center" href="{{route('notification.customerNotification')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Authentication">اشعارات العملاء</span></a> </li>


                </ul>
            </li>

        </ul>
    </div>
</div>
