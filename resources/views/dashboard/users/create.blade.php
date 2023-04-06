@extends('../layouts.app')
@section('content')
    <main class="main">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">الأدمن</a></li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">

                                    <div class="card-header">
                                        <strong>اضافه مستخدم جديد </strong>
                                    </div>
                                    <div class="card-block">
                                        <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                    @csrf

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="text-input" name="name" class="form-control" value="{{ Request::old('name') }}" placeholder="الاسم الأول">

                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="text-input" name="last_name" class="form-control" value="{{ Request::old('last_name') }}"placeholder="الأسم الأخير">

                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الصلاحيه </label>
                                                <div class="col-md-9">
                                                    <select class="form-control"  name="role_id" required>
                                                        @foreach($roles as $key => $role)
                                                        <option value="{{$role}}">{{$key}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email-input" name="email" class="form-control"value="{{ Request::old('email') }}" placeholder="البريد الالكترونى ">

                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="password-input">كلمه المرور</label>
                                                <div class="col-md-9">
                                                    <input type="password" id="password-input" name="password" class="form-control" placeholder="كلمه المرور">

                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                                <div class="col-md-9">
                                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ Request::old('phone') }}"placeholder="الجوال" maxlength="10" >

                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">تاريخ الميلاد </label>
                                                <div class="col-md-9">
                                                    <input type="date" id="birthday" name="birthdate"placeholder="date" class="form-control" value="{{ Request::old('birthdate') }}">

                                                    @if ($errors->has('birthdate'))
                                                        <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input"> المستوى التعليمى </label>
                                                <div class="col-md-9">
                                                    <select name="level_id" id="level_id"  class="form-control" >
                                                        <option value="">المستوى التعليمى</option>
                                                        @foreach($levels as $key =>$level)
                                                        <option value="{{$level}}">{{$key}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('level_id'))
                                                        <span class="text-danger">{{ $errors->first('level_id') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ الانضمام للشركة   </label>
                                                <div class="col-md-9">
                                                    <input type="date" id="joinDate" name="joinDate"placeholder="date" class="form-control" value="{{ Request::old('joinDate') }}">

                                                    @if ($errors->has('joinDate'))
                                                        <span class="text-danger">{{ $errors->first('joinDate') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="file-input"class="form-control"accept="image/png, image/jpeg">صوره الملف الشخصى </label>
                                                <div class="col-md-9">
                                                    <input type="file" id="file-input" name="profileImage" class="form-control">
                                                    @if ($errors->has('profileImage'))
                                                        <span class="text-danger">{{ $errors->first('profileImage') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{route('users.index')}}" class="btn btn-sm btn-danger">الغاء</a></button>
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
