@extends('../layouts.app')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه مغسله  </li>
            </ol>
        </nav>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                        <form method="post" action="{{url('laundryStore')}}" enctype="multipart/form-data">
                        @csrf
                         <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>اضافه مغسله جديده</strong>

                                </div>
                                <div class="card-block">
                                    <div class="form-group">
                                        <label for="company">التصنيف </label>
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" >{{$category->name_ar}}</option>
                                            @endforeach

                                        </select>
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
                                        <input type="text" name="location"class="form-control"value="{{ Request::old('location') }}" id="location" >
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

                                    <div class="form-group">
                                        <label for="approximate_duration"> نطاق التشغيل </label>
                                        <input type="number" name="range"class="form-control-plaintext" id="price"value="{{ Request::old('range') }}"> كيلومتر
{{--                                        <input type="number" name="range"class="form-control" id="range" value="{{ Request::old('range') }}" style="width: 50%" >--}}
                                        <span> كيلومتر</span>
                                        @error('range')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country">السعر  </label>
                                        <input type="text" name="price"class="form-control-plaintext" id="price" value="{{ Request::old('price') }}">  ريال

                                        {{--                                        <input type="text" name="price"class="form-control" id="image" value="{{$subCategory->price}}">--}}
                                        @error('price')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="approximate_duration">  المده التقريبيه للغسيل </label>
                                        <input type="number" name="approximate_duration"class="form-control" value="{{ Request::old('approximate_duration') }}"id="approximate_duration" placeholder="  24 ساعه" >
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
                                        <input type="file" name="image"class="form-control" id="image" placeholder="Country name">
                                    </div>

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
                                            <input type="text" id="phone" name="phone"value="{{ Request::old('phone') }}" class="form-control" placeholder="الجوال">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div>
                        <div class="card-footer col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>حفظ</button>
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
