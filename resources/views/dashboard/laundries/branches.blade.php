@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>  الفروع
                                <a href="{{route('laundries.branches.create',$id)}}" class="btn btn-primary" style="float:left;margin-top: 2px;">اضافه فرع </a>
                            </div>
                            <div class="card-block">
                                <table id="branches" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th>الاسم </th>
                                        <th>المدينه </th>
                                        <th>الحى</th>
                                   {{--  <th>Status </th>--}}
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($branches as $branch)
                                        <tr>
                                            <td>{{$branch->name_ar}}</td>
                                            <td>{{$branch->city->name_ar}}</td>
                                            <td>{{$branch->address}}</td>
                                             <td>

                                                <a href="{{route('CategoryItems.index',$branch->parent_id)}}" class="edit btn btn-primary btn-sm">الأقسام</a>
                                                <a href="{{route('laundries.editBranch',$branch->id)}}" class="edit btn btn-primary btn-sm">تعديل</a>
                                                <a href="{{route('laundries.view',$branch->id)}}" class="edit btn btn-primary btn-sm">التفاصيل</a>
                                                <a href="{{route('laundries.deleteBranch',$branch->id)}}" class="edit btn btn-danger btn-sm">حذف</a>
                                            </td>
                                        </tr>@endforeach
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
        $("#branches").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#branches_wrapper .col-md-6:eq(0)');
    </script>
@endpush

