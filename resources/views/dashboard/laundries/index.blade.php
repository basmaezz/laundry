{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--    <div>--}}
{{--            <nav aria-label="breadcrumb" class="navBreadCrumb">--}}
{{--                <ol class="breadcrumb">--}}
{{--                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>--}}
{{--                    <li class="breadcrumb-item active" aria-current="page">المغاسل   </li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <i class="fa fa-align-justify"></i>--}}

{{--                    </div>--}}
{{--                    <div class="card-block">--}}
{{--                        <table class="table table-striped" id="laundriesTable">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}

{{--                            </tr>--}}
{{--                            </thead>--}}

{{--                        </table>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h3 class="modal-title" id="exampleModalLongTitle">نسخ بيانات المغسله</h3>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="form-group">--}}
{{--                        <label for="company" >اسم المغسله</label>--}}
{{--                        <input type="text" name="name_ar"class="form-control" id="name_ar"value="{{ Request::old('name_ar') }}" placeholder="اسم المغسله" >--}}
{{--                        @error('name_ar')--}}
{{--                        <span class="text-danger">{{ $message }}</span>--}}
{{--                        <div class="text-sm text-red-600">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="company">اسم المغسله بالانجليزيه</label>--}}
{{--                        <input type="text" name="name_en"class="form-control" id="name_en" value="{{ Request::old('name_en') }}"placeholder="اسم المغسله" >--}}
{{--                        @error('name_en')--}}
{{--                        <span class="text-danger">{{ $message }}</span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" class="btn btn-primary"> اتمام النسخ</button>--}}
{{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}
{{--@push('scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        aert('test');--}}

{{--        $(function() {--}}
{{--            var table = $('#laundriesTable').DataTable({--}}
{{--                processing: true,--}}
{{--                serverSide: true,--}}
{{--               --}}
{{--        });--}}
{{--        $('body').on('click', '#deleteBtn', function () {--}}
{{--            // $('#myModal').modal('show');--}}
{{--            if (confirm("هل تريد اتمام الحذف ؟") == true) {--}}
{{--                var id = $(this).data('id');--}}
{{--                window.location.reload();--}}
{{--                $.ajax({--}}
{{--                    type:"get",--}}
{{--                    url: "{{ route('laundries.destroy') }}",--}}
{{--                    data: { id: id},--}}
{{--                    dataType: 'json',--}}
{{--                    success: function(res){--}}
{{--                        var oTable = $('#datatable-crud').dataTable();--}}
{{--                        oTable.fnDraw(false);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}

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
