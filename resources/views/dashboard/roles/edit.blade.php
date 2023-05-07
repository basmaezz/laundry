@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">

                    <form method="post" action="{{route('roles.update',$role->id)}}">
                        @csrf
                        <div class="col-sm-6">

                            <div class="card">
                                <div class="card-header">
                                    <strong> تعديل صلاحيه</strong>
                                </div>
                                <div class="card-block">

                                    <div class="form-group">
                                        <label class="col-md-3 form-control-label" for="hf-email">اسم الصلاحيه</label>

                                        <input type="hidden"  name="id" class="form-control" value="{{$role->id}}" >
                                        <input type="text"  name="role" class="form-control" value="{{$role->role}}" >
                                        @if ($errors->has('role'))
                                            <span class="text-danger">{{ $errors->first('role') }}</span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="company" >الصلاحيات</label>
                                        <div class="form-check">
                                            @foreach(config('abilities') as $ability =>$label)
                                                <label class="form-control check-ability-label">
                                                    <input type="checkbox" id="inline-checkbox1" name="abilities[]" value="{{$ability}}"@if(in_array($ability,($role->abilities ??[]))) checked @endif>{{$label}}
                                                    <br>
                                                </label>
                                            @endforeach
                                        </div>
                                        @if ($errors->has('abilities'))
                                            <span class="text-danger">{{ $errors->first('abilities') }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection

