
{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main">--}}
{{--        <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <div class="col-sm-6">--}}

{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <strong> اضافه قطعه جديده</strong>--}}
{{--                    </div>--}}
{{--                    <div class="card-block">--}}

{{--                        <div class="form-group">--}}
{{--                            <label for="company" n>اسم القطعه</label>--}}
{{--                            <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$product->name_ar}}">--}}

{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="company" >اسم القطعه بالانجليزيه</label>--}}
{{--                            <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$product->name_en}}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="company" >الوصف  </label>--}}
{{--                            <input type="text" name="desc_ar"class="form-control" id="name_ar" value="{{$product->desc_ar}}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="company" >الوصف  بالانجليزيه</label>--}}
{{--                            <input type="text" name="desc_en"class="form-control" id="name_ar" value="{{$product->desc_en}}">--}}
{{--                        </div>--}}


{{--                        <div class="card-footer" style="clear: both" >--}}
{{--                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>--}}
{{--                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> الغاء</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

{{--       </form>--}}

{{--    </main>--}}

{{--@endsection--}}

@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">

                    <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">

                            <div class="card">
                                <div class="card-header">
                                    <strong> اضافه قطعه جديده</strong>
                                </div>
                                <div class="card-block">

                                    <div class="form-group">
                                        <label for="company" n>اسم القطعه</label>

                                        <input type="hidden" name="product_id"class="form-control" id="name" value="{{$product->id}}">
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$product->name_ar}}">
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="company" >اسم القطعه بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$product->name_en}}">
                                        @if ($errors->has('name_en'))
                                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="company" >الوصف  </label>
                                        <input type="text" name="desc_ar"class="form-control" id="name_ar" value="{{$product->desc_ar}}">
                                        @if ($errors->has('desc_ar'))
                                            <span class="text-danger">{{ $errors->first('desc_ar') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="company" >الوصف  بالانجليزيه</label>
                                        <input type="text" name="desc_en"class="form-control" id="name_ar" value="{{$product->desc_en}}">
                                        @if ($errors->has('desc_en'))
                                            <span class="text-danger">{{ $errors->first('desc_en') }}</span>
                                        @endif
                                    </div>
                                    <img src="{{$product->image}}" style="width: 100px;height: 100px">
                                    <div class="form-group">
                                        <label for="company">الصوره  </label>
                                        <input type="file" name="subProductImage"class="form-control" id="image" value="{{$product->image}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> الغاء</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
