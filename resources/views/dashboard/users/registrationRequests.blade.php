@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
            <div class="validationMsg" style="width: 600px">
                @if($errors->any())
                    <div class="alert alert-danger" >
                        <h6>{{$errors->first()}}</h6>
                    </div>
                @elseif(session()->has('message'))
                    <div class="alert alert-success"  >
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>

                            </div>
                            <div class="card-block">
                                <table id="users" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th>الاسم</th>
                                        <th>المدينه</th>
                                        <th>الجنسيه</th>
                                        <th>نوع التعاقد</th>
                                        <th> الحاله</th>
                                        <th>تاريخ الالتحاق </th>
                                        <th>الاجراءات</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($requests as $delegate)

                                            <tr>
                                                <td>{{$delegate->appUser->name ??''}}</td>
                                                <td>{{$delegate->appUser->cities->name_ar ??''}}</td>
                                                <td>{{$delegate->nationality->name_ar ?? ''}}</td>
                                                <td>{{$delegate->request_employment==0 ?'موظف':'عامل حر'}}</td>
                                                <td>{{$delegate->appUser->status ??''}}</td>
                                                <td>{{$delegate->created_at->format('Y-M-D') ??''}}</td>

                                                <td>
                                                    <a href="{{route('delegate.acceptRegister',$delegate->id)}}" class="btn btn-info">قبول</a>
                                                    <a href="{{route('delegate.changeDelegateStatus',$delegate->id)}}" class="btn btn-danger">رفض</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $("#users").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
    </script>
@endpush

