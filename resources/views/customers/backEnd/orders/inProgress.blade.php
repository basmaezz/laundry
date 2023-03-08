@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
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
                                        <th>note </th>
                                        <th>Date </th>
                                        <th>Completed</th>

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
                                            <td>

                                                <input data-id="{{$order->id}}" class="toggleBtn" type="checkbox"
                                                       data-onstyle="danger" data-offstyle="success" data-toggle="toggle"  data-off="Completed"  data-on="InProgress"
                                                      {{ $order->status_id ? 'checked' : '' }}>
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
<script>
    let toggleBtn = document.getElementsByClassName("toggleBtn");
    console.log(toggleBtn);
    // btn.addEventListener("change", changeStatus)
    // function changeStatus() {
    //    console.log(this)
    // }

    // $(function() {
    //
    //     $('.toggle-class').change(function() {
    //         alert('test');
    //         var status_id = $(this).prop('checked') == true ? 5 : 4;
    //         console.log(status_id);
    //         var order_id = $(this).data('id');
    //         console.log(order_id);
    //         $.ajax({
    //
    //             type: "GET",
    //             dataType: "json",
    //             url: '/changeStatus',
    //             data: {'status_id': status_id, 'id': order_id},
    //             success: function(data){
    //                 console.log(data.success)
    //             }
    //         });
    //     })
    // })
</script>
