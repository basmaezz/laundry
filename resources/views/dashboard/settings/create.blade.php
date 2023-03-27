@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>الاعددات </strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('settings.store')}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">نطاق المناديب </label>
                            <div class="col-md-9">
                                <input type="number"  name="distance_delegates" class="form-control" placeholder="نطاق المناديب  " >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">الايميل </label>
                            <div class="col-md-9">
                                <input type="email"  name="email" class="form-control" placeholder="الايميل" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">رقم الواتساب </label>
                            <div class="col-md-9">
                                <input type="text"  name="whatsapp" class="form-control" placeholder="رقم الواتساب" >
                            </div>
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

