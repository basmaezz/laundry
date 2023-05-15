@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">التصنيفات  </li>
            </ol>
        </nav>
    <div>

                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> التصنيفات
                                 </div>
                                <div class="card-block">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th> الصورة</th>
                                            <th>اسم التصنيف</th>
                                          <th>الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td><img src="{{$category->image}}" style="width:50px;height:50px"></td>
                                                <td>{{$category->name_ar}} </td>
                                                <td>

                                                    <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary custom" >تعديل</a>
{{--                                                    <form class="delete" action="{{route('category.destroy',$category->id)}}" method="get">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <input type="submit" value="حذف" class="edit btn btn-danger btn-sm">--}}
{{--                                                    </form>--}}
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

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(".delete").on("submit", function(){--}}
{{--            return confirm("هل أنت متأكد من الحذف  ؟");--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
