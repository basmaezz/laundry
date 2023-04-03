@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
{{--            <a href="{{route('CategoryItems.create',$subCategory->id)}}" class="btn btn-primary" style="margin-bottom: 20px">اضافه قسم</a>--}}
            @if($categoryItems->count()>0)
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الأقسام
                            </div>
                            <div class="card-block">
                                <table id="laundries" class="table table-bordered table-striped">
                                    <thead >
                                    <tr>
                                        <th>اسم المغسله </th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categoryItems as $categoryItem)
                                        <tr>
                                            <td>{{$categoryItem->category_type}} </td>
                                            <td>
                                                <a href="{{route('product.create',$categoryItem->id)}}" class="btn btn-primary">اضافه قطعه</a>
                                                <a href="{{route('CategoryItems.show',$categoryItem->id)}}" class="btn btn-info">عرض  القطع </a>

                                                <a href="{{route('CategoryItems.edit',$categoryItem->id)}}" class="btn btn-primary">تعديل</a>

                                                <form class="delete" action="{{route('CategoryItems.destroy',$categoryItem->id)}}" method="get">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="حذف" class="edit btn btn-danger btn-sm">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
{{--                                <table class="table table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>اسم القسم</th>--}}
{{--                                      <th>الاجراءات</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($categoryItems as $categoryItem)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$categoryItem->category_type}} </td>--}}
{{--                                            <td>--}}

{{--                                            </td>--}}
{{--                                        </tr>--}}

{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}

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
        $("#laundries").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#delegates_wrapper .col-md-6:eq(0)');
    </script>
    <script>
        $(".delete").on("submit", function(){
            return confirm("هل أنت متأكد من الحذف  ؟");
        });
    </script>
@endpush
