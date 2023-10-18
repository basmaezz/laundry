@extends('layouts.dataTable-app')
@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">السيارات   </li>
                </ol>
            </nav>

        </div>
        <div class="content-body">

            <section id="multilingual-datatable">

                <div class="row">
                    <div class="col-10">
                        <div class="card invoice-list-wrapper">
                            <a href="{{route('car.create')}}" class="btn btn-primary" style="width: 130px" >اضافه سياره</a>

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
