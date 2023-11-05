@extends('layouts.dataTable-app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a> </li>
                            <li class="breadcrumb-item"><a href="{{route('carpetLaundries.index')}}">مغاسل السجاد</a> </li>
                            <li class="breadcrumb-item active">مغاسل السجاد </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="add-btn">
            <a href="{{route('carpetLaundries.create')}}" class="btn btn-primary" >اضافه جديد</a>

        </div>

        <section id="multilingual-datatable">

            <div class="row">
                <div class="col-10">
                    <div class="card invoice-list-wrapper">

                        <div class="card-datatable table-responsive">
                            <table class="productTable table" id="carpetLaundryTable">
                                <thead>
                                <tr>
                                    <th>اسم المنطقه</th>
                                    <th>المده التقريبيه للغسيل</th>
                                    <th>نطاق التشغيل </th>
                                    <th>سعر التوصيل </th>
                                    <th>الطلبات  </th>
                                    <th>  </th>
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
            $('#carpetLaundryTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('carpetLaundries.index') }}",

                columns: [{
                    data: 'area_name',
                    name: 'area_name'
                },{
                    data: 'approximate_duration',
                    name: 'approximate_duration'
                },{
                    data: 'range',
                    name: 'range'
                },{
                    data: 'delivery_price',
                    name: 'delivery_price'
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
                    url: "{{ route('carpetLaundries.destroy') }}",
                    dataType: 'json',
                    data: { id: id},
                    success: function(res){
                        var oTable = $('#carpetLaundryTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
