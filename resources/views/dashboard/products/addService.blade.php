@extends('../layouts.app')
@section('content')
    <main class="main">
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
                                <input type="hidden"  name="product_id" class="form-control" value="{{$product->id}}"  >
{{--                                <input type="hidden"  name="category_item_id" class="form-control" value="{{$product->category_item_id}}"  >--}}
                                <input type="text"  name="category_type" class="form-control" value="{{$product->name_ar}}" disabled >

                            </div>
                            <div class="form-group">
                                <label for="company">اسم الخدمه </label>
                                <input type="text" name="services"class="form-control" id="services" placeholder="اسم الخدمه" value="{{Request::old('services')}}">
                                @if ($errors->has('services'))
                                    <span class="text-danger">{{ $errors->first('services') }}</span>
                                @endif
                            </div>

                                <div class="form-group">
                                    <label for="company">السعر  </label><br>
                                    <input type="text" name="price" class="form-control-plaintext" id="staticEmail" value="{{Request::old('price')}}"> ريال
{{--                                    <input type="text" name="price"class="form-control" id="price" placeholder="السعر "value="{{Request::old('price')}}">--}}
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>


{{--                            <div class="form-group">--}}
{{--                                <label for="company">الصوره  </label>--}}
{{--                                <input type="file" name="productImage"class="form-control" id="image" >--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

