@extends('../layouts.app')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                <li class="breadcrumb-item active" aria-current="page">بيانات المغسله  </li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{url('laundryStore')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong> عرض تفاصيل المغسله </strong>
                                </div>
                                <div class="card-block">
                                    @if(isset($subCategory->parent->name_ar))
                                        <div class="form-group">
                                            <label for="company" n>الفرع الرئيسى </label>
                                            <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->parent->name_ar}}" disabled>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="company" n>اسم المغسله</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->name_ar}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم المغسله بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$subCategory->name_en}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">العنوان</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->address}}"disabled>
                                    </div>
                                        <div class="form-group">
                                        <label for="company">الموقع الجعرافى</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->location}}"disabled>
                                    </div>
                                        <div class="form-group">
                                        <label for="company">latitude</label>
                                        <input type="text" name="lat"class="form-control" id="name_ar" value="{{$subCategory->lat}}"disabled>
                                    </div>
                                        <div class="form-group">
                                        <label for="company">longitude</label>
                                        <input type="text" name="lng"class="form-control" id="name_ar" value="{{$subCategory->lng}}"disabled>
                                    </div>
                                        <div class="form-group">
                                        <label for="company">نطاق التشغيل</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->range}}KM"disabled>
                                    </div>
                                        <div class="form-group">
                                        <label for="company">تاريخ اضافته</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->created_at->format('y-m-d')}}"disabled>
                                    </div>
                                        <div class="form-group">
                                        <label for="company">مواعيد الدوام</label>
                                            @if(isset($subCategory->around_clock))
                                        <input type="text" name="address"class="form-control" id="name_ar" value="'طوال اليوم"disabled>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach($subCategory->user as $admin )
                        <div class="col-md-6">
                            <div class="card">

                                <div class="card-header">
                                    <strong> عرض تفاصيل الأدمن </strong>
                                </div>
                                <div class="card-block">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="disabled-input">الصلاحيه </label>
                                            <div class="col-md-9">
                                                <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="مدير المغسله" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="name" class="form-control" value="{{$admin->name}}"disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="last_name" class="form-control" value="{{$admin->last_name}}"disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                            <div class="col-md-9">
                                                <input type="email" id="email-input" name="email" class="form-control" value="{{$admin->email}}"disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                            <div class="col-md-9">
                                                <input type="text" id="phone" name="phone" class="form-control"value="{{$admin->phone}}"disabled>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

