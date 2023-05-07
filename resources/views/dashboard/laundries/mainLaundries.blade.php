{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--        <nav aria-label="breadcrumb" class="navBreadCrumb">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">المغاسل  </li>--}}
{{--            </ol>--}}
{{--        </nav>--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <i class="fa fa-align-justify"></i> المغاسل المسجله--}}
{{--                                <a href="{{route('laundries.create')}}" class="btn btn-primary" style="float:left;margin-top: 2px;">اضافه مغسله </a>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table id="laundries" class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th> الصوره </th>--}}
{{--                                            <th>اسم المغسله </th>--}}
{{--                                            <th>الفرع الرئيسى </th>--}}
{{--                                            <th>المدينه </th>--}}
{{--                                            <th>الحى</th>--}}
{{--                                            <th>ساعات العمل</th>--}}
{{--                                            <th>Actions </th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($subCategories as $subCategory)--}}
{{--                                    <tr>--}}
{{--                                        @if($subCategory->parent_id !=null)--}}
{{--                                        <td><img src="{{$subCategory->parentTrashed->image}}" style="width:50px;height:50px"></td>--}}
{{--                                        @else--}}
{{--                                        <td><img src="{{$subCategory->image}}" style="width:50px;height:50px"></td>--}}
{{--                                        @endif--}}
{{--                                        <td>{{$subCategory->name_ar}}</td>--}}
{{--                                        <td>{{$subCategory->parentTrashed->name_ar??''}}</td>--}}
{{--                                        <td>{{$subCategory->city->name_ar??''}}</td>--}}
{{--                                        <td>{{ Str::limit($subCategory->address, 20) }}</td>--}}
{{--                                        @if($subCategory->around_clock ==1)--}}
{{--                                        <td> طوال اليوم</td>--}}
{{--                                        @else--}}

{{--                                            <td>{{abs($hours=((int)$subCategory->clock_end)-((int)$subCategory->clock_at))}}  ساعة </td>--}}
{{--                                        @endif--}}
{{--                                            <td>--}}
{{--                                                @if($subCategory->parent_id==Null)--}}
{{--                                                <a href="{{route('laundries.branches',$subCategory->id)}}" class="edit btn btn-primary btn-sm">الفروع</a>--}}
{{--                                                @endif--}}
{{--                                                <a href="{{route('CategoryItems.index',$subCategory->id)}}" class="edit btn btn-primary btn-sm">الأقسام</a>--}}
{{--                                                <a href="{{route('laundries.edit',$subCategory->id)}}" class="edit btn btn-primary btn-sm">تعديل</a>--}}
{{--                                                <a href="{{route('laundries.view',$subCategory->id)}}" class="edit btn btn-primary btn-sm">التفاصيل</a>--}}
{{--                                                <a href="{{route('laundries.orders',$subCategory->id)}}" class="edit btn btn-primary btn-sm">الطلبات</a>--}}
{{--                                                    <form class="delete" action="{{route('laundries.destroy',$subCategory->id)}}" method="get" >--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <input type="submit" value="حذف" class="edit btn btn-danger btn-sm" style="display: inline">--}}
{{--                                                    </form>--}}
{{--                                                <a href="{{route('laundries.destroy',$subCategory->id)}}" class="edit btn btn-danger btn-sm " onclick="delConfirm()" >حذف</a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
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
{{--        $("#laundries").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#laundries_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        function delConfirm(){--}}
{{--            return confirm("هل أنت متأكد من حذف المغسله ؟");--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}

@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الأدمن   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        <a href="{{route('user.create')}}" class="btn btn-primary" style="float: left" >اضافه أدمن</a>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>  الصورة </th>
                                <th>اسم المغسله </th>
                                <th>المدينه </th>
                                <th>الحى</th>
                                <th>ساعات العمل</th>
                                <th>الاجراءات </th>
                            </tr>
                            </thead>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('laundries.mainLaundries') }}",
                columns: [{
                    data: 'image',
                    name: 'image'
                },{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'address',
                    name:'address'
                },{
                    data:'around_clock',
                    name:'around_clock'
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
            // $('#myModal').modal('show');
            if (confirm("هل تريد اتمام الحذف ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('laundries.destroy') }}",
                    data: { id: id},
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#datatable-crud').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
