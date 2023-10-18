


{{--                                        <div class="form-group row">--}}
{{--                                            <label class="col-md-3 form-control-label" for="text-input">كلمه المرور </label>--}}
{{--                                            <div class="col-md-9">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group row">--}}
{{--                                            <label class="col-md-3 form-control-label" for="text-input">كلمه المرور الجديده </label>--}}
{{--                                            <div class="col-md-9">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group row">--}}
{{--                                            <label class="col-md-3 form-control-label" for="text-input"> </label>--}}
{{--                                            <div class="col-md-9">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="card-footer">--}}
{{--                                           <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>--}}
{{--                                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger custom ">الغاء</a>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--@endsection--}}
@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تعديل كلمه المرور {{$user->name}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.updatePassword')}}" method="post"  class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name"> كلمه المرور</label>
                                    <input type="hidden"  name="id" class="form-control" value="{{Auth::user()->id}} "required>
                                    <input type="password" id="text-input" name="old_password" class="form-control" placeholder="********" required>

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">كلمه المرور الجديده</label>
                                    <input type="password" id="text-input" name="new_password" class="form-control"placeholder=" كلمه المرور الجديده" required>
                                    @if ($errors->has('new_password'))
                                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاخير</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">اعاده كلمه المرور</label>
                                    <input type="password" id="text-input" name="new_password_confirmation" class="form-control" placeholder=" اعاده كلمه المرور" required>

                                @if ($errors->has('new_password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('new_password_confirmation') }}</span>
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
