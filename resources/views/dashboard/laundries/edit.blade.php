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
                        <form method="post" action="{{route('laundries.update',$subCategory->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4 class="card-title">اضافه مغسله جديد</h4>
                            </div>
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="company" n>اسم المغسله</label>
                                    <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->name_ar}}">
                                    @error('name_ar')
                                    <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="company">اسم المغسله بالانجليزيه</label>
                                    <input type="text" name="name_en"class="form-control" id="name_en" value="{{$subCategory->name_en}}">
                                    @error('name_en')
                                    <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name"> مميزه  </label>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-control check-ability-label">
                                            <input type="radio"  class="checkbox-ability" name="vip" value="1"{{$subCategory->vip ==1 ? 'checked' :''}} >نعم
                                            <br>
                                        </label>
                                        <label class="form-control check-ability-label">
                                            <input type="radio"  class="checkbox-ability" name="vip" value="0" {{$subCategory->vip == 0 ? 'checked' :''}}>لا
                                            <br>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-addon-name"> غسيل مستعجل </label>
                                        <div class="custom-control custom-checkbox">
                                            <label class="form-control check-ability-label">
                                                <input type="radio"  class="checkbox-ability" name="urgentWash" onchange="showMakeUrgent()" value="1"{{$subCategory->urgentWash ==1 ? 'checked' :''}} >نعم
                                                <br>
                                            </label>
                                            <label class="form-control check-ability-label">
                                                <input type="radio"  class="checkbox-ability" name="urgentWash" onchange="hideMakeUrgent()" value="0"{{$subCategory->urgentWash == 0 ? 'checked' :''}} >لا
                                                <br>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('urgentWash'))
                                        <span class="text-danger">{{ $errors->first('urgentWash') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="company">المدينه</label>
                                    <select class="form-control" name="city_id">

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
                                    <label for="country">سعر التوصيل  </label>
                                    <div class="input-group">
                                        <input type="text" name="price" class="form-control" value="{{$subCategory->price ??Request::old('price') }}" >
                                        <span class="input-group-addon"> ريال</i>
                                                </span>
                                    </div>
                                    @error('price')
                                    <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="country">النسبه  </label>
                                    <div class="input-group">
                                        <input type="text"name="percentage" class="form-control" value="{{$subCategory->percentage}}" >
                                        <span class="input-group-addon"> %</i>
                                                </span>
                                    </div>
                                    @error('percentage')
                                    <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="approximate_duration">  المده التقريبيه للغسيل </label>
                                    <div class="input-group">
                                        <input type="text"name="approximate_duration" class="form-control"  value="{{$subCategory->approximate_duration}}"  >
                                        <span class="input-group-addon"> ساعه</i>
                                                </span>
                                    </div>
                                    @error('approximate_duration')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                    <div class="form-group " id="approximate_duration_urgent_input" >
                                        <label for="approximate_duration">  المده التقريبيه للغسيل السريع </label>
                                        <div class="input-group">
                                            <input type="number"name="approximate_duration_urgent" class="form-control" placeholder="24" value="{{$subCategory->approximate_duration_urgent}}" >
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
                                        <input type="radio" name="around_clock" value="0"  id="specificDuration" {{$subCategory->around_clock ==0 ? 'checked' :''}}>
                                        <label for="age2"> فتره محدده </label><br>
                                    </div>
                                </div>
                                @if($subCategory->around_clock =='0')
                                    <div class="form-group" id="durations" >
                                        <label for="country">بدايه الفتره </label>
                                        <input type="time" name="clock_at" value="{{$subCategory->clock_at}}" />

                                        <label for="country">نهايه الفتره </label>
                                        <input type="time" name="clock_end" value="{{$subCategory->clock_end}}" />
                                    </div>
                                @elseif($subCategory->around_clock =='1')
                                    <div class="form-group" id="durations" >
                                        <label for="country">بدايه الفتره </label>
                                        <input type="time" name="clock_at" value="22:00" />

                                        <label for="country">نهايه الفتره </label>
                                        <input type="time" name="clock_end"value="22:00" />
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
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <strong>اضافه أدمن </strong>
                            </div>

                            <div class="form-group ">
                                <label >الأسم الأول</label>
                                <input type="text" id="text-input" name="name" class="form-control" value="{{$subCategory->userTrashed[0]->name ??''}}">
                                @error('name')
                                <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label  for="text-input">الأسم الأخير</label>
                                <input type="text" id="text-input" name="last_name" class="form-control"value="{{$subCategory->userTrashed[0]->last_name ??''}}">
                                @error('last_name')
                                <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label  for="text-input">كلمه المرور </label>
                                <input type="password" id="text-input" name="password" class="form-control"placeholder="************">
                            </div>
                            <div class="form-group ">
                                <label  for="email-input">البريد الألكترونى </label>
                                <input type="email" id="email-input" name="email" class="form-control" value="{{$subCategory->userTrashed[0]->email ??''}}">
                                @error('email')
                                <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label  for="text-input">الجوال </label>
                                <input type="text" id="phone" name="phone" class="form-control"  value="{{$subCategory->userTrashed[0]->phone ??''}}"maxlength="10">
                                @error('phone')
                                <div class="text-sm text-red-600 text-danger">{{ $message }}</div>
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
@push('scripts')

@endpush
