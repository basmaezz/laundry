@extends('layouts.dataTable-app')
@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">


        </div>
        <div class="content-body">

            <section id="multilingual-datatable">
                <a href="{{route('laundries.export')}}" class="btn btn-info"  >Export </a>
                <a href="{{route('laundries.create')}}" class="btn btn-primary " >اضافه مغسله</a>

                <div class="row">

                    <div class="col-12">
                        <div class="card invoice-list-wrapper">
                            <div class="card-datatable table-responsive">
                                <table class="productTable table" id="laundryTable">
                                    <thead>
                                    <tr>
                                        <th>  الرقم </th>
                                        <th>  الصورة </th>
                                        <th>اسم المغسله </th>
                                        <th>المدينه </th>
                                        <th>الحى</th>
                                        <th>ساعات العمل</th>
                                        <th>مميزه  </th>
                                        <th> غسيل مستعجل</th>
                                        <th>الحاله</th>
                                        <th>اجمالى للشهر الحالى</th>
                                        <th>اجمالى الربح الشهرى</th>
                                        <th>اجمالى الطلبات</th>
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
            $('#laundryTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ Route('laundries.index') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'image',
                    name: 'image'
                },{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'address',
                    name:'address'
                },{
                    data:'around_clock',
                    name:'around_clock'
                },{
                    data: 'vip',
                    name: 'vip'
                },{
                    data:'urgentWash',
                    name:'urgentWash'
                },{
                    data:'opened',
                    name:'opened'
                },{
                    data:'monthlyOrdersCount',
                    name:'monthlyOrdersCount'
                },{
                    data:'monthlyProfit',
                    name:'monthlyProfit'
                },{
                    data:'ordersCount',
                    name:'ordersCount'
                },
                    {
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
                    url: "{{ route('laundries.destroy') }}",
                    data: { id: id},
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#laundryTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
