@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه قسم</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('roles.update',$role->id)}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم الصلاحيه</label>
                            <div class="col-md-9">
                                <input type="hidden"  name="id" class="form-control" value="{{$role->id}}" >
                                <input type="text"  name="role" class="form-control" value="{{$role->role}}" >
                                @if ($errors->has('role'))
                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">الصلاحيات </label>
                            <div class="col-md-9">
                                @foreach(config('abilities') as $ability =>$label)
                                    <label class="checkbox-inline" for="inline-checkbox1">
                                        <input type="checkbox" id="inline-checkbox1" name="abilities[]" value="{{$ability}}"@if(in_array($ability,($role->abilities ??[]))) checked @endif>{{$label}}
                                    </label>
                                @endforeach
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
    </main>
@endsection

