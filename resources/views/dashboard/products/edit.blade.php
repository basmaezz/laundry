

@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل بيانات القطعه</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">اسم القطعه </label>
                                    <input type="hidden" name="id"class="form-control view" id="name" value="{{$product->id}}">
                                    <input type="hidden" name="category_item_id"class="form-control view" id="name" value="{{$product->category_item_id}}">
                                    <input type="text" name="name_ar"class="form-control view" id="name_ar" value="{{$product->name_ar}}" required>

                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاخير</div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">اسم القطعه بالانجليزي </label>
                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$product->name_en}}">
                                    @if ($errors->has('name_en'))
                                        <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاخير</div>
                                </div>
                                <div class="form-group">
                                    <label for="company" > اسم القطعه بالانجليزيه (معرب)</label>
                                    <input type="text" name="name_franco"class="form-control view" id="name_franco" placeholder="اسم القطعه معرب" value="{{ $product->name_franco}}">
                                    @if ($errors->has('name_franco'))
                                        <span class="text-danger">{{ $errors->first('name_franco') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company" >الوصف  </label>
                                    <input type="text" name="desc_ar"class="form-control view" id="name_ar" value="{{$product->desc_ar}}">
                                    @if ($errors->has('desc_ar'))
                                        <span class="text-danger">{{ $errors->first('desc_ar') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company" >الوصف  بالانجليزيه</label>
                                    <input type="text" name="desc_en"class="form-control view" id="name_ar" value="{{$product->desc_en}}">
                                    @if ($errors->has('desc_en'))
                                        <span class="text-danger">{{ $errors->first('desc_en') }}</span>
                                    @endif
                                </div>
                                @if($product->subcategoryTrashed->urgentWash !=0)
                                    <div class="form-group">
                                        <label class="col-md- form-control-label">غسيل مستعجل </label>
                                        <div class="form-control">

                                            <label class="form-control check-ability-label">
                                                <input type="radio"  class="checkbox-ability" name="urgentWash" value="1"{{$product->urgentWash ==1 ? 'checked' :''}}  >نعم
                                                <br>
                                            </label>
                                            <label class="form-control check-ability-label">
                                                <input type="radio"  class="checkbox-ability" name="urgentWash" value="0"{{$product->urgentWash ==0 ? 'checked' :''}} >لا
                                                <br>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <img src="{{$product->image}}" style="width: 100px;height: 100px">
                                <div class="form-group">
                                    <label for="company">الصوره  </label>
                                    <input type="file" name="subProductImage"class="form-control view" id="image" value="{{$product->image}}" >
                                </div>
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

