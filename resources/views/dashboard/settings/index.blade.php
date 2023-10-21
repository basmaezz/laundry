@extends('../layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a>  </li>
                            <li class="breadcrumb-item active">الاعدادات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main" style="margin-top: 25px">

    <div>
        <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الاعدادات
                                @if(isset($siteSetting) )
                                <a href="{{route('settings.edit')}}" class="btn btn-primary" >تعديل الاعدادات </a>
                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">#</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">نطاق تغطيه المناديب</th>
                                            <td>{{$siteSetting->distance_delegates}}</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">الايميل</th>
                                            <td>{{$siteSetting->email}}</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">رقم الواتساب</th>
                                            <td>{{$siteSetting->whatsapp}}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <a href="{{route('settings.create')}}" class="btn btn-primary" style="float: left">ضبط الاعدادات </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
