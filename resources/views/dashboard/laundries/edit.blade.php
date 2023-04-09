@extends('../layouts.app')
@section('content')
    <main class="main">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                <li class="breadcrumb-item active" aria-current="page">  تعديل مغسله </li>
            </ol>
        </nav>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{route('laundries.update',$subCategory->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>تعديل بيانات المغسله </strong>

                                </div>
                                <div class="card-block">

                                    @if($subCategory->parent_id !='')
                                    <div class="form-group">
                                        <label for="company" n>اسم المغسله الرئيسيه</label>
                                        <input type="text" name="parent_id"class="form-control" id="name_ar" value="{{$subCategory->parent->name_ar??''}}" disabled>
                                        <input type="hidden" name="parent_id"class="form-control"value="{{$subCategory->id}}">
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="company" n>اسم الفرع</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->name_ar}}">
                                        @error('name_ar')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم الفرع بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_en" value="{{$subCategory->name_en}}">
                                        @error('name_en')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="company">المدينه</label>
                                        <select class="form-control" name="city_id">
                                            <option >أختر المدينه</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}" {{$subCategory->city_id==$city->id ?'selected':''}}>{{$city->name_ar}}</option>
                                            @endforeach
                                            @error('city_id')
                                            <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->address}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="country">الموقع(Google Map) </label>
                                        <input type="text" name="location"class="form-control" id="location" value="{{$subCategory->location}}">
                                        @error('location')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                            <label for="company">latitude </label>
                                            <input type="text" name="lat"class="form-control" id="lat"value="{{$subCategory->lat}}" placeholder="latitude " >
                                            @error('lat')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="company">longitude</label>
                                            <input type="text" name="lng"class="form-control" id="address"value="{{$subCategory->lng}}" placeholder="longitude " >
                                            @error('address')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="approximate_duration"> نطاق التشغيل </label>
                                            <div class="input-group">
                                                <input type="text"name="range" class="form-control" value="{{$subCategory->range??''}}" max="50" min="5"  >
                                                <span class="input-group-addon"> كيلومتر</i>
                                                </span>
                                            </div>
                                            @error('range')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    <div class="form-group">
                                        <label for="country">السعر  </label>
                                        <div class="input-group">
                                            <input type="text"name="price" class="form-control" value="{{$subCategory->price}}" >
                                            <span class="input-group-addon"> ريال</i>
                                                </span>
                                        </div>
                                        @error('price')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                            <label for="approximate_duration">  المده التقريبيه للغسيل </label>
                                            <div class="input-group">
                                                <input type="text"name="approximate_duration" class="form-control" placeholder="24"  value="{{$subCategory->approximate_duration??''}}" min="1" >
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
                                            <input type="radio"  name="around_clock" value="1" onchange="hideDurations()"{{$subCategory->around_clock ==1 ? 'checked' :''}} >
                                            <label for="age1">طوال اليوم</label><br>
                                            <input type="radio" name="around_clock" value="0"  id="specificDuration" onchange="showDurations()"{{$subCategory->around_clock ==Null ? 'checked' :''}}>
                                            <label for="age2"> فتره محدده </label><br>
                                        </div>
                                    </div>
                                    @if($subCategory->around_clock ==Null)
                                        <div class="form-group" id="durations" >
                                            <label for="country">بدايه الفتره </label>
                                            <input type="time" name="clock_at" value="{{$subCategory->clock_at}}" />

                                            <label for="country">نهايه الفتره </label>
                                            <input type="time" name="clock_end" value="{{$subCategory->clock_end}}" />
                                        </div>
                                    @endif
                                    @if($subCategory->parent_id =='')
                                            <div class="form-group">
                                                <img src="{{$subCategory->image}}" style="width: 100px; height: 100px">
                                            </div>

                                     <div class="form-group">
                                        <label for="country">صوره الشعار</label>
                                        <input type="file" name="image"class="form-control" id="image" placeholder="Country name">
                                    </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>تعديل أدمن </strong>
                                </div>

                                <div class="card-block">

                                    <div class="form-group ">
                                        <label >الأسم الأول</label>
                                        <input type="text" id="text-input" name="name" class="form-control" value="{{$subCategory->user[0]->name ??''}}">

                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الأسم الأخير</label>
                                        <input type="text" id="text-input" name="last_name" class="form-control"value="{{$subCategory->user[0]->last_name ??''}}">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">كلمه المرور </label>
                                        <input type="password" id="text-input" name="password" class="form-control"placeholder="************">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="email-input">البريد الألكترونى </label>
                                        <input type="email" id="email-input" name="email" class="form-control" value="{{$subCategory->user[0]->email ??''}}">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الجوال </label>
                                        <input type="text" id="phone" name="phone" class="form-control"  value="{{$subCategory->user[0]->phone ??''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-footer col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> تعديل</button>
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
