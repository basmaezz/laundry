@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>  تعديل بيانات {{$user->name}} </strong>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.updateProfile')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                @method('PATCH')
                                <div class="card-body box-profile">
                                    <img class="profile-user-img img-fluid img-circle" style="  width: 120px;border-radius: 27%; align: center"
                                         src="{{asset('assets/uploads/images/'.$user->avatar)}}"
                                         alt="User profile picture">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">الاسم الاول</label>
                                    <input type="hidden"  name="id" class="form-control view" value="{{Auth::user()->id}} "required>
                                    <input type="text" id="text-input" name="name" class="form-control view" value="{{$user->name}} "required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاول</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">الاسم الاخير</label>
                                    <input type="text" id="text-input" name="last_name" class="form-control view" value="{{$user->last_name}} "required>
                                @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاخير</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name"> الجوال</label>
                                    <input type="text" id="phone" name="phone" class="form-control view"value="{{$user->phone}}" maxlength="10" required>


                                @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الجوال</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-default-email1">البريد الالكترونى</label>
                                    <input type="email" id="email-input" name="email" class="form-control view" value=" {{$user->email}} "required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="dob-bootstrap-val">تاريخ الميلاد</label>
                                    <input type="date" id="birthday" name="birthdate" class="form-control view" value="{{$user->birthdate}}"required>

                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Enter Your DOB</div>
                                </div>
                                <div class="form-group">
                                    <label for="dob-bootstrap-val">تاريخ الانضمام للشركة </label>
                                    <input type="date" id="birthday" name="joinDate" class="form-control view" value="{{$user->joindate}}">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please Enter Your DOB</div>
                                </div>
                                <div class="form-group ">
                                    <label for="text-input"> المستوى التعليمى </label>

                                    <select name="level_id" id="level_id"  class="form-control" >
                                        <option>المستوى التعليمى</option>
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}" {{$level->id==$user->level_id ? 'selected':''}} required>{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('level_id'))
                                        <span class="text-danger">{{ $errors->first('level_id') }}</span>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label for="customFile1">ًصوره الملف الشخصى</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile1" name="avatar" required />
                                        <label class="custom-file-label" for="customFile1">Choose profile pic</label>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12">
                                   <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
