@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> Striped Table
                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>البريد الالكترونى</th>
                                        <th>الجوال</th>
                                        <th>Status</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        @if(Auth::user()->id!=$user->id)
                                    <tr>
                                        <td>{{$user->name}} {{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>
                                            <span class="tag tag-success">Active</span>
                                        </td>
                                        <td>
                                                <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger">حذف</a>
                                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary">تعديل</a>
                                                <a href="{{route('user.view',$user->id)}}" class="btn btn-primary">تفاصيل</a>

                                        </td>
                                    </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Prev</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </main>



@endsection
