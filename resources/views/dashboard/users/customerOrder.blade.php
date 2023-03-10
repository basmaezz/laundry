@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"> عرض طلبات العميل</i>
                            </div>
                            <div class="card-block">
                                <table id="users" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th>رقم الطلب  </th>
                                        <th>اسم المغسله</th>
                                        <th>حاله الطلب</th>
                                        <th>التاريخ</th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->subCategories->name_ar}} </td>
                                                <td>{{$order->status}}</td>
                                                <td>{{$order->created_at->format('Y-m-d')}}</td>
                                                <td>
                                                    <a href="{{route('Order.show',$order->id)}}" class="btn btn-info">التفاصيل</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $("#users").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
    </script>

@endpush

