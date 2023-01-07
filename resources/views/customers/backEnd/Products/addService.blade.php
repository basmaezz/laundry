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

                            <form id="quickForm" method="post" action="{{route('Customer.Products.createService')}}"enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <input type="hidden"  name="product_id" value="{{$product->id}}">
                                        <input type="hidden"  name="subcategory_id" value="{{$product->subcategory_id}}">
                                        <input type="text" name="services" class="form-control" id="exampleInputEmail1" value="{{$product->name_en}} " disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Service name </label>
                                        <input type="text" name="services" class="form-control" id="exampleInputEmail1" placeholder="product Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder=" Price...">
                                    </div>

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

