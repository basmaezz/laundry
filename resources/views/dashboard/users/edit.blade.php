@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('users.index')}}">الأدمن</a></li>
                <li class="breadcrumb-item active" aria-current="page">تعديل  الادمن</li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">

                                <div class="card-header">
                                    <strong>تعديل بيانات المستخدم</strong>
                                </div>
                                <div class="card-block">
                                    <form action="{{url('userUpdate/'.$user->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        @csrf
                                        <div class="card-body box-profile">
                                            <img class="profile-user-img img-fluid img-circle"
                                                 src="{{asset('assets/uploads/images/'.$user->avatar)}}"
                                                 alt="User profile picture">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                            <div class="col-md-9">
                                                <input type="hidden" id="text-input" name="id" class="form-control"value="{{$user->id}}">
                                                <input type="text" id="text-input" name="name" class="form-control"value="{{$user->name ??''}}">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                            <div class="col-md-9">
                                                <input type="text" id="last_name" name="last_name" class="form-control" value="{{$user->last_name}}">
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
                                                        <option value="{{$role->id}}" {{$user->hasRole($user)==$role->id ?'selected':''}}>{{$role->role}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                            <div class="col-md-9">
                                                <input type="email" id="email-input" name="email" class="form-control" value="{{$user->email}}">
                                            @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">كلمه المرور  </label>
                                            <div class="col-md-9">
                                                <input type="password" id="email-input" name="password" class="form-control" value="" placeholder="ادخل كلمه المرور الجديده">
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                            <div class="col-md-9">
                                                <input type="tel" id="phone" name="phone"class="form-control" value="{{$user->phone}}">

                                            @if ($errors->has('phone'))
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">تاريخ الميلاد </label>
                                            <div class="col-md-9">
                                                <input type="date" id="birthday" name="birthdate"placeholder="date" class="form-control" value="{{$user->birthdate}}" >

                                                @if ($errors->has('birthdate'))
                                                    <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"> المستوى التعليمى </label>
                                            <div class="col-md-9">
                                                <select name="level_id" id="level_id"  class="form-control" >
                                                    <option value="0">المستوى التعليمى</option>
                                                    @foreach($levels as $level)
                                                        <option value="{{$level->id}}"{{$user->level_id==$level->id ?'selected' :''}}>{{$level->name}}</option>
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
                                                <input type="date" id="joinDate" name="joinDate"placeholder="date" class="form-control" value="{{$user->joindate}}" >

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
