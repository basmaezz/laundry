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
                            <li class="breadcrumb-item"><a href="{{route('carpetLaundries.index')}}">مغاسل السجاد</a> </li>
                            <li class="breadcrumb-item active">مغاسل السجاد </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه منطقه جديد</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('carpetLaundries.store')}}" >
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم المنطقه(En)</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="name_en" class="form-control"value="{{Request::old('name_en')}}" placeholder="اسم المنطقه " >
                                        @if ($errors->has('name_en'))
                                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم المنطقه(AR)</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="name_ar" class="form-control"value="{{Request::old('name_ar')}}" placeholder="اسم المنطقه " >
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email"> المده التقريبيه للغسيل</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="approximate_duration" class="form-control"value="{{Request::old('approximate_duration')}}" placeholder="المده التقريبيه للغسيل" >
                                        @if ($errors->has('approximate_duration'))
                                            <span class="text-danger">{{ $errors->first('approximate_duration') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label  class="col-md-3 form-control-label" for="hf-email"  for="company">latitude </label>
                                    <div class="col-md-9">
                                        <input type="text" name="lat" class="form-control" id="lat"value="{{ Request::old('lat') }}" placeholder="latitude " >
                                        @error('lat')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">longitude</label>
                                    <div class="col-md-9">
                                        <input type="text" name="lng" class="form-control" id="address"value="{{ Request::old('lng') }}" placeholder="longitude " >
                                        @error('lng')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">نطاق التشغيل</label>
                                    <div class="col-md-9">
                                        <input type="text" name="range" class="form-control" id="address"value="{{ Request::old('range') }}" placeholder="range " >
                                        @error('range')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">سعر التوصيل </label>
                                    <div class="col-md-9">
                                        <input type="text" name="price" class="form-control" id="address"value="{{ Request::old('price') }}" placeholder="سعر التوصيل " >
                                        @error('price')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div></div>
                </div>
        </section>
    </div>
@endsection
