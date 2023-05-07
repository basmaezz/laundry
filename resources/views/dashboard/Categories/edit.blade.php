@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('Categories.index')}}">التصنيفات</a></li>
                <li class="breadcrumb-item active" aria-current="page">تعديل التصنيف</li>
            </ol>
        </nav>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong> تعديل تصنيف</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('category.update',$category->id)}}"enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم التصنيف</label>
                            <div class="col-md-9">
                                <input type="text"  name="name_ar" class="form-control" value="{{$category->name_ar}}" >
                                @if ($errors->has('category_type'))
                                    <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email"> اسم التصنيف بالانحليزى   </label>
                            <div class="col-md-9">
                                <input type="text"  name="name_en" class="form-control" value="{{$category->name_en}}" >
                                @if ($errors->has('category_type'))
                                    <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                @endif
                            </div>
                        </div>

                        <img src="{{$category->image}}" style="width: 100px;height: 100px;margin-right: 140px">
                        <div class="form-group">
                            <label for="company">الصوره  </label>
                            <input type="file" id="file-input" name="image" class="form-control">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> تعديل</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

