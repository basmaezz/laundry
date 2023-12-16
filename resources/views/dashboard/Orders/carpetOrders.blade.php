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
                            <li class="breadcrumb-item"><a href="{{route('Order.index')}}">الطلبات</a>
                            </li>
                            <li class="breadcrumb-item active">جدول طلبات السجاد
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="ajax-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">جدول طلبات السجاد</h4>
                        </div>
                        <div class="card-datatable">
                            <table class="table table-striped" id="orderTable">
                                <thead>
                                <tr>
                                    <th>رقم الطلب  </th>
                                    <th>اسم المغسله </th>
                                    <th>رقم العميل </th>
                                    <th>اسم العميل </th>
                                    <th> حاله الطلب   </th>
                                    <th> المده المستغرقه  </th>
                                    <th>  القيمه الاجماليه  </th>
                                    <th>   ربح المغسله  </th>
                                    <th>   ربح التطبيق  </th>
                                    <th>   قيمه التوصيل  </th>
                                    <th>     وقت الاستلام  </th>
                                    <th>     تاريخ الاستلام  </th>
                                    <th>     وقت التسليم  </th>
                                    <th>     تاريخ التسليم  </th>
                                    <th>تاريخ الطلب </th>
                                    <th>التفاصيل</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                ajax: "{{ Route('Order.carpetOrders') }}",
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
                    data:'status',
                    name:'status'
                },{
                    data:'finished',
                    name:'finished'
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
                    data:'delivery',
                    name:'delivery'
                },{
                    data:'ReceiveTime',
                    name:'createdAt'
                },{
                    data:'receive_date',
                    name:'receive_date'
                },{
                    data:'DeliveryTime',
                    name:'DeliveryTime'
                },{
                    data:'delivery_date',
                    name:'delivery_date'
                },{
                    data:'createdAt',
                    name:'createdAt'
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
