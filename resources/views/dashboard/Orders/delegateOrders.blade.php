@extends('layouts.dataTable-app')
@section('content')

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('delegates.index')}}">المناديب</a>
                            </li>
                            <li class="breadcrumb-item active">طلبات المندوب
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
    <main class="main" style="margin-top: 25px">
        <div >

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary custom" > عدد الطلبات الكليه : {{ $orderCount}}</a>
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

