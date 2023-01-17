@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الطلبات
                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
{{--                                        <th>Order Number</th>--}}
                                        <th>رقم العميل </th>
                                        <th>السعر </th>
                                        <th>الخصم </th>
                                        <th>التاريخ </th>
                                        <th>الحاله </th>
                                        <th>Completed</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
{{--                                            <td>{{$order->id}}</td>--}}
                                            <td>{{$order->user->uuid}}</td>
                                            <td>{{$order->total_price}}</td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->created_at}}</td>
                                            {{--                                            <td>{{$order->delivery_id}}</td>--}}
                                            {{--                                            <td>{{$order->product_count}}</td>--}}
                                            {{--                                            <td>{{$order->product_fees}}</td>--}}
                                            {{--                                            <td>{{$order->audio_note}}</td>--}}
                                            {{--                                            <td>{{$order->coupon}}</td>--}}
                                            {{--                                            <td>{{$order->discount}}</td>--}}
                                            <td>
{{--                                                <label class="switch switch-text switch-success">--}}
{{--                                                    <input type="checkbox" class="switch-input"  checked onclick="changeStatus()">--}}
{{--                                                    <span class="switch-label" data-on="On" data-off="Off"></span>--}}
{{--                                                    <span class="switch-handle"></span>--}}
{{--                                                </label>--}}
                                                <input data-id="{{$order->id}}" class="toggle-class" type="checkbox"
                                                       data-onstyle="success" data-offstyle="No" data-toggle="toggle" data-on="YES"
                                                       data-off="InActive" {{ $order->status_id ? 'checked' : '' }}>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="#">Details </a>
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

    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status_id = $(this).prop('checked') == true ? 1 : 0;
                var order_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data: {'status_id': status_id, 'id': order_id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endsection
