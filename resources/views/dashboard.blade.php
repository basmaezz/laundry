@extends('layouts.app')
@section('content')
<main class="main">

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-inverse card-primary">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-settings"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                            <h4 class="m-b-0">{{\App\Models\Delegate::count()}}</h4>
                            <p> المناديب</p>
                        </div>
                        <div class="chart-wrapper p-x-1" style="height:70px;">
                            <canvas id="card-chart1" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-inverse card-warning">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-settings"></i>
                                </button>

                            </div>
                            <h4 class="m-b-0">{{\App\Models\User::count()}}</h4>
                            <p> عدد المدراء  </p>
                        </div>
                        <div class="chart-wrapper" style="height:70px;">
                            <canvas id="card-chart3" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-inverse card-primary">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-settings"></i>
                                </button>

                            </div>
                            <h4 class="m-b-0">{{\App\Models\AppUser::count()}}</h4>
                            <p> العملاء </p>
                        </div>
                        <div class="chart-wrapper" style="height:70px;">
                            <canvas id="card-chart3" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-inverse card-danger">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-settings"></i>
                                </button>

                            </div>
                            <h4 class="m-b-0">{{\App\Models\OrderTable::count()}}</h4>
                            <p> الطلبات</p>
                        </div>
                        <div class="chart-wrapper" style="height:70px;">
                            <canvas id="card-chart3" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card card-inverse card-info">
                        <div class="card-block p-b-0">
                            <button type="button" class="btn btn-transparent active p-a-0 pull-left">
                                <i class="icon-location-pin"></i>
                            </button>
                            <h4 class="m-b-0">{{\App\Models\Subcategory::count()}}</h4>
                            <p> المغاسل</p>
                        </div>
                        <div class="chart-wrapper p-x-1" style="height:70px;">
                            <canvas id="card-chart2" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4"><!--CouponShopCart-->
                    <div class="card card-inverse card-danger">
                        <div class="card-block p-b-0">
                            <div class="btn-group pull-left">
                                <button type="button" class="btn btn-transparent active dropdown-toggle p-a-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-settings"></i>
                                </button>

                            </div>
                            <h4 class="m-b-0">{{\App\Models\OrderTable::count()}}</h4>
                            <p> عدد الطلبات </p>
                        </div>
                        <div class="chart-wrapper" style="height:70px;">
                            <canvas id="card-chart3" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
