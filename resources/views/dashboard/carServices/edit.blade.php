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
                            <li class="breadcrumb-item active">تعديل مغسله </li>
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
                            <h4 class="card-title">اضافه منتج جديد</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{route('carServices.update',$carService->id)}}" method="post" enctype="multipart/form-data" >
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم الخدمه (عربى)</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="subCategory_id" class="form-control"value="{{$carService->subCategory_id}}" >
                                        <input type="text"  name="name_ar" class="form-control"value="{{$carService->name_ar}}" >
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label  class="col-md-3 form-control-label" for="hf-email"  for="company">اسم الخدمه (انجليزى) </label>
                                    <div class="col-md-9">
                                        <input type="text" name="name_en" class="form-control" id="lat"value="{{$carService->name_en}}" >
                                        @error('name_en')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">الوصف (عربى)</label>
                                    <div class="col-md-9">
                                        <input type="text" name="desc_ar" class="form-control" id="address"value="{{$carService->desc_ar}}" >
                                        @error('desc_ar')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">الوصف (انجليزى) </label>
                                    <div class="col-md-9">
                                        <input type="text" name="desc_en" class="form-control" id="address"value="{{$carService->desc_en}}" >
                                        @error('desc_en')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">سعر الخدمه </label>
                                    <div class="col-md-9">
                                        <input type="text" name="price" class="form-control" id="address"value="{{$carService->price}}" >
                                        @error('price')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">صوره الخدمه  </label>
                                    <img src="{{asset('assets/uploads/laundryServices/'.$carService->image)}}">
                                    <div class="col-md-9">
                                        <input type="file" name="image" class="form-control" id="image" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">تعديل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
