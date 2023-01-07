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
<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-6">

        <div class="card">
            <div class="card-header">
                <strong> اضافه قطعه جديده</strong>
            </div>
            <div class="card-block">

                <div class="form-group">
                    <label for="company" n>اسم القطعه</label>
                    <input type="text" name="name_ar"class="form-control" id="name_ar" placeholder="اسم القطعه">
                    <input type="hidden" name="category_item_id"class="form-control" id="category_item_id" value="{{$categoryItem->id}}">
                    <input type="hidden" name="subcategory_id"class="form-control" id="subcategory_id" value="{{$categoryItem->subcategory_id}}">
                </div>
                <div class="form-group">
                    <label for="company" >اسم القطعه بالانجليزيه</label>
                    <input type="text" name="name_en"class="form-control" id="name_ar" placeholder="اسم القطعه بالانجليزيه">
                </div>
                <div class="form-group">
                    <label for="company" >الوصف  </label>
                    <input type="text" name="desc_ar"class="form-control" id="name_ar" placeholder="الوصف ">
                </div>
                <div class="form-group">
                    <label for="company" >الوصف  بالانجليزيه</label>
                    <input type="text" name="desc_en"class="form-control" id="name_ar" placeholder="الوصف  بالانجليزيه ">
                </div>
                <div class="form-group">
                    <label for="company">الصوره  </label>
                    <input type="file" name="subProductImage"class="form-control" id="image" >
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
    </div>
</form>
    </main>

@endsection

