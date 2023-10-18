
{{--                                        <div class="form-group row">--}}
{{--                                            <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>--}}
{{--                                            <div class="col-md-9">--}}


{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}


{{--                        </div>--}}

{{--                        <!--/col-->--}}
{{--                    </div>--}}
{{--                    <!--/.row-->--}}

{{--                    <!--/col-->--}}
{{--                </div>--}}
{{--                <!--/row-->--}}


{{--            </div>--}}
{{--        </div>--}}

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
                            <h4 class="card-title">تعديل  الادمن</h4>
                        </div>
                        <div class="card-body">

                                @csrf
                                <div class="card-body box-profile">
                                    <img class="profile-user-img img-fluid img-circle" style="  width: 120px;border-radius: 27%; align: center"
                                         src="{{asset('assets/uploads/images/'.$user->avatar)}}"
                                         alt="User profile picture">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">الاسم الاول</label>
                                    <input type="text" id="text-input" name="name" class="form-control"value="{{$user->name}}"disabled>

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">الاسم الاخير</label>
                                 <input type="text" id="text-input" name="last_name" class="form-control" value="{{$user->last_name}}"disabled>

                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name"> الجوال</label>
                                    <input type="email" id="email-input" name="email" class="form-control" value="{{$user->phone}}"disabled>


                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="basic-default-email1">البريد الالكترونى</label>
                                    <input type="email" id="email-input" name="email" class="form-control" value="{{$user->email}}"disabled>

                                </div>


                                <div class="form-group">

                                    <label class="form-label" for="password">الصلاحيه </label>
                                    @if($user->level_id!=null)
                                        <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="مدير الموقع" disabled>
                                    @else
                                        <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="أدمن مغسله " disabled>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="dob-bootstrap-val">تاريخ الميلاد</label>
                                    <input type="date" id="birthday" name="birthday"placeholder="date" value="{{$user->birthdate}}" class="form-control" disabled>

                                </div>
                                <div class="form-group">
                                    <label for="dob-bootstrap-val">تاريخ الانضمام للشركة </label>
                                <input type="date" id="joinDate" name="joindate"placeholder="date" value="{{$user->joindate}}" class="form-control">
                                </div>
                                <div class="form-group ">
                                    <label for="text-input"> المستوى التعليمى </label>
                                    <select name="level_id" id="dog-names"  class="form-control" >
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}"{{ ( $level->id == $user->level_id) ? 'selected' : '' }}>{{$level->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="customFile1">ًصوره الملف الشخصى</label>
                                    <div class="custom-file">
                                        <img src="{{asset('assets/uploads/user/image/'.$user->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
@endsection
