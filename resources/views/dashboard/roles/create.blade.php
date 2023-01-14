@extends('../layouts.app')
@section('content')
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه قسم</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('roles.store')}}" >
                        @csrf
                        <div class="mb-5">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" name="role" class="form-control"  >
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">Inline Checkboxes</label>
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

