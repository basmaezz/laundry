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
                            <li class="breadcrumb-item"><a href="{{route('CategoryItems.index',$categoryItem->subcategory_id)}}">الأقسام</a>
                            </li>
                            <li class="breadcrumb-item active">اضافه قطعه
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
                            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="company" n>اسم القطعه</label>
                                    <input type="text" name="name_ar"class="form-control view" id="name_ar" placeholder="اسم القطعه" value="{{ Request::old('name_ar') }}">
                                    <input type="hidden" name="category_item_id"class="form-control view" id="category_item_id" value="{{$categoryItem->id}}">
                                    <input type="hidden" name="subcategory_id"class="form-control view" id="subcategory_id" value="{{$categoryItem->subcategory_id}}">
                                    @if ($errors->has('name_ar'))
                                        <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company" >اسم القطعه بالانجليزيه</label>
                                    <input type="text" name="name_en"class="form-control view" id="name_ar" placeholder="اسم القطعه بالانجليزيه" value="{{ Request::old('name_en') }}">
                                    @if ($errors->has('name_en'))
                                        <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company" > اسم القطعه  (معرب)</label>
                                    <input type="text" name="name_franco"class="form-control view" id="name_franco" placeholder="اسم القطعه بالانجليزيه" value="{{ Request::old('name_franco') }}">
                                    @if ($errors->has('name_franco'))
                                        <span class="text-danger">{{ $errors->first('name_franco') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company" >الوصف  </label>
                                    <input type="text" name="desc_ar"class="form-control view" id="name_ar" placeholder="الوصف " value="{{ Request::old('desc_ar') }}">
                                    @if ($errors->has('desc_ar'))
                                        <span class="text-danger">{{ $errors->first('desc_ar') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company" >الوصف  بالانجليزيه</label>
                                    <input type="text" name="desc_en"class="form-control view" id="name_ar" placeholder="الوصف  بالانجليزيه " value="{{ Request::old('desc_en') }}">
                                    @if ($errors->has('desc_en'))
                                        <span class="text-danger">{{ $errors->first('desc_en') }}</span>
                                    @endif
                                </div>
                                @if($categoryItem->subcategories->urgentWash ==1)
                                    <div class="form-group">
                                        <label class="col-md- form-control-label">غسيل مستعجل </label>
                                        <div class="form-control">

                                            <label class="form-control check-ability-label">
                                                <input type="radio"  class="checkbox-ability" name="urgentWash" value="1" >نعم
                                                <br>
                                            </label>
                                            <label class="form-control check-ability-label">
                                                <input type="radio"  class="checkbox-ability" name="urgentWash" value="0" >لا
                                                <br>
                                            </label>
                                        </div>
                                        @if ($errors->has('urgentWash'))
                                            <span class="text-danger">{{ $errors->first('urgentWash') }}</span>
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="company">الصوره  </label>
                                    <input type="file" name="subProductImage"class="form-control view" id="image" >
                                    @if ($errors->has('subProductImage'))
                                        <span class="text-danger">{{ $errors->first('subProductImage') }}</span>
                                    @endif
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
            </div>
                </div>
            </div>
    </div>
    <!-- /Bootstrap Validation -->
@endsection

