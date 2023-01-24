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
                                <a href="{{route('delegate.create')}}" class="btn btn-primary" style="float: left" >اضافه مندوب</a>

                            </div>
                            <div class="card-block">
                                <table id="delegates" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>الرقم التسلسلى</th>
                                        <th>الاسم</th>
                                        <th>نوع التعاقد</th>
                                        <th>تاريخ الالتحاق </th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($delegates as $delegate)
                                    <tr>
                                        <td>{{$delegate->user->id}}</td>
                                        <td>{{$delegate->user->name}}</td>
                                        <td>{{$delegate->request_employment==0 ?'موظف':'عامل حر'}}</td>
                                        <td>{{$delegate->user->created_at->format('Y-M-D')}}</td>
                                        <td>
                                            <a href="{{route('delegate.show',$delegate->id)}}" class="btn btn-info">تفاصيل</a>
                                            <a href="{{route('delegate.delete',$delegate->id)}}" class="btn btn-danger">حذف</a>
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
        $("#delegates").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#delegates_wrapper .col-md-6:eq(0)');
    </script>
@endpush
