@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div>
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">العملاء    </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        <a href="{{route('customers.export')}}" class="btn btn-info" style="float: left; max-height: 35px; max-width:100px" >Export </a>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>الرقم </th>
                                <th>الاسم </th>
                                <th>البريد الألكترونى</th>
                                <th>الجوال</th>
                                <th>المدينه</th>
                                <th>gender </th>
                                <th>المحفظه </th>
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
                ordering: false,
                ajax: "{{ Route('customers.index') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'email',
                    name: 'email'
                }, {
                    data: 'mobile',
                    name: 'mobile'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'gender',
                    name:'gender'
                },{
                    data:'wallet',
                    name:'wallet'
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
            if (confirm("هل تريد اتمام الحذف  ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('customer.delete') }}",
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
