@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Validation</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Validation</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Laundry information</h3>
                            </div>

                            <form id="quickForm" method="post" action="{{route('Customer.Products.update',$product->id)}}"enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <input type="hidden"  name="subcategory_id" value="{{Auth::user()->subCategory_id}}">
                                        <select class="form-control">{{$product->categoryItem->name_en}}
                                            <option value="{{$product->categoryItem->id}}" >{{$product->categoryItem->category_type}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product name</label>
                                        <input type="text" name="name_en" class="form-control" id="exampleInputEmail1" value="{{$product->name_en}}">
                                        <input type="hidden" name="user_id" class="form-control" id="exampleInputEmail1"  value="{{Auth::user()->id}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Product name (AR)</label>
                                        <input type="text" name="name_ar" class="form-control" id="exampleInputEmail1" value="{{$product->name_ar}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="text" name="desc_en" class="form-control" id="exampleInputEmail1" value="{{$product->desc_en}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description (AR)</label>
                                        <input type="text" name="desc_ar" class="form-control" id="exampleInputEmail1" value="{{$product->desc_ar}}">
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputEmail1">Product Name</label>--}}
{{--                                        <input type="file" name="image" class="form-control" id="exampleInputEmail1" value="{{$product->}}">--}}
{{--                                    </div>--}}
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

