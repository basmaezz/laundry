@extends('layouts.app')
@section('content')
<main class="main">

    <div class="container-fluid" style="margin-right: 300px; margin-top: 50px">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-6 col-lg-12">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-inverse card-primary"  style="border-radius: 25px">
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\Delegate::count()}}</h4>
                                <p> المناديب</p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-inverse card-warning"  style="border-radius: 25px">
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\User::whereNull('subCategory_id')->count()}}</h4>
                                <p> عدد المدراء  </p>
                                <h4 class="m-b-0">{{\App\Models\User::whereNotNull('subCategory_id')->count()}}</h4>
                                <p> عدد المشرفين  </p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-lg-12">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-inverse card-primary"  style="border-radius: 25px">
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\AppUser::count()}}</h4>
                                <p> العملاء </p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="card card-inverse card-danger"  style="border-radius: 25px">
                            <div class="card-block p-b-0">
                                <h4 class="m-b-0">{{\App\Models\OrderTable::count()}}</h4>
                                <p> الطلبات</p>
                            </div>
                            <div class="chart-wrapper p-x-1" style="height:70px;">
                                <canvas id="card-chart1" class="chart" height="70"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-6 col-lg-12">
                    <div class="col-sm-6 col-lg-6" style="margin-right: 40px !important;">
                        <div class="card card-inverse card-primary"  style="border-radius: 25px">
                            <div class="card-block p-b-0" style="display: inline-block">
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
