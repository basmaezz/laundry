@extends('../layouts.app')
@section('content')
<div class="content-body">
    <section class="bs-validation">
        <div class="row">
            <!-- Bootstrap Validation -->
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">اضافه مستخدم جديد</h4>
                    </div>
                    <div class="card-body">
                            <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data" >
                                @csrf
                            <div class="form-group">
                                <label class="form-label" for="basic-addon-name">الاسم الاول</label>
                                <input type="text" id="text-input" name="name" class="form-control" value="{{ Request::old('name') }}" placeholder="الاسم الأول" required>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">رجاء ادخل الاسم الاول</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-addon-name">الاسم الاخير</label>
                                <input type="text" id="text-input" name="last_name" class="form-control" value="{{ Request::old('last_name') }}"placeholder="الأسم الأخير" required>
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">رجاء ادخل الاسم الاخير</div>
                            </div>
                                <div class="form-group">
                                <label class="form-label" for="basic-addon-name"> الجوال</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ Request::old('phone') }}"placeholder="الجوال" maxlength="10" >

                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">رجاء ادخل الجوال</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-default-email1">البريد الالكترونى</label>
                                <input type="email" id="basic-default-email1" name="email" class="form-control"value="{{ Request::old('email') }}" placeholder="البريد الالكترونى " required>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter a valid email</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="basic-default-password1">Password</label>
                                <input type="password" id="basic-default-password1" class="form-control" name="password"  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please enter your password.</div>
                            </div>
                            <div class="form-group">

                                <label class="form-label" for="password">الصلاحيه </label>
                                <select class="form-control"  name="role_id" required>
                                    @foreach($roles as $key => $role)
                                        <option value="{{$role}}">{{$key}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">الصلاحيه</div>
                            </div>

                            <div class="form-group">
                                <label for="dob-bootstrap-val">تاريخ الميلاد</label>
                                <input type="date" id="birthday" name="birthdate"placeholder="date" class="form-control" value="{{ Request::old('birthdate') }}" required>

                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please Enter Your DOB</div>
                            </div>
                                <div class="form-group">
                                <label for="dob-bootstrap-val">تاريخ الانضمام للشركة </label>
                                <input type="date" id="joinDate" name="joinDate"placeholder="date" class="form-control" value="{{ Request::old('joinDate') }}" required>

                                <div class="valid-feedback">Looks good!</div>
                                <div class="invalid-feedback">Please Enter Your DOB</div>
                            </div>
                                <div class="form-group ">
                                    <label for="text-input"> المستوى التعليمى </label>

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
                            <div class="form-group">
                                <label for="customFile1">ًصوره الملف الشخصى</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile1" name="profileImage" required />
                                    <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                </div>
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
