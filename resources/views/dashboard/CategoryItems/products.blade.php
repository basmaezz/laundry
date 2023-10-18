@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                <li class="breadcrumb-item active"><a href="{{route('CategoryItems.index',$subCategory->subcategory_id)}}">الأقسام</a></li>
                <li class="breadcrumb-item active" aria-current="page">القطع  </li>
            </ol>
        </nav>
        <div>


            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="card">
                            <div class="card-header">
                                {{--                                    <i class="fa fa-align-justify"></i> {{$categoryItems[0]->category_type}}--}}
                                <a href="{{route('product.create',$id)}}" class="btn btn-primary custom" style="float: left; max-height: 35px; max-width:100px">اضافه قطعه</a>
                            </div>
                            <div class="card-block">
                                <table id="products" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th> الصوره</th>
                                        <th>اسم القطعه</th>
                                        <th>اسم القطعه انجليزى</th>
                                        <th>اسم القطعه(معرب)</th>
                                        @if($subCategory->subcategories->urgentWash==1)
                                            <th>غسيل مستعجل </th>
                                        @endif
                                        <th>الوصف </th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($products as $product)
                                        <tr>
                                            <td><img src="{{$product->image}}" style="width: 50px;height: 50px"></td>
                                            <td>{{$product->name_ar}}</td>
                                            <td>{{$product->name_en}}</td>
                                            <td>{{$product->name_franco}}</td>
                                            @if($subCategory->subcategories->urgentWash==1)
                                                <td>{{$product->urgentWash=='0'?'لا':'نعم'}}</td>
                                            @endif
                                            <td>{{$product->desc_ar}}</td>
                                            <td>
                                                @if($product->productService->count()>0)
                                                    <a href="{{route('product.productServices',$product->id)}}" class="btn btn-primary "> خدمات</a>
                                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " hidden> اضافه خدمه</a>
                                                @else
                                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " > اضافه خدمه</a>
                                                @endif
                                                <a href="{{route('product.view',$product->id)}}" class="btn btn-info "> التفاصيل</a>
                                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary ">تعديل</a>
                                                <form class="delete" action="{{route('product.destroy',$product->id)}}" method="get" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="حذف" class="edit btn btn-danger btn-sm" >
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
