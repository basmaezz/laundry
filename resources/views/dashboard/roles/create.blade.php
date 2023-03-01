@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه قسم</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('roles.store')}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم الصلاحيه</label>
                            <div class="col-md-9">
                                <input type="text"  name="role" class="form-control" placeholder="اسم الصلاحيه " >
                                @if ($errors->has('role'))
                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                @endif
                            </div>
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
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> الغاء</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

