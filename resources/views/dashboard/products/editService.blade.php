@extends('../layouts.app')
@section('content')
    <main class="main">

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
                                <input type="text" name="price"class="form-control" id="price" value="{{$service->price}}">
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

