{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main">--}}

{{--        <div class="container-fluid">--}}
{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                    <form method="post" action="{{route('laundries.update',$subCategory->id)}}" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <strong>تعديل بيانات المغسله</strong>--}}

{{--                                </div>--}}
{{--                                <div class="card-block">--}}
{{--                                    <div class="form-group">--}}
{{--                                     @if(isset($subCategory->parent->name_ar))--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company" n>الفرع الرئيسى </label>--}}
{{--                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->parent->name_ar}}">--}}
{{--                                    </div>--}}
{{--                                        @endif--}}
{{--                                        <div class="form-group">--}}
{{--                                        <label for="company" n>اسم المغسله</label>--}}
{{--                                        <input type="hidden" name="$subCategory_id"class="form-control" id="name_ar" value="{{$subCategory->id}}">--}}
{{--                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->name_ar}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">اسم المغسله بالانجليزيه</label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$subCategory->name_en}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">الحى</label>--}}
{{--                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->address}}">--}}
{{--                                    </div>--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="country">صوره الشعار</label>--}}
{{--                                        <input type="file" name="image">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                                <div class="card-footer">--}}
{{--                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>--}}
{{--                                    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>--}}
{{--                                </div>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                        </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--@endsection--}}

@extends('../layouts.app')
@section('content')
    <main class="main">
        <!-- Breadcrumb -->

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{route('laundries.update',$subCategory->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>تعديل بيانات الفرع </strong>

                                </div>
                                <div class="card-block">
                                    <div class="form-group">
                                        <input name="image" type="hidden" value="{{asset('assets/uploads/laundries/logo/'.$subCategory->image)}}">
                                    </div>
                                    @if($subCategory->parent_id !='')
                                    <div class="form-group">
                                        <label for="company" n>اسم المغسله الرئيسيه</label>
                                        <input type="text" name="parent_id"class="form-control" id="name_ar" value="{{$subCategory->parent->name_ar}}" disabled>
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
                                            @foreach($cities as $value=>$key)
                                                <option value="{{$key}}" {{$subCategory->city_id==$key ?'selected':''}}>{{$value}}</option>
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
                                        <input type="text" name="location"class="form-control" id="location" value="">
                                        @error('location')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="country">السعر  </label>
                                        <input type="text" name="price"class="form-control" id="image" value=" {{$subCategory->price}}">
                                        @error('price')
                                        <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
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
                                        <input type="text" id="text-input" name="name" class="form-control" value="{{$subCategory->user[0]->name}}">

                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الأسم الأخير</label>
                                        <input type="text" id="text-input" name="last_name" class="form-control"value="{{$subCategory->user[0]->last_name}}">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="email-input">البريد الألكترونى </label>
                                        <input type="email" id="email-input" name="email" class="form-control" value="{{$subCategory->user[0]->email}}">
                                    </div>
                                    <div class="form-group ">
                                        <label  for="text-input">الجوال </label>
                                        <input type="text" id="phone" name="phone" class="form-control"  value="{{$subCategory->user[0]->phone}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-footer col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> تعديل</button>
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
