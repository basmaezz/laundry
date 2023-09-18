@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div>
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">  الاشعارات </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>

                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="notificationsTable">
                            <thead>
                            <tr>
                                <th>  الرقم </th>
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
    </main>

@endsection
@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#notificationsTable').DataTable({
                processing: true,
                serverSide: true,
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
