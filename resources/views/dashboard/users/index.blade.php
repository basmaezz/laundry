@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div >
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
                    <a href="{{route('user.create')}}" class="btn btn-primary custom" style="float: left; width: 100px; height: 35px " >اضافه أدمن</a>
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
                    },, {
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
