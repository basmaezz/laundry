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
                                    <a href="{{route('user.create')}}" class="btn btn-primary" style="float: left" >اضافه أدمن</a>
                            </div>
                            <div class="card-block">
                                <table id="users" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th>الرقم </th>
                                        <th>الاسم </th>
                                        <th>البريد الألكترونى</th>
                                        <th>الجوال</th>
                                        <th>الصلاحيه</th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)
                                        @if(Auth::user()->id!=$user->id)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                         <td>{{$user->email}} </td>
                                         <td>{{$user->phone}} </td>
                                        <td> {{$user->Roles[0]->role ??''}}</td>
                                        <td>
                                            <a href="{{route('user.edit',$user->id)}}" class="btn btn-info">تعديل</a>
                                            <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger show_confirm">حذف</a>
                                        </td>
                                    </tr>
                                        @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $("#users").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
    </script>
@endpush

