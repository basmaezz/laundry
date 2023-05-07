@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('CategoryItems.show',$product->category_item_id)}}">القطع</a></li>
                <li class="breadcrumb-item active" aria-current="page">الخدمات    </li>
            </ol>
        </nav>
        <div class="validationMsg" style="width: 600px">
            @if($errors->any())
                <div class="alert alert-danger" >
                    <h6>{{$errors->first()}}</h6>
                </div>
            @elseif(session()->has('message'))
                <div class="alert alert-success"  >
                    {{ session()->get('message') }}
                </div>
            @endif
        </div>

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
                                          <th>الاجراءات</th>
                                        </tr>
                                        </thead>
                                        @if($product->productService->count() >0)
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
                                        @else
                                            <tbody>
                                            <tr><td>
                                                    لا يوجد بيانات لعرضها

                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        @endif
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
