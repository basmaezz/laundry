@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
{{--                        <ol class="breadcrumb float-sm-right">--}}
{{--                            <li class="breadcrumb-item"><a href="{{route('Customer.Products.viewAllServices',Auth::user()->subCategory_id)}}">Orders</a></li>--}}
{{--                            <li class="breadcrumb-item active">order Details</li>--}}
{{--                        </ol>--}}
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
                                    <h3 class="card-title">Order Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputBorder"> Laundry Name </label>
                                        <input type="text" class="form-control form-control-border" id="exampleInputBorder" value="{{$order->subCategories->name_ar}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>Customer name </label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->user->name}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>Delegate name </label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->delegate->appUser->name ??''}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">City  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->user->cities->name_ar}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Region  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->user->region_name}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Date  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->created_at}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> Pieces Count </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->count_products}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Price   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->total_price}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Coupon   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->coupon}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Discount   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->discount}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> Note  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->note}}"disabled>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @foreach($orderDetails as $orderDetail)
                    <div class="col-sm-5">
                        <div class="card">
                            <div class="card-header">
                                <strong>عرض تفاصيل القطع  </strong>

                            </div>

                            <div class="card-block">

                                <div class="form-group">
                                    <label for="company" n>اسم القطعه</label>
                                    <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->product->name_ar}}"disabled>
                                </div>
                                <div class="form-group">
                                    <label for="company" n>اسم الخدمه</label>
                                    <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->productService->services}}"disabled>
                                </div>
                                <div class="form-group">
                                    <label for="company" n>السعر </label>
                                    <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->price}}"disabled>
                                </div>
                                <div class="form-group">
                                    <label for="company">الكميه  </label>
                                    <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$orderDetail->quantity}}"disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>

        </section>
    </div>
@endsection

