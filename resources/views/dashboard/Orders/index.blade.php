@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div>
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الطلبات   </li>
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
                                <th>رقم الطلب  </th>
                                <th>اسم المغسله </th>
                                <th>اسم العميل </th>
                                <th> نوع التوصيل </th>
                                <th> حاله الطلب   </th>
                                <th> المده المستغرقه  </th>
                                <th>  القيمه الاجماليه  </th>
                                <th>   ربح المغسله  </th>
                                <th>   ربح التطبيق  </th>
                                <th>    العموله  </th>
                                <th>    قيمه التوصيل  </th>
                                <th>المدينه </th>
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
@push('javascripts')
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.js')}}"></script>
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.ar.min.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('Order.index') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'category',
                    name: 'category'
                },{
                    data: 'user',
                    name: 'user'
                },{
                    data:'deliveryType',
                    name:'deliveryType'
                },{
                    data:'orderStatus',
                    name:'orderStatus'
                },{
                    data:'deliveryType',
                    name:'deliveryType'
                },{
                    data:'deliveryType',
                    name:'deliveryType'
                },{
                    data:'deliveryType',
                    name:'deliveryType'
                },{
                    data:'deliveryType',
                    name:'deliveryType'
                },{
                    data:'finished',
                    name:'finished'
                },{
                    data:'total_price',
                    name:'total_price'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'regionName',
                    name:'regionName'
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
            $("#table_id").on('draw.dt', function(){ jQuery("time.timeago").timeago(); });
        });
    </script>
@endpush
