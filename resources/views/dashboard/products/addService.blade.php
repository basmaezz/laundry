@extends('../layouts.app')
@section('content')
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="../CategoryItems"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>
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
                                <input type="hidden"  name="category_item_id" class="form-control" value="{{$product->category_item_id}}"  >
                                <input type="text"  name="category_type" class="form-control" value="{{$product->name_ar}}" >

                            </div>
                            <div class="form-group">
                                <label for="company">اسم الخدمه </label>
                                <input type="text" name="services"class="form-control" id="services" placeholder="اسم الخدمه">
                                @if ($errors->has('category_type'))
                                    <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="company">السعر  </label>
                                <input type="text" name="price"class="form-control" id="price" placeholder="السعر ">
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

