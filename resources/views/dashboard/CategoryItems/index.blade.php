@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <a href="{{route('CategoryItems.create',$subCategory->id)}}" class="btn btn-primary" style="margin-bottom: 20px">اضافه قسم</a>
            @if($categoryItems->count()>0)
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الأقسام
                            </div>
                            <div class="card-block">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>اسم القسم</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categoryItems as $categoryItem)
                                        <tr>
                                            <td>{{$categoryItem->category_type}} </td>
                                            <td>
                                                <a href="{{route('product.create',$categoryItem->id)}}" class="btn btn-primary">اضافه قطعه</a>

                                                <a href="{{route('CategoryItems.show',$categoryItem->id)}}" class="btn btn-info">عرض  القطع </a>
                                             
                                                <a href="{{route('CategoryItems.edit',$categoryItem->id)}}" class="btn btn-primary">تعديل</a>
                                                <a href="{{route('CategoryItems.destroy',$categoryItem->id)}}" class="btn btn-danger">حذف</a>
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
            @endif
        </div>

        </div>
    </main>



@endsection
