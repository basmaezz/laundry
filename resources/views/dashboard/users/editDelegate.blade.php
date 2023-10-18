
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره استمارة السيارة</label>--}}
{{--                                        <div class="col-md-9">--}}
{{--                                            @if(pathinfo($delegate['car_registration'], PATHINFO_EXTENSION)=='pdf'||pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='docx')--}}
{{--                                                <a href="{{$delegate->car_registration}}" download>--}}
{{--                                                    Download--}}
{{--                                                </a>--}}
{{--                                            @else--}}
{{--                                                <a href="{{$delegate->car_registration}}" download>--}}
{{--                                                    <img src="{{$delegate->car_registration}}" style="width:200px;height:200px;padding:15px;border-radius:20px;" >--}}
{{--                                                </a>--}}
{{--                                            @endif--}}
{{--                                                <input type="file" id="file-input" name="car_registration" class="form-control">--}}

{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                   <div class="form-group row">--}}
{{--                                        <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الفحص الطبى </label>--}}
{{--                                       <div class="col-md-9">--}}

{{--                                               <input type="file" id="medic_check" name="medicCheck" class="form-control">--}}

{{--                                       </div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <button type="submit" class="btn btn-sm btn-info custom"style="max-height: 28px !important; max-width: 55px !important;"><i class="fa fa-dot-circle-o"></i> حفظ</button>--}}
{{--                        <a href="{{URL::previous()}}" class="btn btn-sm btn-danger"style="max-height: 28px !important; max-width: 40px !important;">الغاء </a>--}}
{{--                    </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        </div>--}}
{{--    </main>--}}

