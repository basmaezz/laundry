@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{route('laundries.update',$subCategory->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>تعديل بيانات المغسله</strong>

                                </div>
                                <div class="card-block">
                                    <div class="form-group">
                                     @if(isset($subCategory->parent->name_ar))
                                    <div class="form-group">
                                        <label for="company" n>الفرع الرئيسى </label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->parent->name_ar}}">
                                    </div>
                                        @endif
                                        <div class="form-group">
                                        <label for="company" n>اسم المغسله</label>
                                        <input type="hidden" name="$subCategory_id"class="form-control" id="name_ar" value="{{$subCategory->id}}">
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->name_ar}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم المغسله بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$subCategory->name_en}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->address}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="country">صوره الشعار</label>
                                        <input type="file" name="image">
                                    </div>
                                </div>
                            </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                    <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                                </div>
                        </div>

                        <div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

