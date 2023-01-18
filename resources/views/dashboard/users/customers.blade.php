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
                                <table id="customers" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th>الاسم </th>
                                        <th>البريد الألكترونى</th>
                                        <th>الجوال</th>
                                        <th>gender </th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}} </td>
                                            <td> {{$user->mobile}}</td>
                                            <td>{{$user->gender}}</td>
                                            <td>
                                                <a href="{{route('customer.delete',$user->id)}}" class="btn btn-danger">حذف</a>
                                            </td>
                                        </tr>
                                    @endforeach
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

@endsection
@push('scripts')
    <script>
        $("#customers").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#customers_wrapper .col-md-6:eq(0)');
    </script>
@endpush

