@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>
                                <a href="{{route('delegate.create')}}" class="btn btn-primary" style="float: left" >اضافه مندوب</a>
                                <a href="{{route('delegates.index')}}" class="btn btn-info" style="float: left">تحديث</a>

                            </div>
                            <div class="card-block">
                                <table id="delegates" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>الصورة</th>
                                        <th>الرقم التسلسلى</th>
                                        <th>الاسم</th>
                                        <th>المدينه</th>
                                        <th>الجنسيه</th>
                                        <th>نوع التعاقد</th>
                                        <th> الحاله</th>
                                        <th>تاريخ الالتحاق </th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($delegates as $delegate)
                                    <tr>
                                        <td>
                                            <img src="{{asset('/images/'.$delegate->appUser->image)}}" style="width:50px;height:50px;padding:10px">

                                        <td>{{$delegate->appUser->id}}</td>
                                        <td>{{$delegate->appUser->name}}</td>
                                        <td>{{$delegate->appUser->cities->name_ar}}</td>
                                        <td>{{$delegate->nationality->name_ar}}</td>
                                        <td>{{$delegate->request_employment==0 ?'موظف':'عامل حر'}}</td>
                                        <td>{{$delegate->appUser->status}}</td>
                                        <td>{{$delegate->appUser->created_at->format('Y-M-D')}}</td>

                                        <td>
                                            @if($delegate->appUser->status=='active')
                                            <a href="{{route('delegate.changeDelegateStatus',$delegate->id)}}" class="btn btn-danger">ايقاف</a>
                                            @elseif($delegate->appUser->status=='deactivated')
                                            <a href="{{route('delegate.changeDelegateStatus',$delegate->id)}}" class="btn btn-info">تفعيل</a>
                                            @endif
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
