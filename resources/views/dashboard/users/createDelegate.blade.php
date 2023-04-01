@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">

                                <div class="card-header">
                                    <strong>اضافه مندوب جديد </strong>
                                </div>
                                <div class="card-block">
                                    <form action="{{route('delegate.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        @csrf

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الثلاثى </label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="name" class="form-control" placeholder="الاسم "required>

                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                            <div class="col-md-9">
                                                <input type="text" id="mobile" name="mobile" class="form-control"placeholder="الجوال" required>

                                                @if ($errors->has('mobile'))
                                                    <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">المدينه  </label>
                                            <div class="col-md-9">
                                                <select  name="city_id" class="form-control">
                                                    @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('city'))
                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الحى </label>
                                            <div class="col-md-9">
                                                <input type="text" id="address" name="address" class="form-control"placeholder="الحى" required>

                                                @if ($errors->has('car_plate_number'))
                                                    <span class="text-danger">{{ $errors->first('car_plate_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الملف الشخصى </label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-input" name="avatar" class="form-control">
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"> الرقم المدنى (الهويه/الاقامه)</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="id_number" class="form-control" placeholder=" الرقم المدنى"required>

                                                @if ($errors->has('last_name'))
                                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ انتهاء الهويه/الاقامه  </label>
                                            <div class="col-md-9">
                                                <input type="date" id="license_start_date" name="license_start_date"placeholder="date" class="form-control">
                                                @if ($errors->has('license_start_date '))
                                                    <span class="text-danger">{{ $errors->first('license_start_date ') }}</span>
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
                                                <input type="text" id="nationality" name="nationality_name" class="form-control"placeholder="الجنسيه" >
                                                @if ($errors->has('nationality_id'))
                                                    <span class="text-danger">{{ $errors->first('nationality_id') }}</span>
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
                                                <input type="text" id="arrears" name="bank_name" class="form-control"placeholder="اسم البنك" required>

                                                @if ($errors->has('arrears'))
                                                    <span class="text-danger">{{ $errors->first('arrears') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"> رقم الحساب البنكى (IBAN) </label>
                                            <div class="col-md-9">
                                                <input type="text" id="arrears" name="iban_number" class="form-control"placeholder=" رقم الحساب البنكى" maxlength="14" required>

                                                @if ($errors->has('arrears'))
                                                    <span class="text-danger">{{ $errors->first('arrears') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>

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
                                                <input type="date" id="license_end_date" name="license_end_date"placeholder="date" class="form-control">
                                                @if ($errors->has('license_end_date'))
                                                    <span class="text-danger">{{ $errors->first('license_end_date') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"class="form-control"> معلومات لوحه السياره  </label>
                                            <div class="col-md-2">
                                                <input type="text" id="car_plate_letter" name="car_plate_letter"placeholder="الأحرف" class="form-control"maxlength="6">

                                                @if ($errors->has('car_plate_letter'))
                                                    <span class="text-danger">{{ $errors->first('car_plate_letter') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" id="car_plate_number" name="car_plate_number"placeholder="الأرقام" class="form-control" maxlength="4">
                                                @if ($errors->has('car_plate_number'))
                                                    -<span class="text-danger">{{ $errors->first('car_plate_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره السياره من الأمام </label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-input" name="car_picture_front" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره السياره من الخلف  </label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-input" name="car_picture_behind" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره  لرخصه القياده ساريه  </label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-input" name="car_registration" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره استمارة السيارة</label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-input" name="glasses_avatar" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الهويه / الاقامه  </label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-input" name="id_image" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الفحص الطبى </label>
                                            <div class="col-md-9">
                                                <input type="file" id="medic_check" name="medic_check" class="form-control">
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
                </div>
            </div>

        </div>
    </main>

@endsection
<script>
    function displayInput(){
        let nationality= document.getElementById('nationality');
        (nationality.style.display ==="none") ?nationality.style.display ="block" :'';
    }
    function hideInput(){
        let nationality= document.getElementById('nationality');
        (nationality.style.display ==="block") ?nationality.style.display ="none" :'';
    }
</script>
