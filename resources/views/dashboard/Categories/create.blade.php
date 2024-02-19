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
                            <li class="breadcrumb-item"><a href="{{route('Categories.index')}}">التصنيفات</a>
                            </li>
                            <li class="breadcrumb-item active">تعديل بيانات
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
                            <h4 class="card-title">تعديل التصنيف </h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('category.store')}}"enctype="multipart/form-data" >
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">اسم التصنيف</label>
                                    <input type="text"  name="name_ar" class="form-control" placeholder="اسم التصنيف" >
                                    @if ($errors->has('name_ar'))
                                        <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name"> اسم التصنيف بالانحليزى   </label>
                                    <input type="text"  name="name_en" class="form-control" placeholder="اسم التصنيف" >
                                    @if ($errors->has('name_en'))
                                        <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="customFile1">ًالصوره </label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile1" name="image" required />
                                        <label class="custom-file-label" for="image">Choose profile pic</label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
