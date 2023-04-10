@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الطلبات
{{--                                <a href="#" class="btn btn-primary" style="float:left;margin-top: 2px;">بحث متقدم  </a>--}}
                            </div>
                            <div class="card-block">
                                <table id="orders" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>رقم الطلب  </th>
                                        <th>اسم المغسله </th>
                                        <th>اسم العميل </th>
                                        <th> نوع التوصيل </th>
                                        <th> المده المستغرقه  </th>
                                        <th>المدينه </th>
                                        <th>الحى </th>
                                        <th>السنه </th>
                                        <th>الشهر </th>
                                        <th>اليوم </th>
                                        <th>التفاصيل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->subCategoriesTrashed->name_ar}}</td>
                                            <td>{{$order->userTrashed->name}}</td>
                                            @if($order->delivery_type !=null)
                                            <td>{{$order->delivery_type=='1'?'استلام بواسطه العميل' :'استلام بواسطه المندوب'}}</td>
                                            @else
                                            <td></td>
                                            @endif
                                            <td>{{minutesToHumanReadable($order->histories->where('status_id',$order->status_id)->first()->spend_time ?? 0)}}</td>
                                            <td>{{$order->userTrashed->citiesTrashed->name_ar}}</td>
                                            <td>{{$order->userTrashed->region_name}}</td>
                                            <td>{{$order->created_at->year}}</td>
                                            <td>{{$order->created_at->month}}</td>
                                            <td>{{$order->created_at->day}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{route('Order.show',$order->id)}}">التفاصيل </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>

{{--    <script>--}}
{{--        $(function() {--}}
{{--            $('.toggle-class').change(function() {--}}
{{--                var status_id = $(this).prop('checked') == true ? 1 : 0;--}}
{{--                var order_id = $(this).data('id');--}}
{{--                $.ajax({--}}
{{--                    type: "GET",--}}
{{--                    dataType: "json",--}}
{{--                    url: '/changeStatus',--}}
{{--                    data: {'status_id': status_id, 'id': order_id},--}}
{{--                    success: function(data){--}}
{{--                        console.log(data.success)--}}
{{--                    }--}}
{{--                });--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
@endsection
@push('scripts')
    <script>
        $("#orders").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#orders_wrapper .col-md-6:eq(0)');
    </script>
@endpush
