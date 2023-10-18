@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ارسال اشعار للمناديب</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('notification.store')}}" >
                                @csrf


                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="form-label" for="username">عنوان الاشعار / عنوان الاشعار بالانجليزيه</label>
                                        <input type="text" name="title_ar" class="form-control" >
                                        @if ($errors->has('title_ar'))
                                            <span class="text-danger">{{ $errors->first('title_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="form-label" for="username">نص الاشعار / نص الاشعار بالانجليزيه</label>
                                        <input type="text" name="content_ar" class="form-control " >
                                        @if ($errors->has('content_ar'))
                                            <span class="text-danger">{{ $errors->first('content_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
                @endsection

