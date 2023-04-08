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
                                <a href="#" class="btn btn-primary" style="float:left;margin-top: 2px;">بحث متقدم  </a>
                            </div>
                            <div class="card-block">
                                <table id="orders" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب</th>
                                        <th>اسم المغسله</th>
                                        <th>اسم العميل</th>
                                        <th>اسم المندوب</th>
                                        <th>المده المستغرقه </th>
                                        <th> عدد القطع</th>
                                        <th> السعر </th>
                                        <th> الخصم </th>
{{--                                        <th> الكوبون </th>--}}
{{--                                        <th> نوع التوصيل </th>--}}
                                        <th> رسوم التوصيل </th>
                                        <th>  طريقه الدفع </th>
                                        <th>   الضريبه </th>
                                        <th>   تاريخ الوصول للمغسله </th>
                                        <th>  تاريخ الانتهاء  </th>
                                        <th>  التفاصيل  </th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->subCategories->name_ar}}</td>
                                            <td>{{$order->user->name}}</td>
                                            <td>{{$order->delivery_id ??''}}</td>
                                            <td>{{minutesToHumanReadable($order->histories->where('status_id',$order->status_id)->first()->spend_time ?? 0)}}</td>
                                            <td>{{$order->count_products}}</td>
                                            <td>{{$order->total_price}}</td>
                                            <td>{{$order->discount_value}}</td>
{{--                                            <td>{{$order->coupon ?? ''}}</td>--}}
{{--                                            @if($order->delivery_type !=null)--}}
{{--                                            <td>{{$order->delivery_type=='1'?'استلام بواسطه العميل' :'استلام بواسطه المندوب'}}</td>--}}
{{--                                            @else--}}
{{--                                            <td></td>--}}
{{--                                            @endif--}}
                                            <td>{{$order->delivery_fees}}</td>
                                            <td>{{$order->payment_method}}</td>
                                            <td>{{$order->vat}}</td>
                                            <td>{{$order->created_at->format('d/m/Y')}}</td>
                                            <td>{{$order->updated_at->format('d/m/Y')}}</td>
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

@endsection
@push('scripts')
    <script>
        $("#orders").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#orders_wrapper .col-md-6:eq(0)');
    </script>
@endpush
