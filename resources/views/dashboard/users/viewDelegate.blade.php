@extends('../layouts.app')
@section('content')
    <main class="main">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('delegates.index')}}">المناديب</a></li>
                <li class="breadcrumb-item active" aria-current="page">بيانات المندوب  </li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong> بيانات المندوب  </strong>
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الأسم   </label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->appUSer->name}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="email" class="form-control" value="{{$delegate->appUSer->mobile}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">المدينة </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="email" class="form-control" value="{{$delegate->appUSer->cities->name_ar}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الحى </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="email" class="form-control" value="{{$delegate->region_name}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">نوع التعاقد </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="request_employment" class="form-control" value="{{$delegate->request_employment == 0 ? 'موظف' : 'عامل حر'}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> الرقم المدنى </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="id_number" class="form-control" value="{{$delegate->id_number}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">تاريخ انتهاء الهويه / الاقامه  </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="identity_expiration_date" class="form-control" value="{{$delegate->identity_expiration_date}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>
                                        <div class="col-md-9">
                                            <a href="{{asset('images/'.$delegate->appUser->avatar)}}" download>
                                            <img src="{{asset('images/'.$delegate->appUser->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الهوية الوطنية   </label>
                                        <div class="col-md-9">
                                            @if(pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='pdf')
                                                <a href="{{$delegate->id_image}}" download>
                                                    Download
                                                </a>
                                            @else

                                            <a href="{{$delegate->id_image}}" download>
                                            <img src="{{$delegate->id_image}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong> بيانات البنك  </strong>
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> اسم البنك</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->bank_name}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> رقم الحساب البنكى</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="last_name" class="form-control" value="{{$delegate->iban_number}}"disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong> بيانات السياره  </strong>
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> نوع السياره </label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->car_type}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> موديل السياره</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="last_name" class="form-control" value="{{$delegate->year->name}}"disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"class="form-control"> معلومات لوحه السياره  </label>
                                        <div class="col-md-2">
                                            <input type="text" id="car_plate_letter" name="car_plate_letter" class="form-control"value="{{$delegate->car_plate_letter}}">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" id="car_plate_number" name="car_plate_number"class="form-control" value="{{$delegate->car_plate_number}}">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> تاريخ انتهاء الرخصه</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="last_name" class="form-control" value="{{$delegate->license_end_date}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> صوره السياره من الأمام </label>
                                        <div class="col-md-9">
                                            @if(pathinfo($delegate['car_picture_front'], PATHINFO_EXTENSION)=='pdf')
                                                <a href="{{asset('/images/'.$delegate->car_picture_front)}}" download>
                                                 Download
                                                </a>
                                            @else
                                            <a href="{{($delegate->car_picture_front)}}" download>
                                            <img src="{{($delegate->car_picture_front)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </a>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"  >صوره السياره من الخلف  </label>
                                        <div class="col-md-9">
                                            @if(pathinfo($delegate['car_picture_behind'], PATHINFO_EXTENSION)=='pdf')
                                                <a href="{{asset('/images/'.$delegate->car_picture_behind)}}" download>
                                                    Download
                                                </a>
                                            @else
                                            <a href="{{$delegate->car_picture_behind}}" download>
                                                <img src="{{$delegate->car_picture_behind}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره ساريه لرخصه القياده  </label>
                                        <div class="col-md-9">
                                            @if(pathinfo($delegate['car_registration'], PATHINFO_EXTENSION)=='pdf')
                                                <a href="{{asset('/images/'.$delegate->car_registration)}}" download>
                                                    Download
                                                </a>
                                            @else
                                            <a href="{{$delegate->car_registration}}" download>
                                            <img src="{{$delegate->car_registration}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره استمارة السيارة</label>
                                        <div class="col-md-9">
                                            @if(pathinfo($delegate['glasses_avatar'], PATHINFO_EXTENSION)=='pdf')
                                                <a href="{{asset('/images/'.$delegate->glasses_avatar)}}" download>
                                                    Download
{{--                                                  {{$delegate->glasses_avatar}}--}}
                                                </a>
                                            @else
                                                <a href="{{asset('/images/'.$delegate->glasses_avatar)}}" download>
                                                    <img src="{{asset('/images/'.$delegate->glasses_avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;" >
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره الفحص الطبى</label>
                                        <div class="col-md-9">
                                            @if(pathinfo($delegate['medic_check'], PATHINFO_EXTENSION)=='pdf')
                                                <a href="{{$delegate->medic_check}}" download>
                                                    Download
{{--                                                  {{$delegate->glasses_avatar}}--}}
                                                </a>
                                            @else
                                                <a href="{{$delegate->medic_check}}" download>
                                                    <img src="{{$delegate->medic_check}}" style="width:200px;height:200px;padding:15px;border-radius:20px;" >
                                                </a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        </div>
    </main>

@endsection
