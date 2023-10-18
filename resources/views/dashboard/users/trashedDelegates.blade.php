{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--        <nav aria-label="breadcrumb" class="navBreadCrumb">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">المناديب المحذوفه  </li>--}}
{{--            </ol>--}}
{{--        </nav>--}}
{{--    <div>--}}

{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <i class="fa fa-align-justify"></i>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table id="delegates" class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>الرقم التسلسلى</th>--}}
{{--                                        <th>الاسم</th>--}}
{{--                                        <th>المدينه</th>--}}
{{--                                        <th>الجنسيه</th>--}}
{{--                                        <th>نوع التعاقد</th>--}}
{{--                                        <th>رقم الهويه الوطنيه/الاقامه </th>--}}
{{--                                        <th> الحاله</th>--}}
{{--                                        <th>تاريخ الالتحاق </th>--}}
{{--                                        <th></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($delegates as $delegate)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$delegate->id}}</td>--}}
{{--                                            <td>{{$delegate->appUserTrashed->name ??''}}</td>--}}
{{--                                            <td>{{$delegate->appUserTrashed->citiesTrashed->name_ar ??''}}</td>--}}
{{--                                            <td>{{$delegate->nationality->name_ar ?? ''}}</td>--}}
{{--                                            <td>{{$delegate->request_employment==0 ?'موظف':'عامل حر'}}</td>--}}
{{--                                            <td>{{$delegate->id_number}}</td>--}}
{{--                                            <td>{{$delegate->appUserTrashed->status ??''}}</td>--}}
{{--                                            <td>{{$delegate->created_at->format('Y-M-D') ??''}}</td>--}}

{{--                                            <td>--}}


