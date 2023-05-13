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
                    <strong>ارسال اشعار  </strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('notification.send')}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">العنوان </label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">المدينه </label>
                            <div class="col-md-9">
                                <select class="form-control" name="cities" id="cities" >
                                    @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">المستخدمين </label>
                            <input type="checkbox"   name="gender[]" value="m">رجال
                            <input type="checkbox"   name="gender[]" value="f">نساء
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">الاشعار </label>
                            <textarea class="form-control" name="body"></textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> ارسال</button>
                            <a href="{{route('coupons.index')}}" class="btn btn-sm btn-danger">الغاء </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

