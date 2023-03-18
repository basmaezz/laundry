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
                                    <form action="{{route('delegate.update',$delegate->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الأسم   </label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->appUSer->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                        <div class="col-md-9">
                                            <input type="text"  name="mobile" class="form-control" value="{{$delegate->appUSer->mobile}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">المدينة </label>
                                        <div class="col-md-9">
                                            <input type="text"  name="city" class="form-control" value="{{$delegate->appUSer->cities->name_ar}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الحى </label>
                                        <div class="col-md-9">
                                            <input type="text"  name="address" class="form-control" value="{{$delegate->appUSer->address}}">
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"> نوع التعاقد </label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="request_employment">
                                                    <option value="0"{{$delegate->request_employment==0 ?'selected':''}}>موظف</option>
                                                    <option value="1"{{$delegate->request_employment==1 ?'selected':''}}>عامل حر </option>
                                                </select>
                                                @if ($errors->has('arrears'))
                                                    <span class="text-danger">{{ $errors->first('arrears') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"> الرقم المدنى (الهويه/الاقامه)</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="id_number" class="form-control" value=" {{$delegate->id_number}} "required>

                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ انتهاء الهويه/الاقامه  </label>
                                            <div class="col-md-9">
                                                <input type="date" id="license_start_date" name="license_start_date" class="form-control" value="{{$delegate->license_start_date}}">
                                                @if ($errors->has('license_start_date '))
                                                    <span class="text-danger">{{ $errors->first('license_start_date ') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('images/'.$delegate->appUSer->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="avatar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الهوية الوطنية   </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->id_image)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="id_image" class="form-control">
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
                                            <input type="text" id="text-input" name="bank_name" class="form-control"value="{{$delegate->bank_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> رقم الحساب البنكى</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="iban_number" class="form-control" value="{{$delegate->iban_number}}">
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
                                            <input type="text" id="text-input" name="car_name" class="form-control"value="{{$delegate->car->name_ar??''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> موديل السياره</label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="car_year" class="form-control" value="{{$delegate->year->name}}">
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
                                            <input type="text" id="text-input" name="license_end_date" class="form-control" value="{{$delegate->license_end_date}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"> صوره السياره من الأمام </label>
                                        <div class="col-md-9">
                                            <img src="{{($delegate->car_picture_front)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="car_picture_front" class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"  >صوره السياره من الخلف  </label>
                                        <div class="col-md-9">
                                            <img src="{{$delegate->car_picture_behind}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="car_picture_behind" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره ساريه لرخصه القياده  </label>
                                        <div class="col-md-9">
                                            <img src="{{$delegate->car_registration}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="car_registration" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره استمارة السيارة</label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->glasses_avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="glasses_avatar" class="form-control">
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الفحص الطبى </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('/images/'.$delegate->medic_check)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="medic_check" name="medic_check" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </main>

@endsection
