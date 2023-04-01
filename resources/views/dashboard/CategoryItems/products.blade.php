@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">

            @if($products->count()>0)
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-header">
{{--                                    <i class="fa fa-align-justify"></i> {{$categoryItems[0]->category_type}}--}}
                                    <a href="{{route('product.create',$id)}}" class="btn btn-primary" style="float: left">اضافه قطعه</a>
                                </div>
                                <div class="card-block">
                                    <table id="products" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th> الصوره</th>
                                            <th>اسم القطعه</th>
                                            <th>الوصف </th>
                                            <th>الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($products as $product)
                                        <tr>
                                            <td><img src="{{$product->image}}" style="width: 50px;height: 50px"></td>
                                            <td>{{$product->name_ar}}</td>
                                            <td>{{$product->desc_ar}}</td>
                                            <td>
                                                @if($product->productService->count()>0)
                                                    <a href="{{route('product.productServices',$product->id)}}" class="btn btn-primary"> خدمات</a>
                                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " hidden> اضافه خدمه</a>
                                                @else
                                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " > اضافه خدمه</a>
                                                @endif
                                                <a href="{{route('product.view',$product->id)}}" class="btn btn-info"> التفاصيل</a>
                                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary">تعديل</a>
                                                    <form class="delete" action="{{route('product.destroy',$product->id)}}" method="get" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" value="حذف" class="edit btn btn-danger btn-sm" style="display: inline">
                                                    </form>

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
            @endif
                <a href="{{route('product.create',$id)}}" class="btn btn-primary" style="float: right">اضافه قطعه</a>
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
    <script>
        $(".delete").on("submit", function(){
            return confirm("هل أنت متأكد من الحذف ؟");
        });
    </script>
@endpush
