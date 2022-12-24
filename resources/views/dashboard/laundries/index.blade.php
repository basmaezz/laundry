@extends('../layouts.app')
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">خانه</li>
            <li class="breadcrumb-item"><a href="#">مدیریت</a>
            </li>
            <li class="breadcrumb-item active">داشبرد</li>

            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;داشبرد</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;تنظیمات</a>
                </div>
            </li>
        </ol>

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> المغاسل المسجله
                                <a href="{{route('laundries.create')}}" class="btn btn-primary" style="float:left;margin-top: 2px;">اضافه مغسله </a>

                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>التصنيف</th>
                                        <th>الاسم</th>
                                        <th>الاسم بالانجليزيه</th>
                                        <th>العنوان</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subCategories as $subCategory)

                                            <tr>
                                                <td>{{$subCategory->category->name_ar}} </td>
                                                <td>{{$subCategory->name_ar}} </td>
                                                <td>{{$subCategory->name_en}} </td>
                                                <td>{{$subCategory->address}}</td>

                                                <td>
                                                    <a href="{{route('CategoryItems.index',$subCategory->id)}}" class="btn btn-info"> الأقسام</a>
                                                    <a href="{{route('user.edit',$subCategory->id)}}" class="btn btn-primary">تعديل</a>
                                                    <a href="{{url('laundryDestroy',$subCategory->id)}}" class="btn btn-danger">حذف</a>
                                                    <a href="{{route('laundries.view',$subCategory->id)}}" class="btn btn-info">تفاصيل</a>

                                                </td>
                                            </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>



@endsection