{{--                                                <a href="{{route('Order.delegateOrders',$delegate->id)}}" class="btn btn-info">الطلبات</a>--}}
{{--                                                <a href="{{route('delegate.show',$delegate->id)}}" class="btn btn-info">تفاصيل</a>--}}
{{--                                                --}}{{----}}{{--                                            <a href="{{route('delegate.delete',$delegate->id)}}" class="btn btn-danger">حذف</a>--}}
{{--                                                <form class="delete" action="{{route('delegate.restoreDeletedDelegates',$delegate->id)}}" method="get">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <input type="submit" value="استعاده الحذف" class="edit btn btn-danger btn-sm">--}}
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
{{--    <script type="text/javascript">--}}
{{--        $(function() {--}}
{{--            var table = $('#table_id').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--                ajax: "{{ Route('users.index') }}",--}}
{{--                columns: [{--}}
{{--                    data: 'id',--}}
{{--                    name: 'id'--}}
{{--                },{--}}
{{--                    data: 'name',--}}
{{--                    name: 'name'--}}
{{--                },{--}}
{{--                    data: 'last_name',--}}
{{--                    name: 'last_name'--}}
{{--                },--}}
{{--                    {--}}
{{--                        data: 'email',--}}
{{--                        name: 'email'--}}
{{--                    }, {--}}
{{--                        data: 'phone',--}}
{{--                        name: 'phone'--}}
{{--                    }, {--}}
{{--                        data: 'role',--}}
{{--                        name: 'role'--}}
{{--                    }, {--}}
{{--                        data: 'action',--}}
{{--                        name: 'action',--}}
{{--                        orderable: false,--}}
{{--                        searchable: false--}}
{{--                    },--}}

{{--                ]--}}
{{--            });--}}
{{--        });--}}
{{--        $('body').on('click', '#deleteBtn', function () {--}}
{{--            $('#myModal').modal('show');--}}
{{--            if (confirm("هل تريد اتمام الحذف النهائى ؟") == true) {--}}
{{--                var id = $(this).data('id');--}}
{{--                window.location.reload();--}}
{{--                $.ajax({--}}
{{--                    type:"get",--}}
{{--                    url: "{{ route('user.delete') }}",--}}
{{--                    data: { id: id},--}}
{{--                    dataType: 'json',--}}
{{--                    success: function(res){--}}
{{--                        var oTable = $('#datatable-crud').dataTable();--}}
{{--                        oTable.fnDraw(false);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}

{{--@endpush--}}
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $("#delegates").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#delegates_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(".delete").on("submit", function(){--}}
{{--            return confirm("هل أنت متأكد من استعاده الحذف  ؟");--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}

{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--      <nav aria-label="breadcrumb" class="navBreadCrumb">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">المناديب   </li>--}}
{{--            </ol>--}}
{{--        </nav>--}}
{{--    <div>--}}

{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <i class="fa fa-align-justify"></i>--}}


{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table id="delegates" class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}

{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($delegates as $delegate)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$delegate->id}}</td>--}}
{{--                                        <td><img src="{{asset('images/'.$delegate->appUserTrashed->avatar)}}" style="width: 100px;height:100px"></td>--}}
{{--                                        <td>{{$delegate->appUserTrashed->name ??''}}</td>--}}
{{--                                        <td>{{$delegate->appUserTrashed->citiesTrashed->name_ar ??''}}</td>--}}
{{--                                        <td>{{$delegate->nationality->name_ar ?? ''}}</td>--}}
{{--                                        <td>{{$delegate->request_employment==0 ?'موظف':'عامل حر'}}</td>--}}
{{--                                        <td>{{$delegate->id_number}}</td>--}}
{{--                                        <td>{{$delegate->appUserTrashed->status ??''}}</td>--}}
{{--                                        <td>{{$delegate->created_at->format('Y-M-D') ??''}}</td>--}}

{{--                                        <td>--}}
{{--                                            @if(isset($delegate->appUserTrashed))--}}
{{--                                            @if($delegate->appUserTrashed->status=='active')--}}
{{--                                            <a href="{{route('delegate.changeDelegateStatus',$delegate->id)}}" class="btn btn-danger">ايقاف</a>--}}
{{--                                            @elseif($delegate->appUserTrashed->status=='deactivated')--}}
{{--                                            <a href="{{route('delegate.changeDelegateStatus',$delegate->id)}}" class="btn btn-info">تفعيل</a>--}}
{{--                                            @endif--}}
{{--                                            @endif--}}
{{--                                            <a href="{{route('delegate.edit',$delegate->id)}}" class="btn btn-info">تعديل</a>--}}
{{--                                            <a href="{{route('Order.delegateOrders',$delegate->id)}}" class="btn btn-info">الطلبات</a>--}}
{{--                                            <a href="{{route('delegate.show',$delegate->id)}}" class="btn btn-info">تفاصيل</a>--}}
{{--                                            <a href="{{route('delegate.delete',$delegate->id)}}" class="btn btn-danger">حذف</a>--}}
{{--                                                <form class="delete" action="{{route('delegate.delete',$delegate->id)}}" method="get">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <input type="submit" value="حذف" class="edit btn btn-danger btn-sm">--}}
{{--                                                </form>--}}
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
{{--        $("#delegates").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#delegates_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(".delete").on("submit", function(){--}}
{{--            return confirm("هل أنت متأكد من الحذف  ؟");--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div>
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">المناديب    </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>الرقم التسلسلى</th>
                                <th>الاسم</th>
                                <th>المدينه</th>
                                <th>الجنسيه</th>
                                <th>نوع التعاقد</th>
                                <th>رقم الهويه الوطنيه/الاقامه </th>
                                <th> الحاله</th>
                                <th>تاريخ الالتحاق </th>
                                <th></th>
                            </tr>
                            </thead>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('delegate.trashedDelegates') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'city',
                    name: 'city'
                },{
                    data: 'nationality',
                    name: 'nationality'
                },{
                    data:'request_employment',
                    name:'request_employment'
                },{
                    data: 'id_number',
                    name:'id_number'
                }, {
                    data: 'status',
                    name: 'status'
                },{
                    data:'created_at',
                    name:'created_at'
                },{
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
                    url: "{{ route('user.delete') }}",
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
