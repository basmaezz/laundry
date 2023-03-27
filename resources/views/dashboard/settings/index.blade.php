@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الاعدادات
                                <a href="{{route('settings.create')}}" class="btn btn-primary" style="float: left">ضبط الاعدادات </a>
                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">#</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">نطاق تغطيه المناديب</th>
                                            <td>{{$siteSetting->distance_delegates}}</td>
                                            <td>
                                                <a href="" class="btn btn-info">تعديل</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">الايميل</th>
                                            <td>{{$siteSetting->email}}</td>
                                           <td><a href="" class="btn btn-info">تعديل</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">رقم الواتساب</th>
                                            <td>{{$siteSetting->whatsapp}}</td>
                                            <td><a href="" class="btn btn-info">تعديل</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
