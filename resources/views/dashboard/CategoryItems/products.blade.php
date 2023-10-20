

{{--                                    @foreach($products as $product)--}}
{{--                                        <tr>--}}
{{--                                            <td><img src="{{$product->image}}" style="width: 50px;height: 50px"></td>--}}
{{--                                            <td>{{$product->name_ar}}</td>--}}
{{--                                            <td>{{$product->name_en}}</td>--}}
{{--                                            <td>{{$product->name_franco}}</td>--}}
{{--                                            @if($subCategory->subcategories->urgentWash==1)--}}
{{--                                                <td>{{$product->urgentWash=='0'?'لا':'نعم'}}</td>--}}
{{--                                            @endif--}}
{{--                                            <td>{{$product->desc_ar}}</td>--}}
{{--                                            <td>--}}
{{--                                                @if($product->productService->count()>0)--}}
{{--                                                    <a href="{{route('product.productServices',$product->id)}}" class="btn btn-primary "> خدمات</a>--}}
{{--                                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " hidden> اضافه خدمه</a>--}}
{{--                                                @else--}}
{{--                                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary " > اضافه خدمه</a>--}}
{{--                                                @endif--}}
{{--                                                <a href="{{route('product.view',$product->id)}}" class="btn btn-info "> التفاصيل</a>--}}
{{--                                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary ">تعديل</a>--}}
{{--                                                <form class="delete" action="{{route('product.destroy',$product->id)}}" method="get" >--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <input type="submit" value="حذف" class="edit btn btn-danger btn-sm" >--}}
{{--                                                </form>--}}

{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}

{{--                                </table>--}}

{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--@endsection--}}
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $("#products").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#products_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(".delete").on("submit", function(){--}}
{{--            return confirm("هل أنت متأكد من الحذف ؟");--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
@extends('layouts.dataTable-app')
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
                            <li class="breadcrumb-item"><a href="{{route('laundries.index')}}">المغاسل</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('CategoryItems.index',$subCategory->subcategory_id)}}">الأقسام</a>
                            </li>
                            <li class="breadcrumb-item active">القطع
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">

        <section id="multilingual-datatable">

            <div class="row">
                <div class="col-10">
                    <div class="card invoice-list-wrapper">
{{--                        <a href="{{route('car.create')}}" class="btn btn-primary" style="width: 130px" >اضافه سياره</a>--}}
                        <a href="{{route('product.create',$id)}}" class="btn btn-primary custom" style="float: left; max-height: 35px; max-width:100px">اضافه قطعه</a>


                        <div class="card-datatable table-responsive">
                            <table class="productTable table" id="productsTable">
                                <input type="hidden" name="laundry_id" id="laundry_id"value="{{$id}}">
                                <thead>
                                <tr>
                                    <th> الصوره</th>
                                    <th> اسم القطعه (AR)</th>
                                    <th> اسم القطعه (EN)</th>
                                    <th> اسم القطعه (Franco)</th>

                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Multilingual -->

    </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var id= document.getElementById('laundry_id').value;
            $('#productsTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('CategoryItems.show',$id) }}",
                data: { id: id},
                columns: [{
                    data: 'image',
                    name: 'image'
                },{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data: 'name_en',
                    name: 'name_en'
                },{
                    data: 'name_franco',
                    name: 'name_franco'
                },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        });
        $('body').on('click', '#deleteBtn', function () {
            if (confirm("هل تريد اتمام الحذف ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('product.destroy',$id) }}",
                    data: { id: id},
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#productsTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
{{--@push('scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function(){--}}

{{--            $('#productsTable').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ordering:false,--}}
{{--                ajax: "{{ route('CategoryItems.show',$id) }}",--}}

{{--                columns: [{--}}
{{--                    data: 'image',--}}
{{--                    name: 'image'--}}
{{--                }{--}}
{{--                    data: 'name_ar',--}}
{{--                    name: 'name_ar'--}}
{{--                },{--}}
{{--                    data: 'name_en',--}}
{{--                    name: 'name_en'--}}
{{--                }, {--}}
{{--                    data: 'action',--}}
{{--                    name: 'action',--}}
{{--                    orderable: false,--}}
{{--                    searchable: false--}}
{{--                },--}}

{{--                ]--}}
{{--            });--}}
{{--        });--}}
{{--        $('body').on('click', '#deleteBtn', function () {--}}
{{--            if (confirm("هل تريد اتمام الحذف ؟") == true) {--}}
{{--                var id = $(this).data('id');--}}
{{--                window.location.reload();--}}
{{--                $.ajax({--}}
{{--                    type:"get",--}}
{{--                    url: "{{ route('car.destroy') }}",--}}
{{--                    dataType: 'json',--}}
{{--                    data: { id: id},--}}
{{--                    success: function(res){--}}
{{--                        var oTable = $('#productsTable').dataTable();--}}
{{--                        oTable.fnDraw(false);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

{{--@endpush--}}
