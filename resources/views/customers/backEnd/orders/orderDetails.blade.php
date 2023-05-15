@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
        <div>
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
        <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Order Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputBorder"> Laundry Name </label>
                                        <input type="text" class="form-control form-control-border" id="exampleInputBorder" value="{{$order->subCategoriesTrashed->name_ar}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>Customer name </label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->userTrashed->name}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>Delegate name </label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->delegateTrashed->appUserTrashed->name ??''}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">City  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->userTrashed->citiesTrashed->name_ar}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Region  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->userTrashed->region_name}}"disabled>
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
                    @foreach($orderDetails as $orderDetail)
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong>عرض تفاصيل القطع  </strong>

                                </div>

                                <div class="card-block">

                                    <div class="form-group">
                                        <label for="company" >اسم القطعه</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->productTrashed->name_ar}}"disabled>
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
                    @if($order->audio_note!= Null)
                        <div class="form-group">
                            <label for="company"> الملاحظات الصوتيه </label>
                            <br>
                            <audio controls>
                                <source src="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" type="audio/mpeg">
                            </audio>
                            <a class="btn btn-info" href="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" download style="margin-top: -32px;">Download</a>
                        </div>
                    @endif
                    </div>

                </div>

        </section>
    </div>
@endsection

