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
                        <a href="{{route('delegates.export')}}" class="btn btn-info custom" style="float: left; width: 100px; height: 35px " >Export </a>
                        <a href="{{route('delegate.create')}}" class="btn btn-primary custom" style="float: left; width: 100px; height: 35px " >اضافه مندوب</a>
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
                                <th> عدد الطلبات الشهريه</th>
                                <th>تاريخ الالتحاق </th>
                                <th>الاجراءات</th>
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
                ajax: "{{ Route('delegates.index') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'city',
                    name: 'city'
                },
                    {
                        data: 'nationality',
                        name: 'nationality'
                    }, {
                        data: 'request_employment',
                        name: 'request_employment'
                    }, {
                        data: 'id_number',
                        name: 'id_number'
                    },{
                       data:'status',
                        name:'status'
                    },{
                       data:'status',
                        name:'status'
                    },{
                      data:'created_at',
                        name:'created_at'
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
            if (confirm("هل تريد اتمام الحذف ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('delete.delegate') }}",
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
