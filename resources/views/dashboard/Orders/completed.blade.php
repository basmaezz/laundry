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
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>رقم الطلب  </th>
                                <th>رقم المغسله </th>
                                <th>اسم المغسله </th>
                                <th>اسم العميل </th>
                                <th>  اسم المندوب  </th>
                                <th>   نوع التوصيل   </th>
                                <th>المدينه </th>
                                <th>السنه </th>
                                <th>الشهر </th>
                                <th>اليوم </th>
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
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ Route('Order.completed') }}",
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
                    data:'delegate',
                    name:'delegate'
                },{
                    data:'deliveryType',
                    name:'deliveryType'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'year',
                    name:'year'
                },{
                    data:'month',
                    name:'month'
                },{
                    data:'day',
                    name:'day'
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
