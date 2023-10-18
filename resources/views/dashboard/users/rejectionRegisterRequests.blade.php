{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-9">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <i class="fa fa-align-justify"></i>--}}

{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table id="users" class="table table-bordered table-striped">--}}
{{--                                    <thead >--}}
{{--                                    <tr >--}}
{{--                                        <th>الاسم</th>--}}
{{--                                        <th>المدينه</th>--}}
{{--                                        <th>الجنسيه</th>--}}
{{--                                        <th> سبب الرفض</th>--}}
{{--                                        <th></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}

{{--                                    @foreach($delegates as $delegate)--}}

{{--                                        <tr>--}}
{{--                                            <td>{{$delegate->appUser->name ??''}}</td>--}}
{{--                                            <td>{{$delegate->appUser->cities->name_ar ??''}}</td>--}}
{{--                                            <td>{{$delegate->nationality->name_ar ?? ''}}</td>--}}
{{--                                            <td>{{$delegate->reject_reason}}</td>--}}

{{--                                            <td>--}}
{{--                                                <a href="{{route('delegate.show',$delegate->id)}}" class="btn btn-info">تفاصيل</a>--}}
{{--                                                <a href="{{route('delegate.acceptRegister',$delegate->id)}}" class="btn btn-info">قبول</a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}

{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        </div>--}}
{{--    </main>--}}

{{--@endsection--}}
{{--@push('scripts')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>--}}
{{--    <script>--}}
{{--        $("#users").DataTable({--}}
{{--            "responsive": true, "lengthChange": false, "autoWidth": false,--}}
{{--            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');--}}
{{--    </script>--}}
{{--@endpush--}}

@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div>
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">طلبات التسجيل المرفوضه    </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>المدينه</th>
                                <th>الجنسيه</th>
                                <th> سبب الرفض</th>
                                <th></th>
                            </tr>
                            </thead>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('delegate.registrationRequests') }}",
                columns: [{
                    data: 'name',
                    name: 'name'
                },{
                    data: 'city',
                    name: 'city'
                },{
                    data: 'nationality',
                    name: 'nationality'
                },{
                    data:'reject_reason',
                    name:'reject_reason'
                },{
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
