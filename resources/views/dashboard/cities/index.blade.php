@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div >
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">البلاد   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        <a href="{{route('city.create')}}" class="btn btn-primary custom" style="float: left; width: 100px; height: 35px " >اضافه مدينه</a>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="cityTable">
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
    </main>
@endsection
@push('javascripts')
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#cityTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('cities.index') }}",
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
                    url: "{{ route('city.destroy') }}",
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#datatable-crud').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush

