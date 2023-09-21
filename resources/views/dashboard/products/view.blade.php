@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('CategoryItems.show',$product->category_item_id)}}">القطع</a></li>
                <li class="breadcrumb-item active" aria-current="page">عرض التفاصيل  </li>
            </ol>
        </nav>
           <div class="col-sm-6">

                <div class="card">
                    <div class="card-header">
                        <strong>عرض تفاصيل {{$product->name_ar}}  </strong>
                    </div>
                    <div class="card-block">

                        <div class="form-group">
                            <label for="company" n>اسم القطعه</label>
                            <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$product->name_ar}}"disabled>

                        </div>
                        <div class="form-group">
                            <label for="company" >اسم القطعه بالانجليزيه</label>
                            <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$product->name_en}}"disabled>
                        </div>
                        <div class="form-group">
                            <label for="company" >الوصف  </label>
                            <input type="text" name="desc_ar"class="form-control" id="name_ar" value="{{$product->desc_ar}}"disabled>
                        </div>
                        <div class="form-group">
                            <label for="company" >الوصف  بالانجليزيه</label>
                            <input type="text" name="desc_en"class="form-control" id="name_ar" value="{{$product->desc_en}}"disabled>
                        </div>

                    </div>
                </div>
            </div>
        <div class="col-sm-6">


                <div class="card">
                    <div class="card-header">
                        <strong>عرض تفاصيل الخدمات </strong>
                    </div>
                    <div class="card-block">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>اسم الخدمه</th>
                                <th>السعر</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->productService as $service)
                                <tr>
                                    <td>{{$service->services}}</td>
                                    <td>{{$service->price}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

    </main>

@endsection

