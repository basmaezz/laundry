@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> المغاسل المسجله
                                <a href="{{route('laundries.create')}}" class="btn btn-primary" style="float:left;margin-top: 2px;">اضافه مغسله </a>
                            </div>
                            <div class="card-block">
                                <table id="laundries" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th>الاسم </th>
                                        <th>المدينه </th>
                                        <th>الحى</th>
{{--                                        <th>Status </th>--}}
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subCategories as $subCategory)
                                    <tr>
                                        <td>{{$subCategory->name_ar}}</td>
                                        <td>{{$subCategory->city->name_ar}}</td>
                                        <td>{{$subCategory->address}}</td>
{{--                                        <td>--}}
{{--                                            <input data-id="{{$subCategory->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $subCategory->status ? 'checked' : '' }}>   --}}
{{--                                        </td>--}}
                                            <td>
                                                <a href="{{route('CategoryItems.index',$subCategory->id)}}" class="edit btn btn-primary btn-sm">الأقسام</a>
                                                <a href="{{route('user.edit',$subCategory->id)}}" class="edit btn btn-primary btn-sm">تعديل</a>
                                                <a href="{{route('laundries.view',$subCategory->id)}}" class="edit btn btn-primary btn-sm">التفاصيل</a>
                                                <a href="{{route('laundries.destroy',$subCategory->id)}}" class="edit btn btn-danger btn-sm">حذف</a>
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
{{--        function changeStatus(id){--}}
{{--            // var status_id = $(this).prop('checked') == true ? 1 : 0;--}}
{{--            $.ajax({--}}
{{--                type: "GET",--}}
{{--                dataType: "json",--}}
{{--                url: '/laundryUpdateStats',--}}
{{--                data: { 'id': id},--}}
{{--                success: function(data){--}}
{{--                    console.log(data.success)--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
@endsection
@push('scripts')
    <script>
        $("#laundries").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#laundries_wrapper .col-md-6:eq(0)');
    </script>
@endpush

