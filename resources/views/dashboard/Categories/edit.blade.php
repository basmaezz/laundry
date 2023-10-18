@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل التصنيف </h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('category.update',$category->id)}}"enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">اسم التصنيف</label>
                                        <input type="text"  name="name_ar" class="form-control" value="{{$category->name_ar}}" >
                                        @if ($errors->has('category_type'))
                                            <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                        @endif

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name"> اسم التصنيف بالانحليزى   </label>
                                        <input type="text"  name="name_en" class="form-control" value="{{$category->name_en}}" >
                                        @if ($errors->has('category_type'))
                                            <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                        @endif

                                </div>
                                <img src="{{$category->image}}" style="width: 100px;height: 100px;margin-right: 140px">


                                <div class="form-group">
                                    <label for="customFile1">ًالصوره </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile1" name="image" required />
                                        <label class="custom-file-label" for="image">Choose profile pic</label>
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
