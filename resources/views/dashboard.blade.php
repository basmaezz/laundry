@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row match-height">
                    <!-- Greetings Card starts -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card card-congratulations">
                            <div class="card-body text-center">
                                <img src="{{asset('assets/customers/app-assets/images/elements/decore-left.png')}}" class="congratulations-img-left" alt="card-img-left" />
                                <img src="{{asset('assets/customers/app-assets/images/elements/decore-right.png')}}" class="congratulations-img-right" alt="card-img-right" />
                                <div class="avatar avatar-xl bg-primary shadow">
                                    <div class="avatar-content">
                                        <i data-feather="award" class="font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-1 text-white">Laundry App</h1>
                                    <p class="card-text m-auto w-75">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Greetings Card ends -->

                    <!-- Subscribers Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\Delegate::count()}}</h2>
                                <p class="card-text">المناديب</p>
                            </div>
                            <div id="gained-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\Delegate::where('registered',2)->count()}}</h2>
                                <p class="card-text"> طلبات تسجيل المناديب</p>
                            </div>
                            <div id="gained-chart"></div>
                        </div>
                    </div>
                    <!-- Subscribers Chart Card ends -->


                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\User::count()}}</h2>
                                <p class="card-text">عدد المدراء</p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::count()}}</h2>
                                <p class="card-text">الطلبات </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::where('status_id',3)->count()}}</h2>
                                <p class="card-text">{{__('lang.incomingOrders')}} </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::where('status_id',4)->count()}}</h2>
                                <p class="card-text">{{__('lang.OrderInProgress')}} </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::where('status_id',8)->count()}}</h2>
                                <p class="card-text">{{__('lang.CompletedOrders')}} </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::where('status_id',10)->count()}}</h2>
                                <p class="card-text">{{__('lang.CancelledOrders')}} </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\Subcategory::WhereNull('parent_id')->count()}}</h2>
                                <p class="card-text">المغاسل </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::select('*')->Where('status_id','!=',10)->whereMonth('created_at', \Carbon\Carbon::now()->month)->count()}}</h2>
                                <p class="card-text">اجمالى الطلبات الشهريه </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::select('*')->Where('status_id','!=',10)->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('laundry_profit')}}</h2>
                                <p class="card-text">اجمالى ربح المغاسل لشهر {{\Carbon\Carbon::now()->monthName}} </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">{{\App\Models\OrderTable::select('*')->Where('status_id','!=',10)->whereMonth('created_at', \Carbon\Carbon::now()->month)->sum('app_profit')}}</h2>
                                <p class="card-text">اجمالى ربح التطبيق لشهر {{\Carbon\Carbon::now()->monthName}} </p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
