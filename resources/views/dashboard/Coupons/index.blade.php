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
                            <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">الكوبونات</a>
                            </li>
                            <li class="breadcrumb-item active">الكوبونات
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <div class="content-body">
            <a href="{{route('coupon.create')}}" class="btn btn-primary" style="margin-right: 1126px;" >اضافه كوبون</a>
            <section id="multilingual-datatable">
                <div class="row">
                    <div class="col-10">
                        <div class="card invoice-list-wrapper">
                            <div class="card-datatable table-responsive">
                                <table class="productTable table" id="couponTable">
                                    <thead>
                                    <tr>
                                        <th>الرقم </th>
                                        <th>اسم الكوبون</th>
                                        <th>القيمه </th>
                                        <th>بدايه من </th>
                                        <th>نهايه الكوبون </th>
                                        <th> status </th>
                                        <th></th>
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

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#couponTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('coupons.index') }}",

                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'code_name',
                    name: 'code_name'
                },{
                    data: 'discount_value',
                    name: 'discount_value'
                },{
                    data: 'date_from',
                    name: 'date_from'
                },{
                    data: 'date_to',
                    name: 'date_to'
                },{
                    data: 'status',
                    name: 'status'
                }, {
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
                    url: "{{ route('coupon.destroy') }}",
                    dataType: 'json',
                    data: { id: id},
                    success: function(res){
                        var oTable = $('#couponTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
