@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div>
            <div class="animated fadeIn">
                <div class="row">

                    <form method="post" action="{{route('roles.store')}}">
                        @csrf
                        <div class="col-sm-6">

                            <div class="card">
                                <div class="card-header">
                                    <strong> اضافه صلاحيه جديده</strong>
                                </div>
                                <div class="card-block">

                                    <div class="form-group">
                                        <label class="col-md-3 form-control-label" for="hf-email">اسم الصلاحيه</label>

                                        <input type="text"  name="role" class="form-control" value="{{Request::old('role')}}" >
                                        @if ($errors->has('role'))
                                            <span class="text-danger">{{ $errors->first('role') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 form-control-label">الصلاحيات </label>
                                        <div class="form-check">
                                            @foreach(config('abilities') as $ability =>$label)
                                                <label class="form-control check-ability-label">
                                                    <input type="checkbox"  class="checkbox-ability" name="abilities[]" value="{{$ability}}"@if(in_array($ability,($role->abilities ??[]))) checked @endif>{{$label}}
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
                               <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                                <button type="reset" class="btn btn-sm btn-danger customOrder"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection

