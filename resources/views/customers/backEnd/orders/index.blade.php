{{--@extends('customers.layouts.dashboard-app')--}}
{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <section class="content">--}}
{{--        <div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Orders</h3>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <div class="card-body">--}}
{{--                                <table id="example1" class="table table-bordered table-striped col-7">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Order Number</th>--}}
{{--                                        <th>Customer Name</th>--}}
{{--                                        <th>Total Price </th>--}}
{{--                                        <th>Status </th>--}}
{{--                                        <th>Discount </th>--}}
{{--                                        <th>note </th>--}}
{{--                                        <th>Date </th>--}}
{{--                                        <th>Actions </th>--}}


{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($orders as $order)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$order->id}}</td>--}}
{{--                                            <td>{{$order->userTrashed->name}}</td>--}}
{{--                                            <td>{{$order->total_price}}</td>--}}
{{--                                            <td>{{$order->status}}</td>--}}
{{--                                            <td>{{$order->discount}}</td>--}}
{{--                                            <td>{{$order->discount}}</td>--}}
{{--                                            <td>{{$order->created_at}}</td>--}}
{{--                                            <td>--}}
{{--                                                <a href="{{route('Customer.Orders.orderDetails',$order->id)}}" class="edit btn btn-primary btn-sm">التفاصيل</a></td>--}}


{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}

{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--@endsection--}}
@extends('customers.layouts.dataTable-app')
@section('content')

    <input type="hidden" id="category_id" name="category_id" value="{{$id}}">
    <section id="multilingual-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{__('lang.products')}}</h4>
                    </div>
                    <div class="card-datatable">
                        <table class="dt-multi table" id="productTable">
                            <thead>
                            <tr>
                                <th>{{__('lang.orderNumber')}}</th>
                                <th>{{__('lang.customerName')}}</th>
                                <th>{{__('lang.totalPrice')}} </th>
                                <th>{{__('lang.status')}} </th>
                                <th>{{__('lang.discount')}} </th>
                                <th>{{__('lang.date')}} </th>
                                <th>{{__('lang.details')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>
    </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(window).on('load', function() {
            var id= document.getElementById('category_id').value;
            $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Customer.Orders.index',$id) }}",
                data:{id:id},


                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'user',
                    name: 'user'
                },{
                    data: 'total_price',
                    name: 'total_price'
                },{
                    data: 'status',
                    name: 'status'
                },{
                    data: 'discount',
                    name: 'discount'
                },{
                    data: 'created_at',
                    name: 'created_at'
                },{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },]
            });
        })
    </script>
@endpush

