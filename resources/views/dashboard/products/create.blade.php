@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
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
                    <input type="text" name="name_ar"class="form-control" id="name_ar" placeholder="اسم القطعه">
                    <input type="hidden" name="category_item_id"class="form-control" id="category_item_id" value="{{$categoryItem->id}}">
                    <input type="hidden" name="subcategory_id"class="form-control" id="subcategory_id" value="{{$categoryItem->subcategory_id}}">
                    @if ($errors->has('name_ar'))
                        <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="company" >اسم القطعه بالانجليزيه</label>
                    <input type="text" name="name_en"class="form-control" id="name_ar" placeholder="اسم القطعه بالانجليزيه">
                    @if ($errors->has('name_en'))
                        <span class="text-danger">{{ $errors->first('name_en') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="company" >الوصف  </label>
                    <input type="text" name="desc_ar"class="form-control" id="name_ar" placeholder="الوصف ">
                    @if ($errors->has('desc_ar'))
                        <span class="text-danger">{{ $errors->first('desc_ar') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="company" >الوصف  بالانجليزيه</label>
                    <input type="text" name="desc_en"class="form-control" id="name_ar" placeholder="الوصف  بالانجليزيه ">
                    @if ($errors->has('desc_en'))
                        <span class="text-danger">{{ $errors->first('desc_en') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="company">الصوره  </label>
                    <input type="file" name="subProductImage"class="form-control" id="image" >
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

