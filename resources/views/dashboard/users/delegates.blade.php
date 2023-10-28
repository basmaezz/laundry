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
                              <li class="breadcrumb-item"><a href="{{route('delegates.index')}}">المناديب</a>
                            </li>
                            <li class="breadcrumb-item active">المناديب
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{route('delegates.export')}}" class="btn btn-info"  >Export </a>
    <a href="{{route('delegate.create')}}" class="btn btn-primary" >اضافه مندوب</a>
    <a href="{{route('delegate.clearWallet')}}" class="btn btn-danger"  >تصفير جميع المحافظ </a>

    <div class="content-body">
    <main class="main" style="margin-top: 25px">
        <div >
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>الرقم التسلسلى</th>
                                <th>الاسم</th>
                                <th>المدينه</th>
                                <th>الجنسيه</th>
                                <th>نوع التعاقد</th>
                                <th> توصيل سجاد</th>
                                <th>رقم الهويه الوطنيه/الاقامه </th>
                                <th>رقم الجوال   </th>
                                <th> الحاله</th>
                                <th> عدد الطلبات الشهريه</th>
                                <th> المحفظه  </th>
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
                ordering: false,
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
                        data: 'deliverCarpet',
                        name: 'deliverCarpet'
                    }, {
                        data: 'id_number',
                        name: 'id_number'
                    },{
                        data: 'mobile',
                        name: 'mobile'
                    },{
                       data:'status',
                        name:'status'
                    },{
                       data:'monthlyOrders',
                        name:'monthlyOrders'
                    },{
                       data:'wallet',
                        name:'wallet'
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
