@extends('../layouts.app')
@section('content')
    <main class="main">
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
                                                        <a href="{{route('product.deleteProductService',$service->id)}}" class="btn btn-danger">حذف</a>
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
