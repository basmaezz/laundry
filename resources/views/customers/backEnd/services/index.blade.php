{{--@extends('customers.layouts.dashboard-app')--}}
{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <!-- Content Header (Page header) -->--}}
{{--        <section class="content-header">--}}
{{--        <div>--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}

{{--                    </div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
{{--                            <li class="breadcrumb-item active">DataTables</li>--}}
{{--                        </ol>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

{{--        <section class="content">--}}
{{--        <div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-8">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Services</h3>--}}
{{--                                <a href="{{route('Customer.Products.create',Auth::user()->subCategory_id)}}"class="btn btn-info" style="float: right">New Item</a>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <div class="card-body">--}}
{{--                                <table id="example1" class="table table-bordered table-striped col-7">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Service Name</th>--}}
{{--                                        <th>Price </th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($productService as $service)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$service->services}}</td>--}}
{{--                                            <td>{{$service->price}}</td>--}}
{{--                                            <td>--}}
{{--                                                <a class="btn btn-danger btn-sm" href="#">Delete </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}

{{--                                </table>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--@endsection--}}
@extends('customers.layouts.dashboard-app')
@section('content')
    <section id="responsive-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Responsive Datatable</h4>
                    </div>
                    <div class="card-datatable">
                        <table class="dt-responsive table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Salary</th>
                                <th>Age</th>
                                <th>Experience</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Post</th>
                                <th>City</th>
                                <th>Date</th>
                                <th>Salary</th>
                                <th>Age</th>
                                <th>Experience</th>
                                <th>Status</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
