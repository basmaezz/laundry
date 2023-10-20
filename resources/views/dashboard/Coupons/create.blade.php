@extends('../layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">الكوبونات</a>
                            </li>
                            <li class="breadcrumb-item active">اضافه كوبون
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">

            </div>
        </div>
    </div>

    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه كوبون</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('coupon.store')}}" >
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم الكوبون</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="code_name" class="form-control" placeholder="اسم الكوبون " >
                                        @if ($errors->has('code_name'))
                                            <span class="text-danger">{{ $errors->first('code_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">قيمه الكوبون (%)</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="discount_value" class="form-control" placeholder="قيمه الكوبون (%) " >
                                        @if ($errors->has('discount_value'))
                                            <span class="text-danger">{{ $errors->first('discount_value') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">بدايه الكوبون</label>
                                    <div class="col-md-9">
                                        <input type="date"  name="date_from" class="form-control" placeholder="بدايه الكوبون " >
                                        @if ($errors->has('date_from'))
                                            <span class="text-danger">{{ $errors->first('date_from') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">نهايه الكوبون</label>
                                    <div class="col-md-9">
                                        <input type="date"  name="date_to" class="form-control" placeholder="نهايه الكوبون " >
                                        @if ($errors->has('date_to'))
                                            <span class="text-danger">{{ $errors->first('date_to') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">تفعيل الكوبون</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="status">
                                            <option>حاله الكوبون</option>
                                            <option value="1">فعال</option>
                                            <option value="0">غير فعال</option>
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="text-danger">{{ $errors->first('status') }}</span>
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
