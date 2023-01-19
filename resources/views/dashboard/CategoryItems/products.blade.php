@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            @if($categoryItems->count()>0)
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> {{$categoryItems[0]->category_type}}
                                </div>
                                <div class="card-block">
                                    <table id="products" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>اسم القطعه</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categoryItems as $categoryItem)
                                            @foreach($categoryItem->products as $product)
                                        <tr>
                                            <td>{{$product->name_ar}} </td>
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
{{--                                        <tbody>--}}
{{--                                        @foreach($categoryItems as $categoryItem)--}}
{{--                                            <tr>--}}
{{--                                                @foreach($categoryItem->products as $product)--}}
{{--                                                    <td>{{$product->name_ar}} </td>--}}

{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
                                    </table>

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
@push('scripts')
    <script>
        $("#products").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#products_wrapper .col-md-6:eq(0)');
    </script>
@endpush
