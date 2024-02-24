@extends('layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('carDelegates.index')}}">مناديب السيارات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اضافه مندوب لغسيل السيارات    </li>
                </ol>
            </nav>
            <div class="row">

                <div class="col-md-6 col-12">
                   <div class="card">
                         <form method="post" action="{{route('carDelegates.store')}}" enctype="multipart/form-data">
                             @csrf

                        <div class="card-body">
                            <div class="card-header">
                                <strong>تفاصيل المندوب </strong>
                            </div>
                                 <div class="form-group ">
                                    <label class="col-md-3 form-control-label" for="text-input">المغسله  </label>
                                        <select  name="subCategory_id" class="form-control">

                                        </select>
                                        @if ($errors->has('subCategory_id'))
                                            <span class="text-danger">{{ $errors->first('subCategory_id') }}</span>
                                        @endif
                                </div>
                            <div class="form-group ">
                                <label >الأسم الأول</label>
                                <input type="text" id="text-input" name="name" class="form-control"value=""  >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label  for="email-input">البريد الألكترونى </label>
                                <input type="email" id="email-input" name="email" class="form-control"value=""  >
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <label  for="text-input">الجوال </label>
                                <input type="text" id="phone" maxlength="10" name="phone"value="" class="form-control"  >
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                    <label class="col-md-3 form-control-label" for="text-input">المدينه  </label>

                                        <select  name="city_id" class="form-control">

                                        </select>
                                        @if ($errors->has('city_id'))
                                            <span class="text-danger">{{ $errors->first('city_id') }}</span>
                                        @endif
                                </div>
                            <div class="form-group ">
                                <label class=" form-control-label" for="text-input">اسم البنك </label>
                                <div >
                                    <select  name="bank_id" class="form-control">

                                    </select>
                                    @if ($errors->has('bank_id'))
                                        <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="col-md-3 form-control-label" for="text-input"> رقم الحساب البنكى (IBAN) </label>

                                <input type="text" id="arrears" name="iban_number" class="form-control" maxlength="14"value="" >
                                @if ($errors->has('iban_number'))
                                    <span class="text-danger">{{ $errors->first('iban_number') }}</span>
                                @endif
                            </div>
{{--//                             <div class="form-group">--}}
{{--//                                 <label for="country">صوره الملف الشخصى</label>--}}
{{--//                                 <input type="file" name="avatar"class="form-control" id="image" required>--}}
{{--//                                 @error('image')--}}
{{--//                                 <span class="text-danger">{{ $message }}</span>--}}
{{--//                                 @enderror--}}
{{--//                             </div>--}}
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </div>

                        </div>

                </form>
            </div>
@endsection

