@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('laundries.branches',$Subcategory->id)}}">الفروع</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه فرع  </li>
            </ol>
        </nav>

    <div>
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{route('laundries.storeBranch')}}" >
                        @csrf
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>اضافه فرع للمغسله </strong>

                                </div>
                                <div class="card-block">
                                    <div class="form-group">
                                        <input name="image" type="hidden" value="{{asset('assets/uploads/laundries/logo/'.$Subcategory->image)}}">
                                    </div>
                                    <div class="form-group">

                                        <label for="company" n>اسم المغسله</label>
                                        <input type="text" name="parent_id"class="form-control" id="name_ar" value="{{$Subcategory->name_ar}}" disabled>
                                        <input type="hidden" name="parent_id"class="form-control"value="{{$Subcategory->id}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم الفرع</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" placeholder="اسم المغسله">
                                        @error('name_ar')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم الفرع بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_en" placeholder="اسم الفرع">
                                        @error('name_en')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="company">المدينه</label>
                                        <select class="form-control" name="city_id">
                                            <option >أختر المدينه</option>
                                            @foreach($cities as $value=>$key)
                                                <option value="{{$key}}" {{$Subcategory->city_id==$key ?'selected':''}}>{{$value}}</option>
                                            @endforeach
                                            @error('city_id')
                                            <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$Subcategory->address}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="country">الموقع(Google Map) </label>
                                        <input type="text" name="location"class="form-control" id="location" placeholder="https://maps.google.com/?q=51.03841,-114.01679 " required>
                                        @error('location')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="company">latitude </label>
                                        <input type="text" name="lat" class="form-control" id="lat"value="{{ Request::old('lat') }}" placeholder="latitude " >
                                        @error('lat')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="company">longitude</label>
                                        <input type="text" name="lng" class="form-control" id="address"value="{{ Request::old('lng') }}" placeholder="longitude " >
                                        @error('lng')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group ">
                                        <label for="approximate_duration"> نطاق التشغيل </label>

                                        <div class="input-group">
                                            <input type="text"name="range" class="form-control" placeholder="نطاق التشغيل" value=" {{$Subcategory->range??''}}" max="50" min="5"  >
                                            <span class="input-group-addon"> كيلومتر</i>
                                                </span>
                                        </div>
                                        @if ($errors->has('range'))
                                            <span class="text-danger">{{ $errors->first('range') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group ">
                                        <label for="approximate_duration"> السعر  </label>

                                        <div class="input-group">
                                            <input type="text"name="price" class="form-control" placeholder="السعر " value="{{$Subcategory->price}}" >
                                            <span class="input-group-addon"> ريال</i>
                                                </span>
                                        </div>
                                        @if ($errors->has('price'))
                                            <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group ">
                                        <label for="approximate_duration"> النسبه  </label>

                                        <div class="input-group">
                                            <input type="text"name="percentage" class="form-control" placeholder="النسبه " value="{{$Subcategory->percentage}}" >
                                            <span class="input-group-addon"> %</i>
                                                </span>
                                        </div>
                                        @if ($errors->has('percentage'))
                                            <span class="text-danger">{{ $errors->first('percentage') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="approximate_duration">  المده التقريبيه للغسيل </label>
                                        <div class="input-group">
                                            <input type="text"name="approximate_duration" class="form-control" placeholder="24"  value="{{$Subcategory->approximate_duration??''}}" min="1" >
                                            <span class="input-group-addon"> ساعه</i>
                                                </span>
                                        </div>
                                        @error('approximate_duration')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group" >
                                        <div>
                                            <label for="country">فتره التشغيل  </label> <br>
                                            <input type="radio"  name="around_clock" value="1" onchange="hideDurations()"{{$Subcategory->around_clock ==1 ? 'checked' :''}} >
                                            <label for="age1">طوال اليوم</label><br>
                                            <input type="radio" name="around_clock" value="0"  id="specificDuration" onchange="showDurations()"{{$Subcategory->around_clock ==Null ? 'checked' :''}}>
                                            <label for="age2"> فتره محدده </label><br>
                                        </div>
                                    </div>
                                    @if($Subcategory->around_clock ==Null)
                                    <div class="form-group" id="durations" >
                                        <label for="country">بدايه الفتره </label>
                                        <input type="time" name="clock_at" value="{{$Subcategory->clock_at}}" />

                                        <label for="country">نهايه الفتره </label>
                                        <input type="time" name="clock_end" value="{{$Subcategory->clock_end}}" />
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>اضافه أدمن </strong>
                                </div>
                                <div class="card-block">

                                    <div class="form-group ">
                                        <label >الأسم الأول</label>
                                        <input type="text" id="text-input" name="name" class="form-control" placeholder="الأسم الأول">

                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الأسم الأخير</label>
                                        <input type="text" id="text-input" name="last_name" class="form-control" placeholder="الأسم الأخير ">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="email-input">البريد الألكترونى </label>
                                        <input type="email" id="email-input" name="email" class="form-control" placeholder="البريد الالكترونى  ">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="password-input">كلمه المرور</label>
                                        <input type="password" id="password-input" name="password" class="form-control" placeholder="كلمه المرور ">                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الجوال </label>
                                        <input type="text" id="phone" name="phone" class="form-control"  placeholder="الجوال"required maxlength="9">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-footer col-sm-12">
                               <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                <button type="reset" onclick="ResetForm()" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
<script>

        function ResetForm(){
        document.getElementById('name_ar').value='';
        document.getElementById('name_en').value='';
        document.getElementById('address').value='';
        document.getElementById('image').value='';
    }

    function showDurations(){
        let durations= document.getElementById('durations');
        (durations.style.display ==="none") ?durations.style.display ="block" :durations.style.display ="none";
    }

    function hideDurations(){
        let durations= document.getElementById('durations');
        (durations.style.display ==="block") ?durations.style.display ="none" :'';
    }

</script>
