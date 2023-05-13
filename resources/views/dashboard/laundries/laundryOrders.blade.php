{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--        <nav aria-label="breadcrumb" class="navBreadCrumb">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>--}}
{{--                <li class="breadcrumb-item"><a href="{{route('laundries.index')}}">المغاسل</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">الطلبات   </li>--}}
{{--            </ol>--}}
{{--        </nav>--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-9">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <i class="fa fa-align-justify"> عرض طلبات المغسله</i>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table id="orders" class="table table-bordered table-striped">--}}
{{--                                    <thead >--}}
{{--                                    <tr>--}}

{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($orders as $order)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$order->id}}</td>--}}
{{--                                            <td>{{$order->userTrashed->name}} </td>.--}}
{{--                                            <td>{{$order->delegateTrashed->appUserTrashed->name ??''}} </td>--}}
{{--                                            <td>{{$order->status}}</td>--}}
{{--                                            <td>{{$order->total_price}}</td>--}}
{{--                                            <td>{{$this->subCategoriesTrashed->total_price *$this->subCategoriesTrashed->percentage/100}}</td>--}}
{{--                                            <td>{{$order->created_at->format('Y-m-d')}}</td>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{route('Order.show',$order->id)}}" class="btn btn-info">التفاصيل</a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        </div>--}}
{{--    </main>--}}

{{--@endsection--}}
{{--@push('scripts')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>--}}
{{--    <script>--}}
{{--        $("#orders").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#orders_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}

{{--@endpush--}}

@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">المغاسل   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        <a href="{{route('laundries.create')}}" class="btn btn-primary" style="float: left" >اضافه مغسله</a>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <input type="hidden" value="{{$id}}" id="laundry_id">
                            <tr>
                                <th>رقم الطلب  </th>
                                <th>اسم العميل</th>
                                <th>اسم المندوب</th>
                                <th>حاله الطلب</th>
                                <th> المبلغ الاجمالى</th>
                                <th>المبلغ المستحق </th>
                                <th>التاريخ</th>
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
            var id= document.getElementById('laundry_id').value;

            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('laundries.orders',$id) }}",
                data: { id: id},
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'userTrashed',
                    name: 'userTrashed'
                },{
                    data: 'delegateTrashed',
                    name: 'delegateTrashed'
                },{
                    data:'status',
                    name:'status'
                },{
                    data:'total_price',
                    name:'total_price'
                },{
                    data:'percentage',
                    name:'percentage'
                },{
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },

                ]
            });
        });
    </script>

@endpush
