@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الطلبات المنتهيه
                            </div>
                            <div class="card-block">
                                <table id="ordersPickUp" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب</th>
                                        <th>اسم المغسله</th>
                                        <th>اسم العميل</th>
                                        <th>اسم المندوب</th>
                                        <th> المده المستغرقه</th>
{{--                                        <th> عدد القطع</th>--}}
{{--                                        <th> السعر </th>--}}
{{--                                        <th> الخصم </th>--}}
{{--                                        <th> الكوبون </th>--}}
{{--                                        <th> رسوم التوصيل </th>--}}
{{--                                        <th>  طريقه الدفع </th>--}}
{{--                                        <th>   الضريبه </th>--}}
{{--                                        <th>   العنوان </th>--}}
                                        <th>   تاريخ الوصول للمغسله </th>
                                        <th>  تاريخ الانتهاء  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->subCategories->name_ar}}</td>
                                            <td>{{$order->user->name}}</td>
                                            <td>{{$order->delegate->appUser->name ??''}}</td>
                                            <td>{{minutesToHumanReadable($order->histories->where('status_id',$order->status_id)->first()->spend_time ?? 0)}}</td>
{{--                                            <td>{{$order->count_products}}</td>--}}
{{--                                            <td>{{$order->total_price}}</td>--}}
{{--                                            <td>{{$order->discount_value}}</td>--}}
{{--                                            <td>{{$order->coupon ?? ''}}</td>--}}
{{--                                            <td>{{$order->delivery_fees}}</td>--}}
{{--                                            <td>{{$order->payment_method}}</td>--}}
{{--                                            <td>{{$order->vat}}</td>--}}
{{--                                            <td>{{$order->address->address}}</td>--}}
                                            <td>{{$order->created_at->format('d/m/Y')}}</td>
                                            <td>{{$order->updated_at->format('d/m/Y')}}</td>
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
        $("#ordersPickUp").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#ordersPickUp_wrapper .col-md-6:eq(0)');
    </script>
@endpush
