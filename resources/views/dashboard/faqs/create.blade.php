@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('faqs.index')}}">الاسئله الشائعه</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه سؤال  </li>
            </ol>
        </nav>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه كوبون</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('faq.store')}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">السؤال </label>
                            <div class="col-md-9">
                                <input type="text"  name="question_ar" class="form-control" placeholder="السؤال " >
                                @if ($errors->has('question_ar'))
                                    <span class="text-danger">{{ $errors->first('question_ar') }}</span>
                                @endif
                            </div>
                        </div>            <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">  السؤال بالانجليزيه</label>
                            <div class="col-md-9">
                                <input type="text"  name="question_en" class="form-control" placeholder="السؤال بالانجليزيه" >
                                @if ($errors->has('question_en'))
                                    <span class="text-danger">{{ $errors->first('question_en') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email"> الاجابه</label>
                            <div class="col-md-9">
                                <textarea name="answer_ar" rows="4" cols="50">الاجابه</textarea>

                                @if ($errors->has('answer_ar'))
                                    <span class="text-danger">{{ $errors->first('answer_ar') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">الاجابه بالانجليزيه </label>
                            <div class="col-md-9">
                                <textarea   name="answer_ar" rows="4" cols="50"></textarea>

                                @if ($errors->has('answer_en'))
                                    <span class="text-danger">{{ $errors->first('answer_en') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-info custom " style="max-width: 100px !important;"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <a href="{{route('faqs.index')}}" class="btn btn-sm btn-danger " style="max-width: 100px !important;">الغاء </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

