@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">الاعدادات  </li>
            </ol>
        </nav>
    <div>
            <div class="animated fadeIn">
                <div class="row">
                    <div class="validationMsg" style="width: 600px">
                        @if($errors->any())
                            <div class="alert alert-danger" >
                                <h6>{{$errors->first()}}</h6>
                            </div>
                        @elseif(session()->has('message'))
                            <div class="alert alert-success"  >
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الاعدادات
                                @if(isset($siteSetting) )
                                <a href="{{route('settings.edit')}}" class="btn btn-primary" style="float: left">تعديل الاعدادات </a>
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
