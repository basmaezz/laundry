@extends('../layouts.app')
@section('content')
    <main class="main">

        <ol class="breadcrumb">
            <li class="breadcrumb-item">خانه</li>
            <li class="breadcrumb-item"><a href="#">مدیریت</a>
            </li>
            <li class="breadcrumb-item active">داشبرد</li>
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;داشبرد</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;تنظیمات</a>
                </div>
            </li>
        </ol>
        @if($errors->any())
            <div class="alert alert-danger">
            <h6>{{$errors->first()}}</h6>
            </div>
        @endif

        <div class="container-fluid">
            <a href="{{route('CategoryItems.create',$subCategory->id)}}" class="btn btn-primary" style="margin-bottom: 20px">اضافه قسم</a>
            @if($categoryItems->count()>0)
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> Striped Table
                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>اسم القسم</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categoryItems as $categoryItem)
                                        <tr>
                                            <td>{{$categoryItem->category_type}} </td>
                                            <td>
                                                <a href="{{route('product.create',$categoryItem->id)}}" class="btn btn-primary">اضافه قطعه</a>
                                                <a href="{{route('CategoryItems.show',$categoryItem->id)}}" class="btn btn-info">عرض  القطع </a>
{{--                                                <a href="{{route('CategoryItems.show',$categoryItem->id)}}" class="btn btn-info">عرض تفاصيل القطع </a>--}}
                                                <a href="{{route('CategoryItems.edit',$categoryItem->id)}}" class="btn btn-primary">تعديل</a>
                                                <a href="{{route('CategoryItems.destroy',$categoryItem->id)}}" class="btn btn-danger">حذف</a>
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
            @endif
        </div>

        </div>
    </main>



@endsection
