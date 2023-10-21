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
                            <li class="breadcrumb-item"><a href="{{route('banks.index')}}">البنوك</a>
                            </li>
                            <li class="breadcrumb-item active">اضافه جديد
                            </li>
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
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه سياره جديد</h4>
                        </div>
                        <div class="card-body">

                                <form method="post" action="{{route('bank.store')}}" >
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="hf-email">اسم البنك</label>
                                        <div class="col-md-9">
                                            <input type="text"  name="name_ar" class="form-control"value="{{Request::old('name_ar')}}" placeholder="اسم البنك " >
                                            @if ($errors->has('name_ar'))
                                                <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="hf-email"> اسم البنك بالانجليزيه</label>
                                        <div class="col-md-9">
                                            <input type="text"  name="name_en" class="form-control"value="{{Request::old('name_en')}}" placeholder="اسم البنك بالانحليويه" >
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
