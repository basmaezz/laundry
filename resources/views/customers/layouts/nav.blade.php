<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>

                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="flag-icon flag-icon-us"></i><span class="selected-language">{{__('lang.Language')}}</span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{url('Lang/'.'en')}}" ><i class="flag-icon flag-icon-us"></i> {{__('lang.English')}}</a>
                    <a class="dropdown-item" href="{{url('Lang/'.'ar')}}" ><i class="flag-icon flag-icon-ar"></i> {{__('lang.Arabic')}}</a>
                </div>
            </li>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name}}</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="{{$laundry->image}}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="{{route('profile')}}">
                        <i class="mr-50" data-feather="user"></i> Profile</a>

                    <div class="dropdown-divider"></div>
                    <form method="post" action="{{ route('logoutLaundryAdmin') }}">
                        @csrf
                        <button type="submit" class="dropdown-item" style="text-align: center; width: 168px"><i class="mr-50" data-feather="power"></i>{{__('lang.logout')}}</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template/index.html"><span class="brand-logo">
                           </span>

                    <h2 class="brand-text">{{$laundry['name_'.app()->getLocale()]}}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" ><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">{{ __('lang.dashboard') }}</span></a>
                <ul class="menu-content">
                    <li class="{{ (request()->is('customer.index')) ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('customer.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" >{{__('lang.main')}}</span></a>

                    </li>

                </ul>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" >
                    <i data-feather="grid"></i><span class="menu-title text-truncate" >{{ __('lang.products and services') }}</span>
                    </a>
                <ul class="menu-content">
                    <li class="{{ (request()->is('Customer.Items.index',Auth::user()->subCategory_id)) ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{route('Customer.Items.index',Auth::user()->subCategory_id)}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">{{__('lang.products')}}</span></a>
                    </li>

                </ul>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" >{{ __('lang.orders') }}</span></a>
                <ul class="menu-content">

                    <li class="" >
                        <a class="d-flex align-items-center" href="{{route('Customer.Orders.incomingOrder',Auth::user()->subCategory_id)}}"><i data-feather="circle"></i>{{__('lang.incomingOrders')}}
                            <span class="badge badge-light-warning badge-pill ml-auto mr-1">
                                {{ App\Models\OrderTable::orders(Auth::user()->subCategory_id)->where('status_id', '3')->count()}}</span>
                        </a></li>     <li class="" >
                        <a class="d-flex align-items-center" href="{{route('Customer.Orders.inProgress',Auth::user()->subCategory_id)}}"><i data-feather="circle"></i>{{__('lang.ordersInProgress')}}
                            <span class="badge badge-light-warning badge-pill ml-auto mr-1">
                                {{ App\Models\OrderTable::orders(Auth::user()->subCategory_id)->where('status_id', '4')->count()}}</span>
                        </a></li>
                    <li class=""><a class="d-flex align-items-center" href="{{route('Customer.Orders.index',Auth::user()->subCategory_id)}}"><i data-feather="circle"></i>{{__('lang.allOrders')}}
                            <span class="badge badge-light-warning badge-pill ml-auto mr-1">{{ App\Models\OrderTable::orders(Auth::user()->subCategory_id)->count()}}</span>
                        </a></li>
                    <li class=""><a class="d-flex align-items-center" href="{{route('Customer.Orders.finishedOrder',Auth::user()->subCategory_id)}}"><i data-feather="circle"></i>{{__('lang.OrdersFinished')}}
                        <span class="badge badge-light-warning badge-pill ml-auto mr-1">{{ App\Models\OrderTable::orders(Auth::user()->subCategory_id)->where('status_id', '8')->count()}}</span>
                        </a></li>
                    <li class="" ><a class="d-flex align-items-center" href="{{route('Customer.Orders.canceledOrder',Auth::user()->subCategory_id)}}"><i data-feather="circle"></i>{{__('lang.CanceledOrders')}}
                        <span class="badge badge-light-warning badge-pill ml-auto mr-1">{{ App\Models\OrderTable::orders(Auth::user()->subCategory_id)->where('status_id', '10')->count()}}</span>
                        </a></li>

                </ul>
            </li>
{{--            <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="calendar"></i><span class="menu-title text-truncate" >{{ __('lang.calender') }}</span></a>--}}


        </ul>
    </div>
</div>
