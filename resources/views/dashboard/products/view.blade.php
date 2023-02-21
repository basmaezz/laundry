@extends('../layouts.app')
@section('content')
    <main class="main">
           <div class="col-sm-6">

                <div class="card">
                    <div class="card-header">
                        <strong>عرض تفاصيل {{$product[0]->name_ar}}  </strong>
                    </div>
                    <div class="card-block">

                        <div class="form-group">
                            <label for="company" n>اسم القطعه</label>
                            <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$product[0]->name_ar}}"disabled>

                        </div>
                        <div class="form-group">
                            <label for="company" >اسم القطعه بالانجليزيه</label>
                            <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$product[0]->name_en}}"disabled>
                        </div>
                        <div class="form-group">
                            <label for="company" >الوصف  </label>
                            <input type="text" name="desc_ar"class="form-control" id="name_ar" value="{{$product[0]->desc_ar}}"disabled>
                        </div>
                        <div class="form-group">
                            <label for="company" >الوصف  بالانجليزيه</label>
                            <input type="text" name="desc_en"class="form-control" id="name_ar" value="{{$product[0]->desc_en}}"disabled>
                        </div>
                        <div class="form-group">
                            <label for="company">الصوره  </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <strong>  عرض تفاصيل {{$product[0]->productService[0]->services}}</strong>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="form-group">
                                <label for="company">اسم الخدمه </label>
                                <input type="text" name="services"class="form-control" id="services" value="{{$product[0]->productService[0]->services}} "disabled>
                            </div>
                            <div class="form-group">
                                <label for="company">السعر  </label>
                                <input type="text" name="price"class="form-control" id="price" value="{{$product[0]->productService[0]->price}} "disabled>
                            </div>
                            <div class="form-group">
                                <label for="company">الصوره  </label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </form>

    </main>

@endsection

