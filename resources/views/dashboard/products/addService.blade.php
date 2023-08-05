@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('product.productServices',$product->id)}}">الخدمات</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه خدمه    </li>
            </ol>
        </nav>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه خدمه</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('product.createProductService')}}" >
                        @csrf
                        <div class="form-group row">
                            <div class="form-group">
                            <label  for="hf-email">اسم القطعه</label>
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
                                    <label for="company">السعر  </label><br>
                                    <div class="input-group">
                                        <input type="text"name="price" class="form-control view" placeholder="السعر " value="{{Request::old('range')}}" >
                                        <span class="input-group-addon"> ريال</i>
                                                </span>
                                    </div>

                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
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
                        <div class="card-footer">
                           <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger custom ">الغاء</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

