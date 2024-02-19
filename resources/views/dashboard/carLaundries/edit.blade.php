@extends('../layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a> </li>
                            <li class="breadcrumb-item"><a href="{{route('carLaundries.index')}}">مغاسل السيارات</a> </li>
                            <li class="breadcrumb-item active">تعديل  </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل مغسله  </h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('carLaundries.update',$carLaundry->id)}}" >
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم المنطقه(AR)</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="name_ar" class="form-control"value="{{$carLaundry->name_ar}}"  >
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم المنطقه(EN)</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="name_en" class="form-control"value="{{$carLaundry->name_en}}"  >
                                        @if ($errors->has('name_en'))
                                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group  row">
                                    <label  class="col-md-3 form-control-label" for="hf-email"  for="company">latitude </label>
                                    <div class="col-md-9">
                                        <input type="text" name="lat" class="form-control" id="lat"value="{{ $carLaundry->lat }}"  >
                                        @error('lat')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">longitude</label>
                                    <div class="col-md-9">
                                        <input type="text" name="lng" class="form-control" id="address"value="{{ $carLaundry->lng }}"  >
                                        @error('lng')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">نطاق التشغيل</label>
                                    <div class="col-md-9">
                                        <input type="text" name="range" class="form-control" id="address"value="{{ $carLaundry->range }}" >
                                        @error('range')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div>
                                        <label for="country">فتره التشغيل  </label> <br>
                                        <input type="radio"  name="around_clock" value="1" onchange="hideDurations()"{{$carLaundry->around_clock ==1 ? 'checked' :''}} >
                                        <label for="age1">طوال اليوم</label><br>
                                        <input type="radio" name="around_clock" value="0"  id="specificDuration" {{$carLaundry->around_clock ==0 ? 'checked' :''}}>
                                        <label for="age2"> فتره محدده </label><br>
                                    </div>
                                </div>
                                @if($carLaundry->around_clock =='0')
                                    <div class="form-group" id="durations" >
                                        <label for="country">بدايه الفتره </label>
                                        <input type="time" name="clock_at" value="{{$carLaundry->clock_at}}" />

                                        <label for="country">نهايه الفتره </label>
                                        <input type="time" name="clock_end" value="{{$carLaundry->clock_end}}" />
                                    </div>
                                @elseif($carLaundry->around_clock =='1')
                                    <div class="form-group" id="durations" >
                                        <label for="country">بدايه الفتره </label>
                                        <input type="time" name="clock_at" value="22:00" />

                                        <label for="country">نهايه الفتره </label>
                                        <input type="time" name="clock_end"value="22:00" />
                                    </div>
                                @endif


                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
