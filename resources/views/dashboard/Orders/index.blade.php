@extends('../layouts.app')
@section('content')
    <main class="main">
        @if($errors->any())
            <div class="alert alert-danger">
                <h6>{{$errors->first()}}</h6>
            </div>
        @elseif(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="container-fluid">
            <a href="{{route('coupon.create')}}" class="btn btn-primary">اضافه كوبون</a>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الأقسام
                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
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

                        </div>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </main>



@endsection
