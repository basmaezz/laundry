@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">

   <div>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الصلاحيات
                                <a href="{{route('roles.create')}}" class="btn btn-primary custom" style="float: left">اضافه </a>

                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Users</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            <th scope="row">{{$role->id}}</th>
                                            <td>{{$role->role}}</td>
                                            <td>{{$role->users_count}}</td>
                                            <td>
                                                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info custom">تعديل</a>
                                                @if($role->id!=1)
                                                <a href="{{route('roles.destroy',$role->id)}}" class="btn btn-danger">حذف</a>
                                                @endif
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
