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
                            <li class="breadcrumb-item"><a href="{{route('customers.index')}}">العملاء</a>
                            </li>
                            <li class="breadcrumb-item active">اضافه للمحفظه
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
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه للمحفظه</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{url('increaseWallet/'.$appUser->uuid)}}" method="post"  class="form-horizontal ">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">الاسم الاخير</label>
                                    <input type="text" id="text-input" name="name" class="form-control"value="{{$appUser->name}}"disabled>

                                @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاخير</div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">الاسم الاخير</label>
                                    <input type="text" id="amount" name="amount" class="form-control" placeholder="100 ريال" required>
                                    @if ($errors->has('amount'))
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاخير</div>
                                </div>

                            <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">اضافه</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
