@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="#">الاشعارات</a></li>
                <li class="breadcrumb-item active" aria-current="page">ارسال اشعار   </li>
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
                            <label class="col-md-3 form-control-label" for="hf-email">المدينه </label>
                            <div class="col-md-9">
                                <select class="select" multiple>
                                    <option value="1">One</option>
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

