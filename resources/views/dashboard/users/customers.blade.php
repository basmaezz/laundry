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
                            <li class="breadcrumb-item active">العملاء
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">

            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">

                <section id="multilingual-datatable">

                    <a href="{{route('customers.export')}}" class="btn btn-primary " style=" width: 85px; height: 35px ; margin-right: 1377px; " >Export</a>

                    <div class="row">

                        <div class="col-12">
                            <div class="card invoice-list-wrapper">
                                <div class="card-datatable table-responsive">
                                    <table class="productTable table" id="customersTable">
                                        <thead>
                                        <tr>
                                            <th>الرقم </th>
                                            <th>الاسم </th>
                                            <th>البريد الألكترونى</th>
                                            <th>الجوال</th>
                                            <th>المدينه</th>
                                            <th>العنوان الحالى</th>
                                            <th>النوع </th>
                                            <th>عدد الطلبات</th>
                                            <th>المحفظه </th>
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
                    $('#customersTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ordering:false,
                        ajax: "{{ Route('customers.index') }}",
                        columns: [{
                            data: 'id',
                            name: 'id'
                        },{
                            data: 'name',
                            name: 'name'
                        },{
                            data: 'email',
                            name: 'email'
                        }, {
                            data: 'mobile',
                            name: 'mobile'
                        },{
                            data:'city',
                            name:'city'
                        },{
                            data:'defaultAddress',
                            name:'defaultAddress'
                        },{
                            data:'gender',
                            name:'gender'
                        },{
                            data:'orderNum',
                            name:'orderNum'
                        },{
                            data:'wallet',
                            name:'wallet'
                        },{
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        ]
                    });
                });
                $('body').on('click', '#deleteBtn', function () {
                    if (confirm("هل تريد اتمام الحذف ؟") == true) {
                        var id = $(this).data('id');
                        window.location.reload();
                        $.ajax({
                            type:"get",
                            url: "{{ route('customer.delete') }}",
                            data: { id: id},
                            dataType: 'json',
                            success: function(res){
                                var oTable = $('#customersTable').dataTable();
                                oTable.fnDraw(false);
                            }
                        });
                    }
                });
            </script>

    @endpush
