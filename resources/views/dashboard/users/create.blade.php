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
                                                <label class="col-md-3 form-control-label" for="disabled-input">الصلاحيه </label>
                                                <div class="col-md-9">
                                                    <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="مدير الموقع" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="text-input" name="name" class="form-control" placeholder="الاسم الأول"required>

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
                                                <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="text-input" name="last_name" class="form-control" placeholder="الأسم الأخير"required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email-input" name="email" class="form-control" placeholder="البريد الالكترونى "required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="password-input">كلمه المرور</label>
                                                <div class="col-md-9">
                                                    <input type="password" id="password-input" name="password" class="form-control" placeholder="كلمه المرور"required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                                <div class="col-md-9">
                                                    <input type="text" id="phone" name="phone" class="form-control"placeholder="الجوال" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">تاريخ الميلاد </label>
                                                <div class="col-md-9">
                                                    <input type="date" id="birthday" name="birthdate"placeholder="date" class="form-control"required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input"> المستوى التعليمى </label>
                                                <div class="col-md-9">
                                                    <select name="level_id" id="level_id"  class="form-control" >
                                                        @foreach($levels as $level)
                                                        <option value="{{$level->id}}">{{$level->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ الانضمام للشركة   </label>
                                                <div class="col-md-9">
                                                    <input type="date" id="birthday" name="joinDate"placeholder="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="file-input"class="form-control">صوره الملف الشخصى </label>
                                                <div class="col-md-9">
                                                    <input type="file" id="file-input" name="avatar" class="form-control">
                                                </div>
                                            </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
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
