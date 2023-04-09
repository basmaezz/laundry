@extends('../layouts.app')
@section('content')
    <main class="main">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('delegates.index')}}">المناديب</a></li>
                <li class="breadcrumb-item active" aria-current="page">تعديل بيانات المندوب  </li>
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
                                    <form action="{{route('delegate.update',$delegate->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الأسم   </label>
                                        <div class="col-md-9">
                                            <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->appUser->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                        <div class="col-md-9">
{{--                                            <input type="text"  name="mobile" class="form-control" value="{{$delegate->appUSer->mobile}}">--}}
                                            <div class="input-group">
                                                <input type="text"name="mobile" class="form-control" value="{{mb_substr($delegate->appUser->mobile, 3, 9)}}" style="direction: ltr"maxlength="9">
                                                <span class="input-group-addon">00966</i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">المدينة </label>
                                        <div class="col-md-9">
                                            <input type="text"  name="city" class="form-control" value="{{$delegate->appUser->cities->name_ar}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">الحى </label>
                                        <div class="col-md-9">
                                            <input type="text"  name="region_name" class="form-control" value="{{$delegate->appUser->region_name}}">
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الجنسيه</label>
                                            <div class="col-md-9">
                                                <select  name="nationality_id" class="form-control">
                                                    @foreach($nationalities as $nationality)
                                                        <option onclick="hideInput()"value="{{$nationality->id}}"{{$delegate->nationality_id==$nationality->id ?'selected':''}}>{{$nationality->name_ar}}</option>
                                                    @endforeach
                                                    <option onclick="displayInput()" value="0">أخرى</option>
                                                </select>
                                                @if ($errors->has('nationality_id'))
                                                    <span class="text-danger">{{ $errors->first('nationality_id') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row " id="nationality" style="display: none">
                                            <label class="col-md-3 form-control-label" for="text-input"> </label>
                                            <div class="col-md-9">
                                                <input type="text" id="nationality" name="nationality_name" class="form-control"placeholder="الجنسيه" value="{{Request::old('nationality_name')}}">
                                                @if ($errors->has('nationality_id'))
                                                    <span class="text-danger">{{ $errors->first('nationality_id') }}</span>
                                                @endif
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
                                                <input type="date" id="license_start_date" name="identity_expiration_date" class="form-control" value="{{$delegate->identity_expiration_date}}">
                                                @if ($errors->has('identity_expiration_date '))
                                                    <span class="text-danger">{{ $errors->first('identity_expiration_date ') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>
                                        <div class="col-md-9">
                                            <img src="{{asset('assets/uploads/users_avatar/'.$delegate->appUser->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="avatar" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input">صوره الهوية الوطنية   </label>
                                        <div class="col-md-9">
                                            <img src="{{$delegate->id_image}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="idImage" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong> بيانات البنك  </strong>
                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">اسم البنك </label>
                                        <div class="col-md-9">
                                            <select  name="bank_id" class="form-control">
                                                @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}"{{$delegate->bank_id==$bank->id ?'selected' :''}}>{{$bank->name_ar}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('bank_id'))
                                                <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                                            @endif
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
                                        <label class="col-md-3 form-control-label" for="text-input">نوع السياره  </label>
                                        <div class="col-md-9">
                                            <select  name="car_type" class="form-control">
                                                @foreach($carTypes as $carType)
                                                    <option value="{{$carType->id}}"{{$delegate->car_type==$carType->id?'selected':''}}>{{$carType->name_ar}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('car_type'))
                                                <span class="text-danger">{{ $errors->first('car_type') }}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">  موديل السياره</label>
                                        <div class="col-md-9">
                                            <select name="car_manufacture_year_id" class="form-control">
                                                @foreach($years as $year)
                                                    <option value="{{$year->id}}" {{$delegate->car_manufacture_year_id==$year->id ?'selected':''}}>{{$year->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('car_manufacture_year_id'))
                                                <span class="text-danger">{{ $errors->first('car_manufacture_year_id') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input"class="form-control"> معلومات لوحه السياره  </label>
                                        <div class="col-md-2">
                                            <input type="text"  name="car_plate_letter1" class="form-control"value="{{mb_substr($delegate->car_plate_letter, 0, 1)}}">                                            @if ($errors->has('car_plate_letter1'))
                                                -<span class="text-danger">{{ $errors->first('car_plate_letter1') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"  name="car_plate_letter2" class="form-control"value="{{mb_substr($delegate->car_plate_letter, 1, 1)}}">                                            @if ($errors->has('car_plate_letter2'))
                                                -<span class="text-danger">{{ $errors->first('car_plate_letter2') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"  name="car_plate_letter3" class="form-control"value="{{mb_substr($delegate->car_plate_letter, 2, 1)}}">                                            @if ($errors->has('car_plate_letter3'))
                                                -<span class="text-danger">{{ $errors->first('car_plate_letter3') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"  name="car_plate_number"class="form-control" value="{{$delegate->car_plate_number}}">
                                            @if ($errors->has('car_plate_number'))
                                                -<span class="text-danger">{{ $errors->first('car_plate_number') }}</span>
                                            @endif
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
                                            <input type="file" id="file-input" name="carPictureFront" class="form-control">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"  >صوره السياره من الخلف  </label>
                                        <div class="col-md-9">
                                            <img src="{{$delegate->car_picture_behind}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="carPictureBehind" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره ساريه لرخصه القياده  </label>
                                        <div class="col-md-9">
                                            <img src="{{$delegate->driving_license}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="carRegistration" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره استمارة السيارة</label>
                                        <div class="col-md-9">
                                            <img src="{{$delegate->car_registration}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="file-input" name="glasses_avatar" class="form-control">
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الفحص الطبى </label>
                                        <div class="col-md-9">
                                            <img src="{{$delegate->medic_check}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            <input type="file" id="medic_check" name="medicCheck" class="form-control">
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
<script>
    function displayInput(){
        console.log('test');
        let nationality= document.getElementById('nationality');
        (nationality.style.display ==="none") ?nationality.style.display ="block" :'';
    }
    function hideInput(){
        let nationality= document.getElementById('nationality');
        (nationality.style.display ==="block") ?nationality.style.display ="none" :'';
    }
</script>
