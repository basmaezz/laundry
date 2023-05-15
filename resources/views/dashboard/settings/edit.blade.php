@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('settings.index')}}">الاعدادات</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه/ تعديل  </li>
            </ol>
        </nav>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>الاعددات </strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('settings.update')}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">نطاق المناديب </label>
                            <div class="col-md-9">
                                <input type="hidden"  name="id" class="form-control" value="{{$siteSetting->id}}" >
                                <input type="number"  name="distance_delegates" class="form-control" value="{{$siteSetting->distance_delegates}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">الايميل </label>
                            <div class="col-md-9">
                                <input type="email"  name="email" class="form-control" value="{{$siteSetting->email}}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">رقم الواتساب </label>
                            <div class="col-md-9">
                                <input type="text"  name="whatsapp" class="form-control" value="{{$siteSetting->whatsapp}}">
                            </div>
                        </div>


                        <div class="card-footer">
                           <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger custom ">الغاء</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

