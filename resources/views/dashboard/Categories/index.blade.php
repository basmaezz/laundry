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
                            <li class="breadcrumb-item active">التصنيفات
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main" style="margin-top: 25px">
        <a href="{{route('category.create')}}" class="btn btn-primary"   >اضافه جديد</a>

    <div>

                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> التصنيفات
                                 </div>
                                <div class="card-block">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th> الصورة</th>
                                            <th>اسم التصنيف</th>
                                          <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td><img src="{{$category->image}}" style="width:50px;height:50px"></td>
                                                <td>{{$category->name_ar}} </td>
                                                <td>

                                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary "  >تعديل</a>

                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </main>
@endsection
