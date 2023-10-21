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
                            <li class="breadcrumb-item"><a href="{{route('cars.index')}}">السيارات</a>
                            </li>
                            <li class="breadcrumb-item active">السيارات
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="content-body">
            <div class="add-btn">
                <a href="{{route('car.create')}}" class="btn btn-primary" style="margin-right: 1126px;"  >اضافه سياره</a>

            </div>

            <section id="multilingual-datatable">

                <div class="row">
                    <div class="col-10">
                        <div class="card invoice-list-wrapper">

                            <div class="card-datatable table-responsive">
                                <table class="productTable table" id="carsTable">
                                    <thead>
                                    <tr>
                                        <th>الأسم</th>
                                        <th>الأسم بالانجليزيه</th>
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
            $('#carsTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('cars.index') }}",

                columns: [{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data: 'name_en',
                    name: 'name_en'
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
                    url: "{{ route('car.destroy') }}",
                    dataType: 'json',
                    data: { id: id},
                    success: function(res){
                        var oTable = $('#carsTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
