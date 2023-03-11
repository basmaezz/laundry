@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-9">
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
                                                    <input type="text" id="text-input" name="name" class="form-control" placeholder="الاسم الأول"required>

                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="text-input" name="last_name" class="form-control" placeholder="الأسم الأخير"required>

                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الصلاحيه </label>
                                                <div class="col-md-9">
                                                    <select class="form-control"  name="role_id">
                                                        @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->role}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email-input" name="email" class="form-control" placeholder="البريد الالكترونى "required>

                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="password-input">كلمه المرور</label>
                                                <div class="col-md-9">
                                                    <input type="password" id="password-input" name="password" class="form-control" placeholder="كلمه المرور"required>

                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                                <div class="col-md-9">
                                                    <input type="text" id="phone" name="phone" class="form-control"placeholder="الجوال" required>

                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">تاريخ الميلاد </label>
                                                <div class="col-md-9">
                                                    <input type="date" id="birthday" name="birthdate"placeholder="date" class="form-control"required>

                                                    @if ($errors->has('birthdate'))
                                                        <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input"> المستوى التعليمى </label>
                                                <div class="col-md-9">
                                                    <select name="level_id" id="level_id"  class="form-control" >
                                                        <option>المستوى التعليمى</option>
                                                        @foreach($levels as $level)
                                                        <option value="{{$level->id}}">{{$level->name}}</option>
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
                                                    <input type="date" id="birthday" name="joinDate"placeholder="date" class="form-control">

                                                    @if ($errors->has('joinDate'))
                                                        <span class="text-danger">{{ $errors->first('joinDate') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الملف الشخصى </label>
                                                <div class="col-md-9">
                                                    <input type="file" id="file-input" name="avatar" class="form-control">
                                                </div>
                                            </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> الغاء</button>
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
