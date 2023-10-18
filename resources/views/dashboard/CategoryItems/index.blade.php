@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('laundries.view',$subCategory->id)}}">المغسله</a></li>
                <li class="breadcrumb-item active" aria-current="page">الاقسام</li>
            </ol>
        </nav>
    <div>
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> الأقسام
                                    <a href="{{route('CategoryItems.create',$subCategory->id)}}" class="btn btn-primary " style="float: left; max-height: 35px; max-width:100px">اضافه قسم</a>
                                </div>
                                <div class="card-block">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>اسم القسم</th>
                                            <th>اسم القسم انجليزى</th>
                                            <th>اسم القسم (معرب)</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        @if($categoryItems->count() >0)
                                        <tbody>
                                        @foreach($categoryItems as $categoryItem)
                                            <tr>
                                                <td>{{$categoryItem->category_type}} </td>
                                                <td>{{$categoryItem->category_type_en}} </td>
                                                <td>{{$categoryItem->category_type_franco}} </td>
                                                <td>
                                                    <a href="{{route('product.create',$categoryItem->id)}}" class="btn btn-primary  ">اضافه قطعه</a>

                                                    <a href="{{route('CategoryItems.show',$categoryItem->id)}}" class="btn btn-info ">عرض  القطع </a>

                                                    <a href="{{route('CategoryItems.edit',$categoryItem->id)}}"class="edit btn btn-primary " >تعديل</a>
                                                    <a href="{{route('CategoryItems.destroy',$categoryItem->id)}}" class="edit btn btn-danger ">حذف</a>
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                        @else
                                            <tbody>
                                            <tr>
                                                <td>لا يوجد بيانات</td>
                                                <td></td>
                                            </tr>
                                            </tbody>
                                        @endif
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
