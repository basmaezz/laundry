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
                                    <strong> تعديل بيانات مستخدم  </strong>
                                </div>
                                <div class="card-block">
                                    <form action="{{url('userUpdate/'.$user->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal ">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="disabled-input">الصلاحيه </label>
                                            <div class="col-md-9">
                                                @if($user->subCategory_id==null)
                                                <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="مدير الموقع" disabled>
                                                @else
                                                <input type="text" id="disabled-input" name="disabled-input" class="form-control" placeholder="أدمن مغسله " disabled>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأول</label>
                                            <div class="col-md-9">
                                                <input type="hidden" id="text-input" name="id" class="form-control"value="{{$user->id}}">
                                                <input type="text" id="text-input" name="name" class="form-control"value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الأسم الأخير</label>
                                            <div class="col-md-9">
                                                <input type="text" id="last_name" name="last_name" class="form-control" value="{{$user->last_name}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">البريد الألكترونى </label>
                                            <div class="col-md-9">
                                                <input type="email" id="email-input" name="email" class="form-control" value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">الجوال </label>
                                            <div class="col-md-9">
                                                <input type="tel" id="phone" name="phone"class="form-control" value="{{$user->phone}}">
                                            </div>
                                        </div>
                                        @if($user->level_id!=null)
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">تاريخ الميلاد </label>
                                            <div class="col-md-9">
                                                <input type="date" id="birthday" name="birthday"placeholder="date" class="form-control">
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
                                                <input type="date" id="joinDate" name="joindate" class="form-control" value="{{$user->joindate}}">
                                            </div>
                                        </div>
                                        @endif
                                        @if($user->avtar !='')
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="file-input">صوره الملف الشخصى </label>
                                            <div class="col-md-9">
                                                <input type="file" id="file-input" name="file-input">
                                        <img src="{{asset('assets/uploads/user/Image/'.$user->avatar)}}" style="width:200px;height:200px;padding:15px;border-radius:20px;">
                                            </div>
                                        </div>
                                        @endif
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                                        </div>

                                    </form>
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
