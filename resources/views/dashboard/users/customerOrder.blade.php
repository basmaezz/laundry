{{--                                    @foreach($orders as $order)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$order->id}}</td>--}}
{{--                                                <td>{{$order->subCategoriesTrashed->name_ar}} </td>--}}
{{--                                                <td>{{$order->status_id=='8'?'الطلب منتهى': $order->status}}</td>--}}
{{--                                                <td>{{$order->created_at->format('Y-m-d')}}</td>--}}
{{--                                                <td>--}}
{{--                                                    <a href="{{route('Order.show',$order->id)}}" class="btn btn-info"style="max-height: 40px !important; max-width: 70px !important;" >التفاصيل</a>                                                </td>--}}
{{--                                            </tr>--}}
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
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>--}}
{{--    <script>--}}
{{--        $("#users").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}

{{--@endpush--}}

@extends('layouts.dataTable-app')
@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">


        </div>
        <div class="content-body">

            <section id="multilingual-datatable">

                <input type="hidden" value="{{$id}}" id="customer_id">

                <div class="row">

                    <div class="col-12">
                        <div class="card invoice-list-wrapper">
                            <div class="card-datatable table-responsive">
                                <table class="productTable table" id="delegateTable">
                                    <thead>
                                    <tr>
                                        <th>رقم الطلب  </th>
                                        <th>اسم المغسله</th>
                                        <th>حاله الطلب</th>
                                        <th>التاريخ</th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Multilingual -->

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
               var id= document.getElementById('customer_id').value;
            $('#delegateTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('customer.Orders',$id) }}",
                data: { id: id},

                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'subCategory',
                    name: 'subCategory'
                },{
                    data: 'status',
                    name: 'status'
                }, {
                        data: 'createdAt',
                        name: 'createdAt'
                    }, {
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


