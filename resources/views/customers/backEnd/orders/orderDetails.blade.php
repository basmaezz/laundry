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
                            <li class="breadcrumb-item"><a href="{{route('Customer.Products.viewAllServices',Auth::user()->subCategory_id)}}">Orders</a></li>
                            <li class="breadcrumb-item active">order Details</li>
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
                                    <h3 class="card-title">Order Details</h3>
                                </div>
                                <div class="card-body">
                                    <h4>Input</h4>
                                    <div class="form-group">
                                        <label for="exampleInputBorder">اسم المغسله </label>
                                        <input type="text" class="form-control form-control-border" id="exampleInputBorder" value="{{$order->subCategories->name_ar}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم العميل</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->user->name}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم المندوب</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->delegate->appUser->name ??''}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المدينه  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->user->cities->name_ar}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->user->region_name}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">التاريخ  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->created_at}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> عدد القطع </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->count_products}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المبلغ المطلوب  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->total_price}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">كوبون   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->coupon}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">خصم   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->discount}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> ملاحظات  </label>
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

