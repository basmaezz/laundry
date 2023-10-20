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
                            <li class="breadcrumb-item"><a href="{{route('customers.index')}}">العملاء</a>
                            </li>
                            <li class="breadcrumb-item active">طلبات العميل
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">

    <div class="content-wrapper">
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
                                        <th> </th>
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


