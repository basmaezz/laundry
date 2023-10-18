@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل بيانات سياره</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('car.update',$car->id)}}" >
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم السياره</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="name_ar" class="form-control" value="{{$car->name_ar}}" >
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email"> اسم السياره بالانجليزيه</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="name_en" class="form-control" value="{{$car->name_en}}" >
                                        @if ($errors->has('name_en'))
                                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
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
