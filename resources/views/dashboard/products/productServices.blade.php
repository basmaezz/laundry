@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                <li class="breadcrumb-item active"><a href="{{route('CategoryItems.show',$product->category_item_id)}}">القطع</a></li>
                <li class="breadcrumb-item active" aria-current="page">الخدمات    </li>
            </ol>
        </nav>
    <div>

                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>
                                    <a href="{{route('product.addService',$product->id)}}" class="btn btn-primary custom" style="float: left; max-height: 35px; max-width:100px">اضافه خدمه</a>
                                </div>
                                <div class="card-block">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>اسم الخدمه</th>
                                            <th>اسم الخدمه(معرب)</th>
                                            <th> السعر</th>
                                            @if($product->subcategoryTrashed->urgentWash !=null)
                                            <th> سعر المستعجل</th>
                                            @endif
                                            <th> العموله</th>
                                          <th>الاجراءات</th>
                                        </tr>
                                        </thead>
                                        @if($product->productService->count() >0)
                                        <tbody>
                                        @foreach($product->productService as $service)
                                            <tr>
                                                    <td>{{$service->services}}</td>
                                                    <td>{{$service->services_franco}}</td>
                                                    <td>{{$service->price}}</td>
                                                @if($product->subcategoryTrashed->urgentWash !=null)
                                                    <td>{{$service->priceUrgent?? '0'}}</td>
                                                @endif
                                                    <td>{{$service->commission}}</td>
                                                    <td>
                                                        <a href="{{route('product.editService',$service->id)}}" class="btn btn-primary "style=" max-height: 35px; max-width:50px">تعديل</a>
                                                        <a href="{{route('product.deleteProductService',$service->id)}}" class="btn btn-danger "style=" max-height: 35px; max-width:50px">حذف</a>
                                                    </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        @else
                                            <tbody>
                                            <tr><td>
                                                    لا يوجد بيانات لعرضها

                                                </td>
                                                <td></td>
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
