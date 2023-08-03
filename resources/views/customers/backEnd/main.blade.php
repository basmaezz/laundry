
{{--    <div class="content-wrapper">--}}
{{--        <!-- Content Header (Page header) -->--}}
{{--        <div class="content-header">--}}
{{--        <div>--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <h1 class="m-0">Dashboard</h1>--}}
{{--                    </div><!-- /.col -->--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active">Dashboard v1</li>--}}
{{--                        </ol>--}}
{{--                    </div><!-- /.col -->--}}
{{--                </div><!-- /.row -->--}}
{{--            </div><!-- /.container-fluid -->--}}
{{--        </div>--}}
{{--        <!-- /.content-header -->--}}

{{--        <!-- Main content -->--}}
{{--        <section class="content">--}}
{{--        <div>--}}
{{--                <!-- Small boxes (Stat box) -->--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-info">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>{{\App\Models\OrderTable::where('laundry_id',Auth::user()->subCategory_id)->count()}}</h3>--}}

{{--                                <p>Total Orders</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-bag"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('Customer.Orders.index',Auth::user()->subCategory_id)}}" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-success">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>{{\App\Models\OrderTable::where('laundry_id',Auth::user()->subCategory_id)->where('status_id',4)->count()}}<sup style="font-size: 20px"></sup></h3>--}}

{{--                                <p>Order in progress</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-stats-bars"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('Customer.Orders.inProgress',Auth::user()->subCategory_id)}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-warning">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>{{\App\Models\OrderTable::where('laundry_id',Auth::user()->subCategory_id)->where('status_id',8)->count()}}</h3>--}}

{{--                                <p>Completed Orders</p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-person-add"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('Customer.Orders.finishedOrder',Auth::user()->subCategory_id)}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                    <div class="col-lg-3 col-6">--}}
{{--                        <!-- small box -->--}}
{{--                        <div class="small-box bg-danger">--}}
{{--                            <div class="inner">--}}
{{--                                <h3>{{\App\Models\OrderTable::where('laundry_id',Auth::user()->subCategory_id)->where('status_id',10)->count()}}</h3>--}}

{{--                                <p>Cancelled Orders </p>--}}
{{--                            </div>--}}
{{--                            <div class="icon">--}}
{{--                                <i class="ion ion-pie-graph"></i>--}}
{{--                            </div>--}}
{{--                            <a href="{{route('Customer.Orders.canceledOrder',Auth::user()->subCategory_id)}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!-- ./col -->--}}
{{--                </div>--}}

{{--            </div><!-- /.container-fluid -->--}}
{{--        </section>--}}
{{--    </div>--}}
{{--@endsection--}}
@extends('customers.layouts.dashboard-app')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row match-height">
                    <!-- Greetings Card starts -->
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card card-congratulations">
                            <div class="card-body text-center">

                                <div class="avatar avatar-xl bg-primary shadow">
                                    <div class="avatar-content">
                                        <i data-feather="award" class="font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-1 text-white">Congratulations John,</h1>
                                    <p class="card-text m-auto w-75">
                                        You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.
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
                                <h2 class="font-weight-bolder mt-1">92.6k</h2>
                                <p class="card-text">Subscribers Gained</p>
                            </div>
                            <div id="gained-chart"></div>
                        </div>
                    </div>
                    <!-- Subscribers Chart Card ends -->

                    <!-- Orders Chart Card starts -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-header flex-column align-items-start pb-0">
                                <div class="avatar bg-light-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i data-feather="package" class="font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder mt-1">38.4K</h2>
                                <p class="card-text">Orders Received</p>
                            </div>
                            <div id="order-chart"></div>
                        </div>
                    </div>
                    <!-- Orders Chart Card ends -->
                </div>

                <div class="row match-height">
                    <!-- Avg Sessions Chart Card starts -->
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pb-50">
                                    <div class="col-sm-6 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                        <div class="mb-1 mb-sm-0">
                                            <h2 class="font-weight-bolder mb-25">2.7K</h2>
                                            <p class="card-text font-weight-bold mb-2">Avg Sessions</p>
                                            <div class="font-medium-2">
                                                <span class="text-success mr-25">+5.2%</span>
                                                <span>vs last 7 days</span>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">View Details</button>
                                    </div>
                                    <div class="col-sm-6 col-12 d-flex justify-content-between flex-column text-right order-sm-2 order-1">
                                        <div class="dropdown chart-dropdown">
                                            <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Last 7 Days
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownItem5">
                                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                            </div>
                                        </div>
                                        <div id="avg-sessions-chart"></div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row avg-sessions pt-50">
                                    <div class="col-6 mb-2">
                                        <p class="mb-50">Goal: $100000</p>
                                        <div class="progress progress-bar-primary" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <p class="mb-50">Users: 100K</p>
                                        <div class="progress progress-bar-warning" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width: 60%"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-50">Retention: 90%</p>
                                        <div class="progress progress-bar-danger" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width: 70%"></div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <p class="mb-50">Duration: 1yr</p>
                                        <div class="progress progress-bar-success" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="90" aria-valuemax="100" style="width: 90%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Avg Sessions Chart Card ends -->

                </div>
            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>
@endsection
