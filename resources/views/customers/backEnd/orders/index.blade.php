@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
        <div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped col-7">
                                    <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Customer Name</th>
                                        <th>Total Price </th>
                                        <th>Status </th>
                                        <th>Discount </th>
                                        <th>Date </th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->userTrashed->name}}</td>
                                            <td>{{$order->total_price}}</td>
                                            @if($order->status=='ملغى')
                                                <td><button class="edit btn btn-danger btn-sm">  Cancelled</button></td>
                                            @elseif($order->status=='تم الأنتهاء من الغسيل')
                                                <td><button class="edit btn btn-primary btn-sm">  Finished</button></td>
                                            @elseif($order->status=='Waiting for delivery')
                                                <td><button class="edit btn btn-warning btn-sm">  Waiting for delivery</button></td>
                                            @elseif($order->status=='في انتظار المندوب لاستلام الملابس')
                                                <td><button class="edit btn btn-warning btn-sm">  Waiting for delivery</button></td>
                                            @elseif($order->status=='شكرا لتعاملك معنا وملبوس العافية')
                                                <td><button class="edit btn btn-primary btn-sm">  Completed</button></td>
                                            @endif
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>
                                                <a href="{{route('Customer.Orders.orderDetails',$order->id)}}" class="edit btn btn-primary btn-sm">Details</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
