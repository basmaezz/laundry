@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('CategoryItems.show',$product->category_item_id)}}">القطع</a></li>
                <li class="breadcrumb-item active" aria-current="page">تعديل البيانات   </li>
            </ol>
        </nav>
    <div>
            <div class="animated fadeIn">
                <div class="row">

                    <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">

                            <div class="card">
                                <div class="card-header">
                                    <strong>تعديل بيانات القطعه</strong>
                                </div>
                                <div class="card-block">

                                    <div class="form-group">
                                        <label for="company">اسم القطعه</label>
                                        <input type="hidden" name="product_id"class="form-control" id="name" value="{{$product->id}}">
                                        <input type="hidden" name="category_item_id"class="form-control" id="name" value="{{$product->category_item_id}}">
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
                               <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                <a href="{{URL::previous()}}" class="btn btn-sm btn-danger custom ">الغاء</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
