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
                    <strong>Horizontal</strong>Form
                </div>
                <div class="card-block">
                    <form method="post" action="{{Route('CategoryItems.update',$categoryItem->id)}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم القسم</label>
                            <div class="col-md-9">
{{--                                <input type="hidden"  name="subcategory_id" class="form-control" value="{{$categoryItem->id}}"  >--}}
                                <input type="text"  name="category_type" class="form-control" value="{{$categoryItem->category_type}}">
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

