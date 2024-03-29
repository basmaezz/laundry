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
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل المنتج</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('carpetCategories.update',$carpetCategory->id)}}" >
                            @csrf


                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم المنتج (عربى)</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="category_ar" class="form-control"value="{{$carpetCategory->category_ar}}"  >
                                        @if ($errors->has('category_ar'))
                                            <span class="text-danger">{{ $errors->first('category_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <label  class="col-md-3 form-control-label" for="hf-email"  for="company">اسم المنتج (انجليزى) </label>
                                    <div class="col-md-9">
                                        <input type="text" name="category_en" class="form-control" id="lat"value="{{ $carpetCategory->category_en }}"  >
                                        @error('category_en')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">الوصف (عربى)</label>
                                    <div class="col-md-9">
                                        <input type="text" name="desc_ar" class="form-control" id="address"value="{{ $carpetCategory->desc_ar }}" placeholder="الوصف (عربى) " >
                                        @error('desc_ar')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">الوصف (انجليزى) </label>
                                    <div class="col-md-9">
                                        <input type="text" name="desc_en" class="form-control" id="address"value="{{ $carpetCategory->desc_en }}"  >
                                        @error('desc_en')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">السعر </label>
                                    <div class="col-md-9">
                                        <input type="text" name="price" class="form-control" id="address"value="{{ $carpetCategory->price }}"  >
                                        @error('price')
                                        <div class="text-sm text-red-600">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label  class="col-md-3 form-control-label" for="hf-email" for="company">ربح المغسله  </label>
                                    <div class="col-md-9">
                                        <input type="text" name="laundry_profit" class="form-control" id="laundry_profit"value="{{ $carpetCategory->laundry_profit }}" placeholder="ربح المغسله  " >
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
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
