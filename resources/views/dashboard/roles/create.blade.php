@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه صلاحيه جديد</h4>
                        </div>
                        <div class="card-body">

                            <form method="post" action="{{route('roles.store')}}">
                                @csrf
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name">اسم الصلاحيه </label>
                                    <input type="text" id="text-input" name="role" class="form-control" value="{{ Request::old('name') }}" placeholder="الاسم الأول" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">رجاء ادخل الاسم الاول</div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label" for="basic-addon-name"> الصلاحيات </label>
                                        <div class="custom-control custom-checkbox">

                                            @foreach(config('abilities') as $ability =>$label)
                                                <label class="form-control check-ability-label">
                                                    <input type="checkbox"  class="checkbox-ability" name="abilities[]" value="{{$ability}}"@if(in_array($ability,($role->abilities ??[]))) checked @endif>{{$label}}
                                                    <br>
                                                </label>
                                            @endforeach
                                        </div>
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
