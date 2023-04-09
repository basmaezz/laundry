@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped col-7">
                                    <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Customer Name</th>
                                        <th>Total Price </th>
                                        <th>Status </th>
                                        <th>Discount </th>
                                        <th>note </th>
                                        <th>Date </th>
                                        <th>Actions </th>
{{--                                        <th>Completed</th>--}}

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->user->name}}</td>
                                            <td>{{$order->total_price}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->created_at}}</td>
                                            <td>
                                                <a href="{{route('Customer.Orders.orderDetails')}}" class="edit btn btn-primary btn-sm">التفاصيل</a></td>
{{--                                            <td>--}}
{{--                                                <a href="#" class="btn btn-info">تم الانتهاء</a>--}}
{{--                                            </td>--}}

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
