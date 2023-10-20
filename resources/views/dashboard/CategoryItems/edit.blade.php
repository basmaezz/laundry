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

                            <li class="breadcrumb-item"><a href="{{route('CategoryItems.index',$categoryItem->subcategory_id)}}">الأقسام</a>
                            </li>
                            <li class="breadcrumb-item active">تعديل قسم
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main" style="margin-top: 25px">


        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>تعديل بيانات القسم</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{Route('CategoryItems.update',$categoryItem->id)}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم القسم</label>
                            <div class="col-md-9">
                                <input type="text"  name="category_type" class="form-control" value="{{$categoryItem->category_type}}">
                                @if ($errors->has('category_type'))
                                    <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم القسم انجليزى</label>
                            <div class="col-md-9">
                                <input type="text"  name="category_type_en" class="form-control" value="{{$categoryItem->category_type_en}}">
                                @if ($errors->has('category_type_en'))
                                    <span class="text-danger">{{ $errors->first('category_type_en') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم القسم(معرب)</label>
                            <div class="col-md-9">

                                <input type="text"  name="category_type_franco" class="form-control" value="{{$categoryItem->category_type_franco}}">
                                @if ($errors->has('category_type_franco'))
                                    <span class="text-danger">{{ $errors->first('category_type_franco') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                           <button type="submit" class="btn btn-sm btn-info "style="max-height: 30px !important; max-width: 40px"> حفظ</button>
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger  "style="max-height: 30px !important; max-width: 40px">الغاء</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

