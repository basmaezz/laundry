@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">

    <div>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">

                                <div class="card-header">
                                    <strong>  تعديل بيانات  </strong>
                                </div>
                                <div class="card-block">
                                    <form action="{{route('delegate.storeRejectReason',$delegate->id)}}" method="post" class="form-horizontal">
                                        @csrf

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">اسم المندوب </label>
                                            <div class="col-md-9">
{{--                                                <input type="hidden"  name="id" class="form-control" value="{{$delegate->id}}"required>--}}
                                                <input type="text" id="text-input" name="name" class="form-control" value="{{$delegate->appUserTrashed->name ??''}} "disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">سبب الرفض </label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="reject_reason" required></textarea>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                           <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger custom ">الغاء</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
