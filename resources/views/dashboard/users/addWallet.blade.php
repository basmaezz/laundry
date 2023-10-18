@extends('../layouts.app')
@section('content')
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
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
