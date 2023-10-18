@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه سياره جديد</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('car.store')}}" >
                                @csrf

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="username">اسم السياره</label>
                                        <input type="text"  name="name_ar" class="form-control"value="{{Request::old('name_ar')}}" placeholder="اسم السياره "  required>
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group form-password-toggle col-md-6">
                                        <label class="form-label" for="password">اسم السياره بالانجليزيه</label>
                                        <input type="text"  name="name_en" class="form-control"value="{{Request::old('name_en')}}" placeholder="اسم السياره بالانحليويه" required >
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
