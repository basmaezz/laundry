@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div>
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
        <div>
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Items Table</h3>
{{--                                <a href="{{route('Customer.Items.create',Auth::user()->subCategory_id)}}"class="btn btn-info" style="float: right">New Item</a>--}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped col-7">
                                    <thead>
                                    <tr>
                                        <th>Item Name</th>
                                      <th>ِActions</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categoryItems as $item)
                                    <tr>
                                        <td>{{$item->category_type}}</td>
                                        <td>
                                            <a href="{{route('Customer.Products.index',$item->id)}}"class="btn btn-info">pieces</a>
{{--                                            <a href="{{route('Customer.Items.delete',$item->id)}}"class="btn btn-danger">Delete</a>--}}
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
