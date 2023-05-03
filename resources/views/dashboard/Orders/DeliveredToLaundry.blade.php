@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الطلبات المنتهيه
                            </div>
                            <div class="card-block">
                                <table id="ordersPickUp" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th> رقم الطلب</th>
                                        <th>اسم المغسله</th>
                                        <th>اسم العميل</th>
                                        <th>اسم المندوب</th>
                                        <th>المده المستغرقه </th>
                                        <th>   تاريخ الوصول للمغسله </th>
                                        <th>  تاريخ الانتهاء  </th>
                                        <th>  التفاصيل   </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        @php
                                            $current = $order->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::DeliveredToLaundry)->first();
                                            $next = $order->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::ClothesReadyForDelivery)->first();
                                        @endphp
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->subCategoriesTrashed->name_ar}}</td>
                                            <td>{{$order->userTrashed->name}}</td>
                                            <td>{{$order->delegateTrashed->appUserTrashed->name ??''}}</td>
                                            @if($next)
                                                <td>{{minutesToHumanReadable($current->spend_time ?? 0)}}</td>
                                            @else
                                                <td><time class="timeago" datetime="{{$current->created_at->toISOString()}}">{{ $current->created_at->toDateString() }}</time></td>
                                            @endif
                                             <td>{{$order->created_at->format('d/m/Y')}}</td>
                                            <td>{{$order->updated_at->format('d/m/Y')}}</td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{route('Order.show',$order->id)}}">التفاصيل </a>
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
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.js')}}"></script>
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.ar.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery("time.timeago").timeago();
        });
        $("#ordersPickUp").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#ordersPickUp_wrapper .col-md-6:eq(0)');
    </script>
@endpush
