@extends('../layouts.app')
@section('content')
    <main class="main">
        <!-- Breadcrumb -->

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{route('laundries.storeBranch')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>اضافه مغسله جديده</strong>

                                </div>
                                <div class="card-block">
                                    <div class="form-group">
                                        <label for="company" n>اسم المغسله</label>
                                        <input type="text" name="parent_id"class="form-control" id="name_ar" value="{{$Subcategory->name_ar}}" disabled>
                                        <input type="hidden" name="parent_id"class="form-control"value="{{$Subcategory->id}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم الفرع</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" placeholder="اسم المغسله">
                                        @error('name_ar')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم الفرع بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_en" placeholder="اسم الفرع">
                                        @error('name_en')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
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
                                            <div class="text-sm text-red-600">{{ $message }}</div>
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
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country">السعر  </label>
                                        <input type="text" name="price"class="form-control" id="image" value=" {{$Subcategory->price}}">
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
                                        <input type="time" name="clock_at" />

                                        <label for="country">نهايه الفتره </label>
                                        <input type="time" name="clock_end"  />
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
                                        <input type="text" id="text-input" name="name" class="form-control" placeholder="Text">

                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الأسم الأخير</label>
                                        <input type="text" id="text-input" name="last_name" class="form-control" placeholder="Text">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="email-input">البريد الألكترونى </label>
                                        <input type="email" id="email-input" name="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="password-input">كلمه المرور</label>
                                        <input type="password" id="password-input" name="password" class="form-control" placeholder="Password">                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الجوال </label>
                                        <input type="text" id="phone" name="phone" class="form-control"required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-footer col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                <button type="reset" onclick="ResetForm()" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
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
