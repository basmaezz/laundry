@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> المغاسل المسجله
                                <a href="{{route('laundries.create')}}" class="btn btn-primary" style="float:left;margin-top: 2px;">اضافه مغسله </a>
                            </div>
                            <div class="card-block">
                                <table id="laundries" class="table table-bordered table-striped">
                                    <thead >
                                        <tr >
                                            <th> الصوره </th>
                                            <th>اسم المغسله </th>
                                            <th>الفرع الرئيسى </th>
                                            <th>المدينه </th>
                                            <th>الحى</th>
                                            <th>ساعات العمل</th>
                                            <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subCategories as $subCategory)
                                    <tr>
                                        <td><img src="{{$subCategory->image}}" style="width:50px;height:50px"></td>
                                        <td>{{$subCategory->name_ar}}</td>
                                        <td>{{$subCategory->parent->name_ar??''}}</td>
                                        <td>{{$subCategory->city->name_ar??''}}</td>
                                        <td>{{ Str::limit($subCategory->address, 20) }}</td>
                                        @if($subCategory->around_clock !=Null)
                                        <td> طوال اليوم</td>
                                        @else
                                            <td>{{abs($hours=((int)$subCategory->clock_end)-((int)$subCategory->clock_at))}}  ساعة </td>
                                        @endif
                                            <td>
                                                @if($subCategory->parent_id=='')
                                                <a href="{{route('laundries.branches',$subCategory->id)}}" class="edit btn btn-primary btn-sm">الفروع</a>
                                                @endif
                                                <a href="{{route('CategoryItems.index',$subCategory->id)}}" class="edit btn btn-primary btn-sm">الأقسام</a>
                                                <a href="{{route('laundries.edit',$subCategory->id)}}" class="edit btn btn-primary btn-sm">تعديل</a>
                                                <a href="{{route('laundries.view',$subCategory->id)}}" class="edit btn btn-primary btn-sm">التفاصيل</a>
{{--                                                    <form class="delete" action="{{route('laundries.destroy',$subCategory->id)}}" method="get" >--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <input type="submit" value="حذف" class="edit btn btn-danger btn-sm" style="display: inline">--}}
{{--                                                    </form>--}}
                                                <a href="{{route('laundries.destroy',$subCategory->id)}}" class="edit btn btn-danger btn-sm " onclick="delConfirm()" >حذف</a>
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
        $("#laundries").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#laundries_wrapper .col-md-6:eq(0)');
    </script>
    <script>
        function delConfirm(){
            return confirm("هل أنت متأكد من حذف المغسله ؟");
        }
    </script>
@endpush