{{--@endsection--}}
{{--<script>--}}
{{--    function displayInput(){--}}
{{--        console.log('test');--}}
{{--        let nationality= document.getElementById('nationality');--}}
{{--        (nationality.style.display ==="none") ?nationality.style.display ="block" :'';--}}
{{--    }--}}
{{--    function hideInput(){--}}
{{--        let nationality= document.getElementById('nationality');--}}
{{--        (nationality.style.display ==="block") ?nationality.style.display ="none" :'';--}}
{{--    }--}}
{{--</script>--}}
@extends('layouts.app')
@section('content')
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
                            <form action="{{route('delegate.update',$delegate->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">الأسم   </label>
                                    <div class="col-md-9">
                                        <input type="text" id="text-input" name="name" class="form-control"value="{{$delegate->appUserTrashed->name}}">
                                    </div>
                                </div>

                                <div class="input-group ">
                                    <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                    <input type="text"  name="phone" class="form-control"  value="{{mb_substr($delegate->appUserTrashed->mobile, 3, 9)}}" maxlength="10" aria-label="Username" aria-describedby="basic-addon1"style="direction: ltr"maxlength="9">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1" disabled>00966</span>
                                    </div>
                                </div>
                                <br>
                                <div class="input-group ">
                                    <label class="col-md-3 form-control-label" for="text-input">البريد الالكترونى </label>
                                    <input type="text"  name="email" class="form-control" value="{{$delegate->appUserTrashed->email}}" aria-label="Username" aria-describedby="basic-addon1">
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
                                                <option value="{{$city->id}}"{{$delegate->appUserTrashed->city_id==$city->id ?'selected':''}}>{{$city->name_ar}}</option>
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
                                        <input type="text"  name="region_name" class="form-control" value="{{$delegate->appUserTrashed->region_name}}">

                                        @if ($errors->has('region_name'))
                                            <span class="text-danger">{{ $errors->first('region_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الملف الشخصى </label>                                            <div class="col-md-9">
                                        <div class="custom-file">

                                            <input type="file" class="custom-file-input" id="customFile1" name="profileImage"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                        </div>
                                        <img src="{{asset('assets/uploads/users_avatar/'.$delegate->appUserTrashed->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">

                                    @if ($errors->has('avatar'))
                                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الهوية الوطنية </label>                                            <div class="col-md-9">
                                        <div class="custom-file">

                                            <input type="file" class="custom-file-input" id="customFile1" name="profileImage"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>

                                        </div>
                                        @if(pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='pdf'||pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='docx')
                                            <a href="{{$delegate->id_image}}" download>
                                                Download
                                            </a>
                                        @else
                                            <a href="{{$delegate->id_image}}" download>
                                                <img src="{{$delegate->id_image}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </a>
                                        @endif
                                        @if ($errors->has('avatar'))
                                            <span class="text-danger">{{ $errors->first('avatar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">
                                        الرقم المدنى (الهويه/الاقامه)
                                    </label>
                                    <div class="col-md-9">
                                        <input type="text"  name="id_number" class="form-control" value="{{$delegate->id_number}}" maxlength="10">

                                        @if ($errors->has('id_number'))
                                            <span class="text-danger">{{ $errors->first('id_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ انتهاء الهويه/الاقامه  </label>
                                    <div class="col-md-9">
                                        <input type="date" id="identity_expiration_date" name="identity_expiration_date"class="form-control"value="{{$delegate->identity_expiration_date}}">
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
                                            <option value="0"{{$delegate->request_employment==0 ?'selected':''}}>موظف</option>--}}
                                            <option value="1"{{$delegate->request_employment==1 ?'selected':''}}>عامل حر </option>
                                        </select>
                                        @if ($errors->has('request_employment'))
                                            <span class="text-danger">{{ $errors->first('request_employment') }}</span>
                                        @endif
                                    </div>
                                </div>

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
                                    <label class="col-md-3 form-control-label" for="text-input"> رقم الحساب البنكى (IBAN) </label>
                                    <div class="col-md-9">
                                        <input type="text" id="text-input" name="iban_number" class="form-control" value="{{$delegate->iban_number}}">

                                        @if ($errors->has('iban_number'))
                                            <span class="text-danger">{{ $errors->first('iban_number') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">نوع السياره  </label>
                                    <div class="col-md-9">
                                        <select  name="car_type" class="form-control">
                                            @foreach($carTypes as $carType)
                                                <option value="{{$carType->id}}"{{$delegate->car_type_id==$carType->id?'selected':''}}>{{$carType->name_ar}}</option>
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
                                    <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ انتهاء الرخصه</label>
                                    <div class="col-md-9">
                                        <input type="text" id="text-input" name="license_end_date" class="form-control" value="{{$delegate->license_end_date}}">
                                        @if ($errors->has('license_end_date'))
                                            <span class="text-danger">{{ $errors->first('license_end_date') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"class="form-control"> معلومات لوحه السياره  </label>
                                    <div class="col-md-2">
                                        <input type="text"  name="car_plate_letter1" class="form-control"value="{{mb_substr($delegate->car_plate_letter, 0, 1)}}" maxlength="1">
                                    @if ($errors->has('car_plate_letter1'))
                                            -<span class="text-danger">{{ $errors->first('car_plate_letter1') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"  name="car_plate_letter2" class="form-control"value="{{mb_substr($delegate->car_plate_letter, 1, 1)}}" maxlength="1">
                                    @if ($errors->has('car_plate_letter2'))
                                            -<span class="text-danger">{{ $errors->first('car_plate_letter2') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text"  name="car_plate_letter3" class="form-control"value="{{mb_substr($delegate->car_plate_letter, 2, 1)}}" maxlength="1">
                                        @if ($errors->has('car_plate_letter3'))
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
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره السياره من الأمام </label>
                                    <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="car_picture_front"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                        </div>
                                        @if(pathinfo($delegate['car_picture_front'], PATHINFO_EXTENSION)=='pdf'|| pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='docx')
                                            <a href="{{$delegate->car_picture_front}}" download>
                                                Download
                                            </a>
                                        @else
                                            <a href="{{($delegate->car_picture_front)}}" download>
                                                <img src="{{($delegate->car_picture_front)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </a>
                                        @endif
                                        @if ($errors->has('car_picture_front'))
                                            <span class="text-danger">{{ $errors->first('car_picture_front') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره السياره من الخلف  </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="car_picture_behind"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                        </div>
                                        @if(pathinfo($delegate['car_picture_behind'], PATHINFO_EXTENSION)=='pdf'||pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='docx')
                                            <a href="{{$delegate->car_picture_behind}}" download>
                                                Download
                                            </a>
                                        @else
                                            <a href="{{$delegate->car_picture_behind}}" download>
                                                <img src="{{$delegate->car_picture_behind}}" style="width:200px;height:200px;padding:15px;border-radius:20px;"></a>
                                        @endif
                                        @if ($errors->has('car_picture_behind'))
                                            <span class="text-danger">{{ $errors->first('car_picture_behind') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره ساريه لرخصه القياده   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="driving_license"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                        </div>
                                        @if(pathinfo($delegate['driving_license'], PATHINFO_EXTENSION)=='pdf'||pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='docx')
                                            <a href="{{$delegate->driving_license}}" download>
                                                Download
                                            </a>
                                        @else
                                            <a href="{{$delegate->driving_license}}" download>
                                                <img src="{{$delegate->driving_license}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </a>
                                        @endif
                                        @if ($errors->has('driving_license'))
                                            <span class="text-danger">{{ $errors->first('driving_license') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره استمارة السيارة   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="car_registration"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                        </div>
                                        @if(pathinfo($delegate['car_registration'], PATHINFO_EXTENSION)=='pdf'||pathinfo($delegate['car_registration'], PATHINFO_EXTENSION)=='docx')
                                            <a href="{{$delegate->car_registration}}" download>
                                                Download
                                            </a>
                                        @else
                                            <a href="{{$delegate->car_registration}}" download>
                                                <img src="{{$delegate->car_registration}}" style="width:200px;height:200px;padding:15px;border-radius:20px;" >
                                            </a>
                                        @endif
                                        @if ($errors->has('car_registration'))
                                            <span class="text-danger">{{ $errors->first('car_registration') }}</span>
                                        @endif
                                    </div>
                                </div>                     <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control"> صوره الهويه / الاقامه   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="id_image"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                        </div>
                                        @if(pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='pdf'||pathinfo($delegate['id_image'], PATHINFO_EXTENSION)=='docx')
                                            <a href="{{$delegate->medic_check}}" download>
                                                Download
                                            </a>
                                        @else
                                            <a href="{{$delegate->id_image}}" download>
                                                <img src="{{$delegate->id_image}}" style="width:200px;height:200px;padding:15px;border-radius:20px;" >
                                            </a>
                                        @endif
                                        @if ($errors->has('id_image'))
                                            <span class="text-danger">{{ $errors->first('id_image') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الفحص الطبى   </label>                                            <div class="col-md-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile1" name="medicCheck"  />
                                            <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                        </div>
                                        @if(pathinfo($delegate['medic_check'], PATHINFO_EXTENSION)=='pdf'||pathinfo($delegate['medic_check'], PATHINFO_EXTENSION)=='docx')
                                            <a href="{{$delegate->medic_check}}" download>
                                                Download
                                            </a>
                                        @else
                                            <a href="{{$delegate->medic_check}}" download>
                                                <img src="{{$delegate->medic_check}}" style="width:200px;height:200px;padding:15px;border-radius:20px;" >
                                            </a>
                                        @endif
                                        @if ($errors->has('medicCheck'))
                                            <span class="text-danger">{{ $errors->first('medicCheck') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
