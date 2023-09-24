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
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>ارسال اشعار للعملاء  </strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('notification.storeCustomerNotification')}}" >
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">المدينه  </label>
                            <div class="col-md-9">

                                    <select id="choices-multiple-remove-button" name="city_id[]"  multiple>

                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                    @endforeach
                                    @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">النوع  </label>
                            <div class="col-md-9">
                                <select class="form-control" name="gender">
                                        <option value="m">ذكر</option>
                                        <option value="f">أنثى</option>
                                    @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">عنوان الاشعار بالعربيه /عنوان الاشعار بالانجليزيه  </label>
                            <div class="col-md-9">
                                <input type="text" name="title_ar" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">نص الاشعار بالعربيه/ نص الاشعار باللغه الانجليزيه </label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="content_ar" required></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-info" style="max-height:30px !important;max-width:80px !important;"><i class="fa fa-dot-circle-o"></i> ارسال</button>
                            <a href="{{route('coupons.index')}}" class="btn btn-sm btn-danger">الغاء </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')

@endpush
