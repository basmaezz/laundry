@extends('layouts.dataTable-app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div>
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الطلبات المنتهيه   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>

                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="orderTable">
                            <thead>
                            <tr>

                                <th>رقم الطلب  </th>
                                <th>اسم المغسله </th>
                                <th>رقم العميل </th>
                                <th>اسم العميل </th>
                                <th>رقم المندوب </th>
                                <th>اسم المندوب </th>
                                <th> نوع الطلب   </th>
                                <th> المده المستغرقه  </th>
                                <th>  القيمه الاجماليه  </th>
                                <th>   ربح المغسله  </th>
                                <th>   ربح التطبيق  </th>
                                <th>    العموله  </th>
                                <th>    قيمه التوصيل  </th>
                                <th>  المدينه </th>
                                <th>الحى </th>
                                <th>تاريخ الطلب </th>
                                <th>التفاصيل</th>
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
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.js')}}"></script>
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.ar.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#orderTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ Route('Order.DeliveryOnWay') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'category',
                    name: 'category'
                },{
                    data: 'user_id',
                    name: 'user_id'
                },{
                    data: 'user',
                    name: 'user'
                },{
                    data:'delegate_id',
                    name:'delegate_id'
                },{
                    data:'delegate',
                    name:'delegate'
                },{
                    data: 'orderType',
                    name: 'orderType'
                },{
                    data:'duration',
                    name:'duration'
                },{
                    data:'total_price',
                    name:'total_price'
                },{
                    data:'laundryProfit',
                    name:'laundryProfit'
                },{
                    data:'appProfit',
                    name:'appProfit'
                },{
                    data:'commission',
                    name:'commission'
                },{
                    data:'delivery',
                    name:'delivery'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'regionName',
                    name:'regionName'
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
            $("#orderTable").on('draw.dt', function(){ jQuery("time.timeago").timeago(); });

        });
        $('body').on('click', '#deleteBtn', function () {
            if (confirm("هل تريد اتمام الالغاء ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('Order.cancelOrder') }}",
                    data: { id: id},
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#orderTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>
@endpush
