@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('users.index')}}">الادمن</a></li>
                <li class="breadcrumb-item active" aria-current="page">تعديل كلمه المرور   </li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>  تعديل كلمه المرور {{$user->name}} </strong>
                                </div>
                                <div class="card-block">
                                    <form action="{{route('user.updatePassword')}}" method="post"  class="form-horizontal">
                                        @csrf

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">كلمه المرور </label>
                                            <div class="col-md-9">
                                                <input type="hidden"  name="id" class="form-control" value="{{Auth::user()->id}} "required>
                                                <input type="password" id="text-input" name="old_password" class="form-control" placeholder="********" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">كلمه المرور الجديده </label>
                                            <div class="col-md-9">
                                                <input type="password" id="text-input" name="new_password" class="form-control"placeholder=" كلمه المرور الجديده" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">اعاده كلمه المرور </label>
                                            <div class="col-md-9">
                                                <input type="password" id="text-input" name="new_password_confirmation" class="form-control" placeholder=" اعاده كلمه المرور" required>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
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
