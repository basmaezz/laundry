@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">عرض الاشعار</h4>
                        </div>
                        <div class="card-body">

                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="form-label" for="username">عنوان الاشعار / عنوان الاشعار بالانجليزيه</label>
                                        <input type="text" name="title_ar" class="form-control" value="{{$notification->title_ar}}"disabled>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="form-label" for="username">نص الاشعار / نص الاشعار بالانجليزيه</label>
                                        <input type="text" name="title_ar" class="form-control" value="{{$notification->content_ar}}"disabled>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="form-label" for="username">عدد المستقبلين</label>
                                        <input type="text" name="title_ar" class="form-control" value="{{$count}}"disabled>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
                @endsection

