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
                            <li class="breadcrumb-item"><a href="{{route('carLaundries.index')}}">مغاسل السيارات</a> </li>
                            <li class="breadcrumb-item active">مغاسل السيارات </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="add-btn">
            <a href="{{route('carLaundries.create')}}" class="btn btn-primary" >اضافه جديد</a>
        </div>
        <section id="multilingual-datatable">
            <div class="row">
                <div class="col-10">
                    <div class="card invoice-list-wrapper">
                        <div class="card-datatable table-responsive">
                            <table class="productTable table" id="carLaundryTable">
                                <thead>
                                <tr>
                                    <th>اسم المنطقه</th>
                                    <th>نطاق التشغيل </th>
{{--                                    <th>السعر  </th>--}}
{{--                                    <th>الطلبات  </th>--}}
                                    <th>  </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#carLaundryTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('carLaundries.index') }}",

                columns: [{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data: 'range',
                    name: 'range'
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
                    url: "{{ route('carLaundries.destroy') }}",
                    dataType: 'json',
                    data: { id: id},
                    success: function(res){
                        var oTable = $('#carLaundryTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
