@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('product.productServices',$service->product_id)}}">الخدمات</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه خدمه    </li>
            </ol>
        </nav>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>تعديل الخدمه </strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('product.updateService',$service->id)}}" >
                        @csrf
                        <div class="form-group row">

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

                        </div>
                        <div class="card-footer">
                           <button type="submit" class="btn btn-sm btn-info"style="max-height: 30px !important; max-width: 40px"> حفظ</button>
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger"style="max-height: 30px !important; max-width: 40px">الغاء</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

