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
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{url('laundryStore')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>اضافه مغسله جديده</strong>

                                </div>
                                <div class="card-block">
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">التصنيف </label>--}}
{{--                                        <select class="form-control" name="category_id" value="">--}}
{{--                                            <option>{{$subCategory->category->name_ar}}</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label for="company" n>اسم المغسله</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->name_ar}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم المغسله بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$subCategory->name_en}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">العنوان</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->address}}"disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="country">صوره الشعار</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

