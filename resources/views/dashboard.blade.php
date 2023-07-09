@extends('layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">

        <div class="container-fluid" >
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-4 col-lg-12">
                        <div class="col-sm-6 col-lg-3">
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
                                    <p> عدد المدراء</p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-danger" >
                                <div class="card-block p-b-0">
                                    <h4 class="m-b-0">{{\App\Models\OrderTable::count()}}</h4>
                                    <p> الطلبات</p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-primary" >
                                <div class="card-block p-b-0">
                                    <h4 class="m-b-0">{{\App\Models\Delegate::where('registered',2)->count()}}</h4>
                                    <p> طلبات تسجيل المناديب</p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-primary" >
                                <div class="card-block p-b-0">
                                    <h4 class="m-b-0">{{\App\Models\Subcategory::WhereNull('parent_id')->count()}}</h4>
                                    <p> المغاسل الرئيسيه  </p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-primary" >
                                <div class="card-block p-b-0">
                                    <h4 class="m-b-0">{{\App\Models\Subcategory::WhereNotNull('parent_id')->count()}}</h4>
                                    <p> المغاسل الفرعيه  </p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-inverse card-primary" >
                                <div class="card-block p-b-0">
                                    <h4 class="m-b-0">{{\App\Models\OrderTable::select('*')->whereMonth('created_at', \Carbon\Carbon::now()->month)->count()}}</h4>
                                    <p>اجمالى الطلبات لشهر {{\Carbon\Carbon::now()->monthName}}  </p>
                                </div>
                                <div class="chart-wrapper p-x-1" style="height:70px;">
                                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">


                    <div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                        <canvas id="oilChart" width="600" height="400"></canvas>
                        <script>
                            var oilCanvas = document.getElementById("oilChart");

                            Chart.defaults.global.defaultFontFamily = "Lato";
                            Chart.defaults.global.defaultFontSize = 18;

                            var oilData = {
                                labels: [
                                    "Saudi Arabia",
                                    "Russia",
                                    "Iraq",
                                    "United Arab Emirates",
                                    "Canada"
                                ],
                                datasets: [
                                    {
                                        data: [133.3, 86.2, 52.2, 51.2, 50.2],
                                        backgroundColor: [
                                            "#FF6384",
                                            "#63FF84",
                                            "#84FF63",
                                            "#8463FF",
                                            "#6384FF"
                                        ]
                                    }]
                            };

                            var pieChart = new Chart(oilCanvas, {
                                type: 'pie',
                                data: oilData
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
        </div>

    </main>
@endsection
