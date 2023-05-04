@extends('../layouts.app')
@section('content')
    <main class="main">
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
                            <th>الرقم</th>
                            <th>الأسم</th>
                            <th>الأسم الأخير</th>
                            <th>البريد الألكترونى</th>
                            <th>الجوال</th>
                            <th>الصلاحيه</th>
                            <th>الأجراءات</th>
                        </tr>
                        </thead>

                    </table>

                </div>
            </div>
        </div>
    </div>
    </main>
{{--    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <form action="{{ Route('dashboard.users.delete') }}" method="POST">--}}
{{--                <div class="modal-content">--}}

{{--                    <div class="modal-body">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group">--}}
{{--                            <p>{{ __('words.sure delete') }}</p>--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="id" id="id">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('words.close') }}</button>--}}
{{--                        <button type="submit" class="btn btn-danger">{{ __('words.delete') }} </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--            <!-- /.modal-content -->--}}
{{--        </div>--}}
{{--        <!-- /.modal-dialog -->--}}
{{--    </div>--}}
@endsection
@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('users.index') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                        data: 'name',
                        name: 'name'
                    },{
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    }, {
                        data: 'phone',
                        name: 'phone'
                    }, {
                        data: 'role',
                        name: 'role'
                    }, {
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
