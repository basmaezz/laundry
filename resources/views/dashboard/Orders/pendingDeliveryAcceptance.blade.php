@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الطلبات المنتهيه
                            </div>
                            <div class="card-block">
                                <table id="ordersPickUp" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>رقم الطلب  </th>
                                        <th>اسم المغسله </th>
                                        <th>اسم العميل </th>
                                        <th>اسم المندوب  </th>
                                        <th>تاريخ وصولها المغسله </th>
                                        <th>تاريخ الانتهاء من الغسيل </th>
                                        <th>التفاصيل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->order->subCategories->name_ar}}</td>
                                            <td>{{$order->order->user->name}}</td>
                                            <td>{{$order->order->user->name}}</td>
                                            <td>{{$order->created_at->format('d/m/Y')}}</td>
                                            <td>{{$order->updated_at->format('d/m/Y')}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{route('Order.show',$orderStatusHistory->id)}}">التفاصيل </a>
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
        $("#ordersPickUp").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#ordersPickUp_wrapper .col-md-6:eq(0)');
    </script>
@endpush
