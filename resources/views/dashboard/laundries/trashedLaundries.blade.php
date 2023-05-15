@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div>
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الأدمن   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>اسم المغسله </th>
                                <th>المدينه </th>
                                <th>الحى</th>
                                <th>الاجراءات </th>
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
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('laundries.viewTrashedLaundries') }}",
                columns: [{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'address',
                    name:'address'
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
            // $('#myModal').modal('show');
            if (confirm("هل تريد استعاده الحذف ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('laundries.restoreDeleted') }}",
                    data: { id: id},
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
