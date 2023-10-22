
{{--                    <strong>اضافه كوبون</strong>--}}
{{--                </div>--}}
{{--                <div class="card-block">--}}

{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3 form-control-label" for="hf-email">السؤال </label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                @if ($errors->has('question_ar'))--}}
{{--                                    <span class="text-danger">{{ $errors->first('question_ar') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3 form-control-label" for="hf-email">  السؤال بالانجليزيه</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                @if ($errors->has('question_en'))--}}
{{--                                    <span class="text-danger">{{ $errors->first('question_en') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3 form-control-label" for="hf-email"> الاجابه</label>--}}
{{--                            <div class="col-md-9">--}}

{{--                                @if ($errors->has('answer_ar'))--}}
{{--                                    <span class="text-danger">{{ $errors->first('answer_ar') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3 form-control-label" for="hf-email">الاجابه بالانجليزيه </label>--}}
{{--                            <div class="col-md-9">--}}

{{--                                @if ($errors->has('answer_en'))--}}
{{--                                    <span class="text-danger">{{ $errors->first('answer_en') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="card-footer">--}}
{{--                            <button type="submit" class="btn btn-sm btn-info custom " style="max-width: 100px !important;"><i class="fa fa-dot-circle-o"></i> حفظ</button>--}}
{{--                            <a href="{{route('faqs.index')}}" class="btn btn-sm btn-danger " style="max-width: 100px !important;">الغاء </a>--}}
{{--                        </div>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--@endsection--}}

@extends('../layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                            <li class="breadcrumb-item"><a href="{{route('faqs.index')}}">الاسئله الشائعه</a></li>
                            <li class="breadcrumb-item active">اضافه سؤال
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه سؤال </h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('faq.store')}}" >
                                @csrf

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">السؤال </label>
                                    <div class="col-md-9">
                                        <input type="text"  name="question_ar" class="form-control" placeholder="السؤال " >
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email"> السؤال بالانجليزيه</label>
                                    <div class="col-md-9">
                                         <input type="text"  name="question_en" class="form-control" placeholder="السؤال بالانجليزيه" >

                                        @if ($errors->has('name_en'))
                                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">الاجابه</label>
                                    <div class="col-md-9">
                                       <input type="text"  name="answer_ar" class="form-control" placeholder="الاجابه " >

                                        @if ($errors->has('name_en'))
                                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email"> الاجابه</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="answer_en" class="form-control" placeholder="الاجابه " >

                                        @if ($errors->has('name_en'))
                                            <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
