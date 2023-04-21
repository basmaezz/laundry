@extends('../layouts.app')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">المناديب المحذوفه  </li>
            </ol>
        </nav>
        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>
                            </div>
                            <div class="card-block">
                                <table id="delegates" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>الرقم التسلسلى</th>
                                        <th>الاسم</th>
                                        <th>المدينه</th>
                                        <th>الجنسيه</th>
                                        <th>نوع التعاقد</th>
                                        <th>رقم الهويه الوطنيه/الاقامه </th>
                                        <th> الحاله</th>
                                        <th>تاريخ الالتحاق </th>
                                        <th>الاجراءات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($delegates as $delegate)
                                        <tr>
                                            <td>{{$delegate->id}}</td>
                                            <td>{{$delegate->appUserTrashed->name ??''}}</td>
                                            <td>{{$delegate->appUserTrashed->citiesTrashed->name_ar ??''}}</td>
                                            <td>{{$delegate->nationality->name_ar ?? ''}}</td>
                                            <td>{{$delegate->request_employment==0 ?'موظف':'عامل حر'}}</td>
                                            <td>{{$delegate->id_number}}</td>
                                            <td>{{$delegate->appUserTrashed->status ??''}}</td>
                                            <td>{{$delegate->created_at->format('Y-M-D') ??''}}</td>

                                            <td>


                                                <a href="{{route('Order.delegateOrders',$delegate->id)}}" class="btn btn-info">الطلبات</a>
                                                <a href="{{route('delegate.show',$delegate->id)}}" class="btn btn-info">تفاصيل</a>
                                                {{--                                            <a href="{{route('delegate.delete',$delegate->id)}}" class="btn btn-danger">حذف</a>--}}
                                                <form class="delete" action="{{route('delegate.restoreDeletedDelegates',$delegate->id)}}" method="get">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="استعاده الحذف" class="edit btn btn-danger btn-sm">
                                                </form>
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
    <script>
        $(".delete").on("submit", function(){
            return confirm("هل أنت متأكد من استعاده الحذف  ؟");
        });
    </script>
@endpush
