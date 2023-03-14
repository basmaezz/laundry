@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">

            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="card">

                                <div class="card-header">
                                    <strong>  تعديل بيانات {{$user->name}} </strong>
                                </div>
                                <div class="card-block">
                                    <form action="{{route('user.updateProfile')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        @csrf
                                        @method('PATCH')
                                            <div class="card-body box-profile">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                         src="{{asset('assets/uploads/images/'.$user->avatar)}}"
                                                         alt="User profile picture">
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                            <div class="col-md-9">
                                                <input type="hidden"  name="id" class="form-control" value="{{Auth::user()->id}} "required>
                                                <input type="text" id="text-input" name="name" class="form-control" value="{{$user->name}} "required>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="last_name" class="form-control" value="{{$user->last_name}} "required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                            <div class="col-md-9">
                                                <input type="email" id="email-input" name="email" class="form-control" value=" {{$user->email}} "required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                            <div class="col-md-9">
                                                <input type="text" id="phone" name="phone" class="form-control"value="{{$user->phone}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">تاريخ الميلاد </label>
                                            <div class="col-md-9">
                                                <input type="date" id="birthday" name="birthdate" class="form-control" value="{{$user->birthdate}}"required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input"> المستوى التعليمى </label>
                                            <div class="col-md-9">
                                                <select name="level_id" id="level_id"  class="form-control" >
                                                    <option>المستوى التعليمى</option>
                                                    @foreach($levels as $level)
                                                        <option value="{{$level->id}}" {{$level->id==$user->level_id ? 'selected':''}}>{{$level->name}}</option>
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
                                                <input type="date" id="birthday" name="joinDate" class="form-control" value="{{$user->joindate}}">
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
