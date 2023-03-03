@extends('../layouts.app')
@section('content')
    <main class="main">
        <!-- Breadcrumb -->

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
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" placeholder="اسم المغسله">
                                         @error('name_ar')
                                         <div class="text-sm text-red-600">{{ $message }}</div>
                                         @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم المغسله بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_en" placeholder="اسم المغسله">
                                        @error('name_en')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="company">المدينه</label>
                                        <select class="form-control" name="city_id">
                                            <option >أختر المدينه</option>
                                            @foreach($cities as $value=>$key)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                            @error('city_id')
                                            <div class="text-sm text-red-600">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى</label>
                                        <input type="text" name="address"class="form-control" id="address" placeholder="العنوان ">
                                        @error('address')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country">الموقع(Google Map) </label>
                                        <input type="text" name="location"class="form-control" id="location">
                                        @error('location')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country">سعر التوصيل  </label>
                                        <input type="text" name="price"class="form-control" id="image" placeholder=" سعر التوصيل">
                                        @error('price')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
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
                                            <input type="text" id="text-input" name="name" class="form-control" placeholder="الاسم الأول">
                                        @error('name')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الأسم الأخير</label>
                                            <input type="text" id="text-input" name="last_name" class="form-control" placeholder=" الأسم الاخير ">
                                        @error('last_name')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label  for="email-input">البريد الألكترونى </label>
                                            <input type="email" id="email-input" name="email" class="form-control" placeholder=" البريد الالكترونى">
                                        @error('email')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label  for="password-input">كلمه المرور</label>
                                            <input type="password" id="password-input" name="password" class="form-control" placeholder="Password">
                                        @error('password')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الجوال </label>
                                            <input type="text" id="phone" name="phone" class="form-control"required>
                                        @error('phone')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                            </div>
                            </div>
                        </div>
                        <div>
                        <div class="card-footer col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i>حفظ</button>
                            <button type="reset" onclick="ResetForm()" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> الغاء</button>
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
