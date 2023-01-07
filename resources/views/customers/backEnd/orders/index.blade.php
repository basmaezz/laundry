@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Orders</h3>
                                <a href="{{route('Customer.Products.create',Auth::user()->subCategory_id)}}"class="btn btn-info" style="float: right">New Item</a>
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
                                        <th>Actions</th>
{{--                                        <th>Delivery Name</th>--}}
{{--                                        <th>Products Count </th>--}}
{{--                                        <th>Delivery Fees </th>--}}
{{--                                        <th>Audio Note </th>--}}
{{--                                        <th>Coupon </th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->user->uuid}}</td>
                                            <td>{{$order->total_price}}</td>
                                            <td>{{$order->status}}</td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->discount}}</td>
                                            <td>{{$order->created_at}}</td>
{{--                                            <td>{{$order->delivery_id}}</td>--}}
{{--                                            <td>{{$order->product_count}}</td>--}}
{{--                                            <td>{{$order->product_fees}}</td>--}}
{{--                                            <td>{{$order->audio_note}}</td>--}}
{{--                                            <td>{{$order->coupon}}</td>--}}
{{--                                            <td>{{$order->discount}}</td>--}}
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="#">Details </a>
                                            </td>
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
