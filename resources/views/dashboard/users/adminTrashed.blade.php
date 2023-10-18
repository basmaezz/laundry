@extends('layouts.dataTable-app')
@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">


        </div>
        <div class="content-body">

            <section id="multilingual-datatable">


                <div class="row">
                    <div class="col-12">
                        <div class="card invoice-list-wrapper">


                            <div class="card-datatable table-responsive">
                                <table class="productTable table" id="adminTable">
                                    <thead>
                                    <tr>
                                        <th>الرقم</th>
                                        <th>الأسم</th>
                                        <th>الأسم الأخير</th>
                                        <th>البريد الألكترونى</th>
                                        <th>الجوال</th>
                                        <th>الصلاحيه</th>
                                        <th>الأجراءات</th>
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
            $('#adminTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ route('users.adminTrashed') }}",

                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'last_name',
                    name: 'last_name'
                },
                    {
                        data: 'email',
                        name: 'email'
                    }, {
                        data: 'phone',
                        name: 'phone'
                    }, {
                        data: 'role',
                        name: 'role'
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

            if (confirm("هل تريد اتمام الحذف النهائى ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('users.forceDelete') }}",
                    data: { id: id},
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#adminTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
