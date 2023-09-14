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
                    <form method="post" action="{{route('notification.store')}}" >
                        @csrf


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">عنوان الاشعار  </label>
                            <div class="col-md-9">
                               <input type="text" name="title_ar" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">عنوان الاشعار بالانجليزيه  </label>
                            <div class="col-md-9">
                                <input type="text" name="title_en" class="form-control" >

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">نص الاشعار  </label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="content_ar" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">نص الاشعار باللغه الانجليزيه  </label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="content_en" required></textarea>
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

