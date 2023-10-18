@extends('layouts.dataTable-app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div >
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> الطلبات  </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary custom" > عدد الطلبات الكليه : {{ \App\Models\OrderTable::select('*')->where('delivery_id',$id)->count()}}</a>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="delegateOrdersTable">
                            <input type="hidden" value="{{$id}}" id="delegate_id">
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
    </main>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(window).on('load', function() {
              var id= document.getElementById('delegate_id').value;

            $('#delegateOrdersTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ Route('Order.delegateOrders',$id) }}",
                data: { id: id},
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'subCategory',
                    name: 'subCategory'
                },{
                    data: 'status',
                    name:'status'
                },{
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

