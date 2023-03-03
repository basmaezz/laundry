@extends('../layouts.app')
@section('content')
    <main class="main">

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
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">الصوره</label>
                            <div class="col-md-9">
                                <input type="file" id="file-input" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> تعديل</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

