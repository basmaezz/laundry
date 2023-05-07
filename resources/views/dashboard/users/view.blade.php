@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header">
                                    <strong> تعديل بيانات مستخدم  </strong>
                                </div>
                                <div class="card-block">

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="disabled-input">الصلاحيه </label>
                                            <div class="col-md-9">
                                                @if($user->level_id!=null)
                                                    <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="مدير الموقع" disabled>
                                                @else
                                                    <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="أدمن مغسله " disabled>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="name" class="form-control"value="{{$user->name}}"disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="last_name" class="form-control" value="{{$user->last_name}}"disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                            <div class="col-md-9">
                                                <input type="email" id="email-input" name="email" class="form-control" value="{{$user->email}}"disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                            <div class="col-md-9">
                                                <input type="email" id="email-input" name="email" class="form-control" value="{{$user->phone}}"disabled>
                                            </div>
                                        </div>
                                        @if($user->level_id!=null)
                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input">تاريخ الميلاد </label>
                                                <div class="col-md-9">
                                                    <input type="date" id="birthday" name="birthday"placeholder="date" value="{{$user->birthdate}}" class="form-control" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input"> المستوى التعليمى </label>
                                                <div class="col-md-9">
                                                    <select name="level_id" id="dog-names"  class="form-control" >
                                                        @foreach($levels as $level)
                                                            <option value="{{$level->id}}"{{ ( $level->id == $user->level_id) ? 'selected' : '' }}>{{$level->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-control-label" for="text-input"class="form-control"> تاريخ الانضمام للشركة   </label>
                                                <div class="col-md-9">
                                                    <input type="date" id="joinDate" name="joindate"placeholder="date" value="{{$user->joindate}}" class="form-control">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>
                                            <div class="col-md-9">

                                                <img src="{{asset('assets/uploads/user/image/'.$user->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </div>
                                        </div>
                                </div>

                            </div>


                        </div>

                        <!--/col-->
                    </div>
                    <!--/.row-->

                    <!--/col-->
                </div>
                <!--/row-->


            </div>
        </div>

        </div>
    </main>

@endsection
