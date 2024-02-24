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
    <a href="{{route('carDelegates.create')}}" class="btn btn-primary" >اضافه مندوب</a>

    <div class="content-body">
        <section id="dashboard-analytics">
            <div class="row">
                <div class="col-12">
                    <div class="card invoice-list-wrapper">
                        <div class="card-datatable table-responsive">
                            <table class="productTable table" id="productTable">
                                <thead>
                                <tr>
                                    <th>الرقم التسلسلى</th>
                                    <th>صوره المنطقه </th>
                                    <th>اسم المنطقه </th>
                                    <th>اسم المندوب</th>
                                    <th>رقم الجوال</th>
                                    <th>النسبه </th>
                                    <th> عدد الطلبات الشهريه</th>
                                    <th></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ List DataTable -->
        </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ Route('carDelegates.index') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'subCategoryImage',
                    name: 'subCategoryImage'
                },{
                    data: 'subCategory',
                    name: 'subCategory'
                },{
                    data: 'name',
                    name: 'name'
                },{
                        data: 'mobile',
                        name: 'mobile'
                    },{
                        data: 'percentage',
                        name: 'percentage'
                    },{
                       data:'monthlyOrders',
                        name:'monthlyOrders'
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
