@extends('../layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('delegates.index')}}">المناديب</a>
                            </li>
                            <li class="breadcrumb-item active">تسجيل سبب الرفض
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">

            </div>
        </div>
    </div>
    <div class="content-body">
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
