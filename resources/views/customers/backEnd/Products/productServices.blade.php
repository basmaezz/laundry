@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Services</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                                <a href="{{route('Customer.Products.addProductService',$product->id)}}"class="btn btn-info" style="float: right">New Service</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped col-7">
                                    <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Price </th>
                                        <th>Actions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->productService as $service)
                                        <tr>
                                            <td>{{$service->services}}</td>
                                            <td>{{$service->price}}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm" href="{{route('Customer.Products.edit',$product->id)}}"><i class="fas fa-pencil-alt"></i>Edit</a>
                                                <a class="btn btn-danger btn-sm" href="{{route('Customer.Products.deleteService',$service->id)}}"><i class="fas fa-trash"></i>Delete</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
