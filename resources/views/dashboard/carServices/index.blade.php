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
            <a href="{{route('carServices.create',$id)}}" class="btn btn-primary" >اضافه جديد</a>
        </div>
        <section id="multilingual-datatable">
            <div class="row">
                <div class="col-10">
                    <div class="card invoice-list-wrapper">
                        <div class="card-datatable table-responsive">
                            <table class="productTable table" id="carLaundryTable">
                                <input type="hidden" name="carpet_laundry_id" id="car_laundry_id" value="{{$id}}">

                                <thead>
                                <tr>
                                    <th>رقم الخدمه</th>
                                    <th>اسم الخدمه</th>
                                    <th>سعر الخدمه  </th>
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
            var id= document.getElementById('car_laundry_id').value;

            $('#carLaundryTable').DataTable({

                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('carServices.index',$id) }}",

                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data: 'price',
                    name: 'price'
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
                    url: "{{ route('carServices.destroy') }}",
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
