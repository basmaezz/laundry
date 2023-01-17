@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>
                            </div>
                            <div class="card-block">
                                <table class="table table-striped" id="delegates-datatable">
                                    <thead>
                                    <tr>
                                        <th>الرقم التسلسلى</th>
                                        <th>الاسم</th>
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
            var table = $('#delegates-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('delegates.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user', name: 'user.name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection

