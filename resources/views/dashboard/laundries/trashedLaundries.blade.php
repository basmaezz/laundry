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
                                <table class="productTable table" id="laundryTable">
                                    <thead>
                                    <tr>
                                        <th>اسم المغسله </th>
                                        <th>المدينه </th>
                                        <th>الحى</th>
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
                        var oTable = $('#laundryTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    </script>

@endpush
