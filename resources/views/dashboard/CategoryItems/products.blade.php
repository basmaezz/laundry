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
{{--            <a href="{{route('CategoryItems.create',$subCategory->id)}}" class="btn btn-primary" style="margin-bottom: 20px">اضافه قسم</a>--}}
            @if($categoryItems->count()>0)
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> {{$categoryItems[0]->category_type}}
                                </div>
                                <div class="card-block">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
{{--                                            <th> الصوره</th>--}}
                                            <th>اسم القطعه</th>

                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categoryItems as $categoryItem)
                                            <tr>
                                                @foreach($categoryItem->products as $product)
{{--                                                    @foreach($product->productImages as $image)--}}
{{--                                                        @dd($image)--}}
{{--                                                <td><img src="{{asset('/images/products',$image->image)}}"> </td>--}}
{{--                                                    @endforeach--}}
                                                <td>{{$product->name_ar}} </td>
{{--                                                @foreach($product->productService as $service)--}}
{{--                                                          <td>{{$service->services}} </td>--}}
{{--                                                          <td>{{$service->price}} </td>--}}

{{--                                                    @endforeach--}}
                                                    <td>
                                                        @if($product->productService->count()>0)
                                                        <a href="{{route('product.productServices',$product->id)}}" class="btn btn-primary"> خدمات</a>
                                                            <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " hidden> اضافه خدمه</a>
                                                        @else
                                                        <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " > اضافه خدمه</a>
                                                        @endif
                                                            <a href="{{route('product.view',$product->id)}}" class="btn btn-info"> التفاصيل</a>
                                                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary">تعديل</a>
                                                            <a href="{{route('product.destroy',$product->id)}}" class="btn btn-danger">حذف</a>
                                                    </td>
                                            </tr>
                                        @endforeach
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
