@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
        <div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders InProgress</h3>
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
                                        <th>Finished Date</th>
                                        <th>Actions </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->userTrashed->name}}</td>
                                            <td>{{$order->total_price}}</td>
                                            <td><button class="edit btn btn-primary btn-sm">  completed</button></td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->updated_at}}</td>
                                            <td>
                                                <a href="{{route('Customer.Orders.orderDetails',$order->id)}}" class="edit btn btn-primary btn-sm">Details</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

