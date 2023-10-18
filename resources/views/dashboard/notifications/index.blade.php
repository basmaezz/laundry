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
                                <table class="productTable table" id="notificationsTable">
                                    <thead>
                                    <tr>
                                        <th>عنوان الاشعار </th>
                                        <th>نص الاشعار </th>
                                        <th>الفئه </th>
                                        <th>تاريخ الارسال</th>
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
            $('#notificationsTable').DataTable({
                processing: true,
                serverSide: true,
                ordering:false,
                ajax: "{{ Route('notification.index') }}",
                columns: [{
                    data: 'title_ar',
                    name: 'title_ar'
                },{
                    data: 'content_ar',
                    name: 'content_ar'
                },{
                    data:'type',
                    name:'type'
                },{
                    data:'created_at',
                    name:'created_at'
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

    </script>

@endpush
