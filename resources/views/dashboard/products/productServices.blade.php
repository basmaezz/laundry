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
                    <a class="btn btn-secondary" href="../CategoryItems"><i class="icon-graph"></i> &nbsp;داشبرد</a>
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

                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>
                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary" style="float: left">اضافه خدمه</a>
                                </div>
                                <div class="card-block">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>اسم الخدمه</th>
                                            <th> السعر</th>

                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($product->productService as $service)
                                            <tr>
                                                    <td>{{$service->services}}</td>
                                                    <td>{{$service->price}}</td>
                                                    <td>
                                                        <a href="{{route('product.editService',$service->id)}}" class="btn btn-primary">تعديل</a>
                                                        <a href="{{route('product.deleteService',$service->id)}}" class="btn btn-danger">حذف</a>
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
