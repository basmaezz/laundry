@extends('layouts.app')
@section('content')
<main class="main">

    <div class="container-fluid" >
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-4 col-lg-12">
                    <div class="col-sm-4 col-lg-3">
                        <div class="card card-inverse card-primary" >
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\Delegate::count()}}</h4>
                                <p> المناديب</p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-warning" >
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\User::count()}}</h4>
                                <p> عدد المدراء  </p>
                             </div>
                            <div class="card-block p-b-0">

                             </div>        <div class="card-block p-b-0">

                             </div>        <div class="card-block p-b-0">

                             </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-lg-8">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card card-inverse card-primary"  >
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\AppUser::count()}}</h4>
                                <p> العملاء </p>
                            </div>
                            <div class="chart-wrapper p-x-1" >
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-inverse card-danger" >
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\Delegate::where('registered',2)->count()}}</h4>
                                <p> طلبات التسجيل</p>
                            </div>
                            <div class="chart-wrapper p-x-1" >
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-inverse card-danger" >
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\OrderTable::count()}}</h4>
                                <p> الطلبات</p>
                            </div>
                            <div class="chart-wrapper p-x-1" >
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-lg-12">
                    <div class="col-sm-6 col-lg-6" >
                        <div class="card card-inverse card-primary"  >
                            <div class="card-block p-b-0" >
                                <h4 class="m-b-0">{{\App\Models\Subcategory::count()}}</h4>
                                <p> المغاسل</p>
                                <h4 class="m-b-0">{{\App\Models\Subcategory::WhereNull('parent_id')->count()}}</h4>
                                <p> المغاسل الرئيسيه</p>
                                <h4 class="m-b-0">{{\App\Models\Subcategory::WhereNotNull('parent_id')->count()}}</h4>
                                <p> المغاسل الفرعيه</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
