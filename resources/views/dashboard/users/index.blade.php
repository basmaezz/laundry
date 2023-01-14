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
                                <table class="table table-striped" id="users-datatable">
                                    <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>البريد الالكترونى</th>
                                        <th>الجوال</th>
                                        <th>Status</th>
{{--                                        <th>Status</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
{{--                                    @foreach($users as $user)--}}
{{--                                        @if(Auth::user()->id!=$user->id)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$user->name}} {{$user->last_name}}</td>--}}
{{--                                        <td>{{$user->email}}</td>--}}
{{--                                        <td>{{$user->phone}}</td>--}}
{{--                                        <td>--}}
{{--                                            <span class="tag tag-success">Active</span>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                                <a href="{{route('user.delete',$user->id)}}" class="btn btn-danger">حذف</a>--}}
{{--                                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-primary">تعديل</a>--}}
{{--                                                <a href="{{route('user.view',$user->id)}}" class="btn btn-primary">تفاصيل</a>--}}

{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
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
            var table = $('#users-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]

            });



        });

    </script>
@endsection

