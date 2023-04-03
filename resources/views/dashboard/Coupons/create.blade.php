@extends('../layouts.app')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('coupons.index')}}">الكوبونات</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه كوبون  </li>
            </ol>
        </nav>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه كوبون</strong>
                </div>
                <div class="card-block">
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
                        </div>            <div class="form-group row">
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
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <a href="{{route('coupons.index')}}" class="btn btn-sm btn-danger">الغاء </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

