@extends('../layouts.app')
@section('content')
    <main class="main">
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
                                        <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->user->name}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="last_name" class="form-control" value="{{$delegate->user->last_name}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="email" class="form-control" value="{{$delegate->user->phone}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">نوع التعاقد </label>
                                        <div class="col-md-9">
                                            <input type="email" id="email-input" name="request_employment" class="form-control" value="{{$delegate->request_employment == 0 ? 'موظف' : 'عامل حر'}}"disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->user->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->id_image)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
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
                                            <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->car->name_ar}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> موديل السياره</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="last_name" class="form-control" value="{{$delegate->manufacture_year}}"disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> تاريخ اصدار الرخصه </label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="last_name" class="form-control" value="{{$delegate->license_start_date}}"disabled>
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
                                            <img src="{{('/images/'.$delegate->car_picture_front)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                        </div>
{{--                                        <div class="col-md-9">--}}
{{--                                            <img src="{{asset('/images/'.$delegate->car_picture_front)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"  >صوره السياره من الخلف  </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->car_picture_behind)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره ساريه لرخصه القياده  </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->car_registration)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره استمارة السيارة</label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->glasses_avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
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
