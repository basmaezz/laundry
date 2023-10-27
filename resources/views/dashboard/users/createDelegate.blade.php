@extends('layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('delegates.index')}}">المناديب</a>
                            </li>
                            <li class="breadcrumb-item active">اضافه مندوب
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">

            </div>
        </div>
    </div>
    <div class="content-body">
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه مندوب جديد</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('delegate.store')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">الأسم الثلاثى </label>
                                    <div class="col-md-3">
                                        <input type="text" id="text-input" name="first_name" class="form-control" placeholder="الاسم الاول "value="{{Request::old('first_name')}}">

                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="text-input" name="second_name" class="form-control" placeholder="الاسم الثانى "value="{{Request::old('second_name')}}">

                                        @if ($errors->has('second_name'))
                                            <span class="text-danger">{{ $errors->first('second_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" id="text-input" name="third_name" class="form-control" placeholder="الاسم الاخير "value="{{Request::old('third_name')}}">

                                        @if ($errors->has('third_name'))
                                            <span class="text-danger">{{ $errors->first('third_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-group ">
                                    <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                    <input type="text"  name="mobile" class="form-control" value="{{ Request::old('mobile') }}"placeholder="الجوال" maxlength="10" aria-label="Username" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" disabled>00966</span>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group ">
                                    <label class="col-md-3 form-control-label" for="text-input">البريد الالكترونى </label>
                                    <input type="text"  name="email" class="form-control" value="{{ Request::old('email') }}"placeholder="البريد الالكترونى" maxlength="10" aria-label="Username" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" disabled>@</span>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">المدينه  </label>
                                    <div class="col-md-9">
                                        <select  name="city_id" class="form-control">
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('city_id'))
                                            <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">الحى </label>
                                    <div class="col-md-9">
                                        <input type="text" id="region_name" name="region_name" class="form-control"placeholder="الحى" value="{{Request::old('region_name')}}">

                                        @if ($errors->has('region_name'))
                                            <span class="text-danger">{{ $errors->first('region_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">
                                        الرقم المدنى (الهويه/الاقامه)
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text"  name="id_number" class="form-control" value="{{Request::old('id_number')}}"placeholder=" الرقم المدنى" maxlength="10">

                                        @if ($errors->has('id_number'))
                                            <span class="text-danger">{{ $errors->first('id_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ انتهاء الهويه/الاقامه  </label>
                                    <div class="col-md-9">
                                        <input type="date" id="identity_expiration_date" name="identity_expiration_date"placeholder="date" class="form-control"value="{{Request::old('identity_expiration_date')}}">
                                        @if ($errors->has('identity_expiration_date '))
                                            <span class="text-danger">{{ $errors->first('identity_expiration_date ') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">الجنسيه</label>
                                    <div class="col-md-9">
                                        <select  name="nationality_id" class="form-control">
                                            @foreach($nationalities as $nationality)
                                                <option onclick="hideInput()"value="{{$nationality->id}}">{{$nationality->name_ar}}</option>
                                            @endforeach
                                            <option onclick="displayInput()" value="">أخرى</option>
                                        </select>
                                        @if ($errors->has('nationality_id'))
                                            <span class="text-danger">{{ $errors->first('nationality_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row " id="nationality" style="display: none">
                                    <label class="col-md-3 form-control-label" for="text-input"> </label>
                                    <div class="col-md-9">
                                        <input type="text" id="nationality" name="name_ar" class="form-control"placeholder="الجنسيه" value="{{Request::old('name_ar')}}">
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"> نوع التعاقد </label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="request_employment">
                                            <option value="0">موظف</option>
                                            <option value="1">عامل حر </option>
                                        </select>
                                        @if ($errors->has('arrears'))
                                            <span class="text-danger">{{ $errors->first('arrears') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">اسم البنك </label>
                                    <div class="col-md-9">
                                        <select  name="bank_id" class="form-control">
                                            @foreach($banks as $bank)
                                                <option value="{{$bank->id}}">{{$bank->name_ar}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('bank_id'))
                                            <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"> رقم الحساب البنكى (IBAN) </label>
                                    <div class="col-md-9">
                                        <input type="text" id="arrears" name="iban_number" class="form-control"placeholder=" رقم الحساب البنكى" maxlength="14"value="{{Request::old('iban_number')}}" >

                                        @if ($errors->has('iban_number'))
                                            <span class="text-danger">{{ $errors->first('iban_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>


                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"class="form-control"> توصيل سجاد  </label>
                                    <div class="col-md-2">
                                        <label class="form-control check-ability-label">
                                            <input type="radio"  class="checkbox-ability" name="deliver_carpet" value="1" >نعم
                                            <br>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control check-ability-label">
                                            <input type="radio"  class="checkbox-ability" name="deliver_carpet" value="0" >لا
                                            <br>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">نوع السياره  </label>
                                    <div class="col-md-9">
                                        <select  name="car_type" class="form-control">
                                            @foreach($carTypes as $carType)
                                                <option value="{{$carType->id}}">{{$carType->name_ar}}</option>
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
                                                <option value="{{$year->id}}">{{$year->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('car_manufacture_year_id'))
                                            <span class="text-danger">{{ $errors->first('car_manufacture_year_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ انتهاء الرخصه</label>
                                    <div class="col-md-9">
                                        <input type="date" id="license_end_date" name="license_end_date"placeholder="date" class="form-control"value="{{Request::old('license_end_date')}}">
                                        @if ($errors->has('license_end_date'))
                                            <span class="text-danger">{{ $errors->first('license_end_date') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"class="form-control"> معلومات لوحه السياره  </label>
                                    <div class="col-md-2">
                                        <input type="text" id="car_plate_letter1" name="car_plate_letter1"placeholder="ق" class="form-control"maxlength="1"value="{{Request::old('car_plate_letter1')}}">
                                        @if ($errors->has('car_plate_letter1'))
                                            -<span class="text-danger">{{ $errors->first('car_plate_letter1') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="car_plate_letter2" name="car_plate_letter2"placeholder="ف" class="form-control"maxlength="1"value="{{Request::old('car_plate_letter2')}}">
                                        @if ($errors->has('car_plate_letter2'))
                                            -<span class="text-danger">{{ $errors->first('car_plate_letter2') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="car_plate_letter3" name="car_plate_letter3"placeholder="ق" class="form-control"maxlength="1"value="{{Request::old('car_plate_letter3')}}">
                                        @if ($errors->has('car_plate_letter3'))
                                            -<span class="text-danger">{{ $errors->first('car_plate_letter3') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="car_plate_number" name="car_plate_number"placeholder="الأرقام" class="form-control" maxlength="4"value="{{Request::old('car_plate_number')}}">
                                        @if ($errors->has('car_plate_number'))
                                            -<span class="text-danger">{{ $errors->first('car_plate_number') }}</span>
                                        @endif
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الملف الشخصى </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="avatar" required />
                                            <label class="custom-file-label" for="customFile1">صوره الملف الشخصى</label>
                                        </div>
                                        @if ($errors->has('avatar'))
                                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                </div>
                            <hr>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره السياره من الأمام </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="car_picture_front" required />
                                            <label class="custom-file-label" for="customFile1">صوره السياره من الأمام</label>
                                        </div>
                                        @if ($errors->has('car_picture_front'))
                                            <span class="text-danger">{{ $errors->first('car_picture_front') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره السياره من الخلف  </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="car_picture_behind" required />
                                            <label class="custom-file-label" for="customFile1">صوره السياره من الخلف</label>
                                        </div>
                                        @if ($errors->has('car_picture_behind'))
                                            <span class="text-danger">{{ $errors->first('car_picture_behind') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره ساريه لرخصه القياده   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="driving_license" required />
                                            <label class="custom-file-label" for="customFile1">صوره ساريه لرخصه القياده</label>
                                        </div>
                                        @if ($errors->has('driving_license'))
                                            <span class="text-danger">{{ $errors->first('driving_license') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره استمارة السيارة   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="car_registration" required />
                                            <label class="custom-file-label" for="customFile1">صوره استمارة السيارة</label>
                                        </div>
                                        @if ($errors->has('car_registration'))
                                            <span class="text-danger">{{ $errors->first('car_registration') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره الهويه / الاقامه   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="id_image" required />
                                            <label class="custom-file-label" for="customFile1">صوره الهويه / الاقامه</label>
                                        </div>
                                        @if ($errors->has('id_image'))
                                            <span class="text-danger">{{ $errors->first('id_image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الفحص الطبى   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="medicCheck" required />
                                            <label class="custom-file-label" for="customFile1">صوره الفحص الطبى </label>
                                        </div>
                                        @if ($errors->has('medicCheck'))
                                            <span class="text-danger">{{ $errors->first('medicCheck') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                   <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
<script>
    function displayInput(){

        let nationality= document.getElementById('nationality');
        console.log(nationality);
        (nationality.style.display ==="none") ?nationality.style.display ="block" :'';
    }
    function hideInput(){
        let nationality= document.getElementById('nationality');
        (nationality.style.display ==="block") ?nationality.style.display ="none" :'';
    }
</script>
