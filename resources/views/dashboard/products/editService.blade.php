@extends('../layouts.app')
@section('content')
    <nav aria-label="breadcrumb" class="navBreadCrumb">
{{--        <ol class="breadcrumb">--}}
{{--            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>--}}
{{--            <li class="breadcrumb-item active"><a href="{{route('product.productServices',$product->id)}}">الخدمات</a></li>--}}
{{--            <li class="breadcrumb-item active" aria-current="page">اضافه خدمه    </li>--}}
{{--        </ol>--}}
    </nav>
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل قطعه</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('product.updateService',$service->id)}}" >
                                @csrf

                                <div class="form-group">
                                    <label for="company">اسم الخدمه </label>
                                    <input type="hidden"  name="service_id" class="form-control" value="{{$service->id}}"  >
                                    <input type="hidden"  name="product_id" class="form-control" value="{{$service->product_id}}"  >

                                    <input type="text" name="services"class="form-control" id="services" value="{{$service->services}} ">
                                    @if ($errors->has('services'))
                                        <span class="text-danger">{{ $errors->first('services') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company">اسم الخدمه بالانجليزيه </label>
                                    <input type="text" name="services_en"class="form-control" id="services" value="{{$service->services_en}} ">
                                    @if ($errors->has('services_en'))
                                        <span class="text-danger">{{ $errors->first('services_en') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company">اسم الخدمه انجليزى(معرب) </label>
                                    <input type="text" name="services_franco"class="form-control" id="services" value="{{$service->services_franco}} ">
                                    @if ($errors->has('services_franco'))
                                        <span class="text-danger">{{ $errors->first('services_franco') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="company">السعر  </label>
                                    <div class="input-group">
                                        <input type="text"name="price" class="form-control" placeholder="السعر " value="{{$service->price}}" >
                                        <span class="input-group-addon"> ريال</i>
                                                </span>
                                    </div>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                @if($service->subCategory)
                                    @if($service->subCategory->urgentWash !=null ||$service->subCategory->urgentWash !=0)
                                        <div class="form-group">
                                            <label for="company">سعر المستعجل  </label><br>
                                            <div class="input-group">
                                                <input type="text"name="priceUrgent" class="form-control view" placeholder="السعر " value="{{$service->priceUrgent ??''}}" >
                                                <span class="input-group-addon"> ريال</i>
                                                </span>
                                            </div>

                                            @if ($errors->has('priceUrgent'))
                                                <span class="text-danger">{{ $errors->first('priceUrgent') }}</span>
                                            @endif
                                        </div>
                                    @endif
                                @endif

                                <div class="form-group">
                                    <label for="company">العموله  </label>
                                    <div class="input-group">
                                        <input type="text"name="commission" class="form-control" placeholder="السعر " value="{{$service->commission}}" >
                                        <span class="input-group-addon"> ريال</i>
                                                </span>
                                    </div>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>


                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Bootstrap Validation -->
@endsection

