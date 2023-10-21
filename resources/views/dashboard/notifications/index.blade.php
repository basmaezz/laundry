@extends('layouts.dataTable-app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a>  </li>
                            <li class="breadcrumb-item active">الاشعارات</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                        <th>الرقم  </th>
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
                    data: 'id',
                    name: 'id'
                },{
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
