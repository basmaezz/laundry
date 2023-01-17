@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>
                            </div>
                            <div class="card-block">
                                <table class="table table-striped" id="customers-datatable">
                                    <thead>
                                    <tr>
                                        <th>الرقم التسلسلى</th>
                                        <th>الاسم</th>
                                        <th>البريد الالكترونى</th>
                                        <th>الجوال</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>
    <script type="text/javascript">

        $(function () {
            var table = $('#customers-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('customers.index') }}",
                columns: [
                    {data: 'uuid', name: 'uuid'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]

            });



        });

    </script>
@endsection

