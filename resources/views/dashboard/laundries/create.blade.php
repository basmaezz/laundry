@extends('layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اضافه مغسله  </li>
                </ol>
            </nav>
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <form method="post" action="{{url('laundryStore')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="card-header">
                            <h4 class="card-title">اضافه مغسله جديد</h4>
                        </div>
                        <div class="card-body">


                                <div class="form-group">
                                    <label for="company">التصنيف </label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" >{{$category->name_ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label class="form-label" for="basic-addon-name"> مميزه  </label>
                                        <div class="custom-control custom-checkbox">
                                             <label class="form-control check-ability-label">
                                                    <input type="radio"  class="checkbox-ability" name="vip" value="1" >نعم
                                                    <br>
                                             </label>
                                            <label class="form-control check-ability-label">
                                                    <input type="radio"  class="checkbox-ability" name="vip" value="0" >لا
                                                    <br>
                                            </label>
                                      </div>
                                </div>
                            <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-addon-name"> غسيل مستعجل </label>
                                        <div class="custom-control custom-checkbox">
                                                <label class="form-control check-ability-label">
                                                    <input type="radio"  class="checkbox-ability" name="urgentWash" value="1" onchange="showMakeUrgent()">نعم
                                                    <br>
                                                </label>
                                            <label class="form-control check-ability-label">
                                                    <input type="radio"  class="checkbox-ability" name="urgentWash" value="0" onchange="hideMakeUrgent()">لا
                                                    <br>
                                                </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="company" n>اسم المغسله</label>
                                    <input type="text" name="name_ar"class="form-control" id="name_ar"value="{{ Request::old('name_ar') }}" placeholder="اسم المغسله" >
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    <div class="text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="company">اسم المغسله بالانجليزيه</label>
                                    <input type="text" name="name_en"class="form-control" id="name_en" value="{{ Request::old('name_en') }}"placeholder="اسم المغسله" >
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group" >
                                    <label for="company">المدينه</label>
                                    <select class="form-control" name="city_id">

                                        @foreach($cities as $value=>$key)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                        @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="company">الحى</label>
                                    <input type="text" name="address"class="form-control" id="address"value="{{ Request::old('address') }}" placeholder="العنوان " >
                                    @error('address')
                                    <div class="text-sm text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country">الموقع(Google Map) </label>
                                    <input type="text" name="location"class="form-control"value="{{ Request::old('location') }}" id="location" placeholder="الموقع(Google Map)" >
                                    @error('location')
                                    <span class="text-danger">{{ $message }}</span>
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
                                    <label for="range"> نطاق التشغيل </label>

                                    <div class="input-group">
                                        <input type="number"name="range" class="form-control" placeholder="نطاق التشغيل" value="{{Request::old('range')}}" >
                                        <span class="input-group-addon"> كيلومتر</i>
                                                </span>
                                    </div>
                                    @if ($errors->has('range'))
                                        <span class="text-danger">{{ $errors->first('range') }}</span>
                                    @endif
                                </div>
                                <div class="form-group ">
                                    <label for="price"> سعر التوصيل  </label>

                                    <div class="input-group">
                                        <input type="text"name="price" class="form-control" placeholder="سعر التوصيل " value="{{Request::old('range')}}" >
                                        <span class="input-group-addon"> ريال</i>
                                                </span>
                                    </div>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group ">
                                    <label for="price"> النسبه  </label>

                                    <div class="input-group">
                                        <input type="text"name="percentage" class="form-control" placeholder="النسبه " value="{{Request::old('percentage')}}" >
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
                                        <input type="number"name="approximate_duration" class="form-control" placeholder="24" value="{{Request::old('range')}}" >
                                        <span class="input-group-addon"> ساعه</i>
                                                </span>
                                    </div>
                                    @error('approximate_duration')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group " id="approximate_duration_urgent_input" style="display: none">
                                    <label for="approximate_duration">  المده التقريبيه للغسيل السريع </label>
                                    <div class="input-group">
                                        <input type="number"name="approximate_duration_urgent" class="form-control" placeholder="24" value="{{Request::old('range')}}" >
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
                                        <input type="radio"  name="around_clock" value="1" onchange="hideDurations()" >
                                        <label for="age1">طوال اليوم</label><br>
                                        <input type="radio" name="around_clock" value="0"  id="specificDuration" onchange="showDurations()">
                                        <label for="age2"> فتره محدده </label><br>

                                    </div>
                                </div>
                                <div class="form-group" id="durations" style="display: none">
                                    <label for="country">بدايه الفتره </label>
                                    <input type="time" name="clock_at" value="22:00" />

                                    <label for="country">نهايه الفتره </label>
                                    <input type="time" name="clock_end" value="22:00" />
                                </div>
                                <div class="form-group">
                                    <label for="country">صوره الشعار</label>
                                    <input type="file" name="image"class="form-control" id="image" required>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="card-header">
                                    <strong>اضافه أدمن </strong>
                                </div>

                                <div class="form-group ">
                                    <label >الأسم الأول</label>
                                    <input type="text" id="text-input" name="name" class="form-control"value="{{ Request::old('name') }}" placeholder="الاسم الأول" >
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label  for="text-input">الأسم الأخير</label>
                                    <input type="text" id="text-input" name="last_name" class="form-control"value="{{ Request::old('last_name') }}" placeholder=" الأسم الاخير " >
                                    @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label  for="email-input">البريد الألكترونى </label>
                                    <input type="email" id="email-input" name="email" class="form-control"value="{{ Request::old('email') }}" placeholder=" البريد الالكترونى" >
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label  for="password-input">كلمه المرور</label>
                                    <input type="password" id="password-input" name="password" class="form-control" placeholder="Password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                    <label  for="text-input">الجوال </label>
                                    <input type="text" id="phone" name="phone"value="{{ Request::old('phone') }}" class="form-control" placeholder="الجوال" maxlength="10">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
            </div>
                <!-- /Bootstrap Validation -->
@endsection

