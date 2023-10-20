@extends('../layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('product.productServices',$product->id)}}">الخدمات</a>
                            </li>
                            <li class="breadcrumb-item active">اضافه خدمه
                            </li>
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
                            <h4 class="card-title">اضافه قطعه</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('product.createProductService')}}" >
                                @csrf

                                <div class="form-group">
                                    <label  for="hf-email">اسم القطعه</label>
                                    <input type="hidden"  name="subcategory_id" class="form-control view" value="{{$product->subcategory_id}}"  >
                                    <input type="hidden"  name="product_id" class="form-control view" value="{{$product->id}}"  >
                                    <input type="text"  name="category_type" class="form-control view" value="{{$product->name_ar}}" disabled >
                                </div>
                                <div class="form-group">
                                    <label for="company">اسم الخدمه </label>
                                    <input type="text" name="services"class="form-control view" id="services" placeholder="اسم الخدمه" value="{{Request::old('services')}}">
                                    @if ($errors->has('services'))
                                        <span class="text-danger">{{ $errors->first('services') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company">اسم الخدمه بالانجليزيه </label>
                                    <input type="text" name="services_en"class="form-control view" id="services_en" placeholder="اسم الخدمه بالانجليزيه" value="{{Request::old('services_en')}}">
                                    @if ($errors->has('services_en'))
                                        <span class="text-danger">{{ $errors->first('services_en') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company">اسم الخدمه انجليزى (معرب) </label>
                                    <input type="text" name="services_franco"class="form-control view" id="services" placeholder="اسم الخدمه انجليزى (معرب)" value="{{Request::old('services_franco')}}">
                                    @if ($errors->has('services_franco'))
                                        <span class="text-danger">{{ $errors->first('services_franco') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="company">السعر  </label><br>
                                    <div class="input-group">
                                        <input type="text"name="price" class="form-control view" placeholder="السعر " value="{{Request::old('price')}}" >
                                        <span class="input-group-addon"> ريال</i>
                                                </span>
                                    </div>

                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                @if($product->subcategoryTrashed->urgentWash !=null || $product->subcategoryTrashed->urgentWash !=0)
                                    <div class="form-group">
                                        <label for="company">سعر المستعجل  </label><br>
                                        <div class="input-group">
                                            <input type="text"name="priceUrgent" class="form-control view" placeholder="السعر " value="{{Request::old('priceUrgent')}}" >
                                            <span class="input-group-addon"> ريال</i>
                                                </span>
                                        </div>

                                        @if ($errors->has('priceUrgent'))
                                            <span class="text-danger">{{ $errors->first('priceUrgent') }}</span>
                                        @endif
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="company">العموله  </label><br>
                                    <div class="input-group">
                                        <input type="text"name="commission" class="form-control view" placeholder="العموله " value="{{Request::old('commission')}}" >
                                    </div>

                                    @if ($errors->has('commission'))
                                        <span class="text-danger">{{ $errors->first('commission') }}</span>
                                    @endif
                                </div>

                        </div>







            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
            </form>
    </div>
    </div>
    </div>
    <!-- /Bootstrap Validation -->
@endsection

