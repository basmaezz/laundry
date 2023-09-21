@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div>
            <div class="animated fadeIn">
                <div class="row">

<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-6">

        <div class="card">
            <div class="card-header">
                <strong> اضافه قطعه جديده</strong>
            </div>
            <div class="card-block">

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
            </div>
        </div>
        <div class="card-footer">
           <button type="submit" class="btn btn-sm btn-info" style="max-height: 30px !important; max-width: 40px"> حفظ</button>
            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger "style="max-height: 30px !important; max-width: 40px">الغاء</a>
        </div>
           </div>
    </form>
                </div>
            </div>
        </div>
    </main>

@endsection

