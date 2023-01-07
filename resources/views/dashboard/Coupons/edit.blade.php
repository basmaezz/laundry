@extends('../layouts.app')
@section('content')
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه كوبون</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('coupon.update',$coupon->id)}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم الكوبون</label>
                            <div class="col-md-9">
                                <input type="hidden"  name="coupon_id" class="form-control" value="{{$coupon->id}}" >
                                <input type="text"  name="code_name" class="form-control" value="{{$coupon->code_name}}" >
                                @if ($errors->has('code_name'))
                                    <span class="text-danger">{{ $errors->first('code_name') }}</span>
                                @endif
                            </div>
                        </div>            <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">قيمه الكوبون</label>
                            <div class="col-md-9">
                                <input type="text"  name="discount_value" class="form-control" value="{{$coupon->discount_value}}" >
                                @if ($errors->has('discount_value'))
                                    <span class="text-danger">{{ $errors->first('discount_value') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">بدايه الكوبون</label>
                            <div class="col-md-9">
                                <input type="date"  name="date_from" class="form-control" value="{{$coupon->date_from}}" >
                                @if ($errors->has('date_from'))
                                    <span class="text-danger">{{ $errors->first('date_from') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">نهايه الكوبون</label>
                            <div class="col-md-9">
                                <input type="date"  name="date_to" class="form-control" value="{{$coupon->date_to}}" >
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
                                    <option value="1"{{ ( $coupon->status == '1') ? 'selected' : '' }}>فعال</option>
                                    <option value="0"{{ ( $coupon->status == '0') ? 'selected' : '' }}>غير فعال</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

