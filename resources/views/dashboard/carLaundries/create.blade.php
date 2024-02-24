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
                        <form method="post" action="{{route('carLaundries.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4 class="card-title">اضافه مغسله جديد</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="company" >اسم المغسله</label>
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
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </div>
                        </form>
@endsection

