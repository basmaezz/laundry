
{{--                                    <tbody>--}}
{{--                                    @foreach($orders as $order)--}}
{{--                                        @php--}}
{{--                                            $current = $order->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::WaitingForDelivery)->first();--}}
{{--                                            $next = $order->histories->where('status_id',\App\Http\Controllers\Admin\OrderController::AcceptedByDelivery)->first();--}}
{{--                                        @endphp--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$order->id}}</td>--}}
{{--                                            <td>{{$order->subCategoriesTrashed->name_ar}}</td>--}}
{{--                                            <td>{{$order->userTrashed->name}}</td>--}}
{{--                                            <td>{{$order->delegateTrashed->appUserTrashed->name ??''}}</td>--}}
{{--                                            @if($next)--}}
{{--                                                <td>{{minutesToHumanReadable($current->spend_time ?? 0)}}</td>--}}
{{--                                            @else--}}
{{--                                                <td><time class="timeago" datetime="{{$current->created_at->toISOString()}}">{{ $current->created_at->toDateString() }}</time></td>--}}
{{--                                            @endif--}}
{{--                                            <td>{{$order->created_at->format('d/m/Y')}}</td>--}}
{{--                                            <td>--}}
{{--                                                <a class="btn btn-primary btn-sm" href="{{route('Order.show',$order->id)}}">التفاصيل </a>--}}
{{--                                            </td>--}}

{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        </div>--}}
{{--    </main>--}}
{{--@endsection--}}
{{--@push('scripts')--}}
{{--    <script src="{{asset('assets/admin/js/libs/jquery.timeago.js')}}"></script>--}}
{{--    <script src="{{asset('assets/admin/js/libs/jquery.timeago.ar.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        jQuery(document).ready(function() {--}}
{{--            jQuery("time.timeago").timeago();--}}
{{--        });--}}
{{--        $("#ordersPickUp").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#ordersPickUp_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}
{{--@endpush--}}
@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الطلبات المنتهيه   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>

                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>رقم الطلب  </th>
                                <th>اسم المغسله </th>
                                <th>اسم العميل </th>
                                <th> نوع التوصيل </th>
                                <th> المده المستغرقه  </th>
                                <th> تاريخ وصول المغسله  </th>
                                <th>التفاصيل</th>
                            </tr>
                            </thead>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('Order.pendingDeliveryAcceptance') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'category',
                    name: 'category'
                },{
                    data: 'user',
                    name: 'user'
                },{
                    data:'delegate',
                    name:'delegate'
                },{
                    data:'duration',
                    name:'duration'
                },{
                    data:'created_at',
                    name:'created_at'
                },{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

                ]
            });
        });
    </script>
@endpush
