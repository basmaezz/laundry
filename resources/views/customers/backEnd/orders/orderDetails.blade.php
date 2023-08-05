{{--@extends('customers.layouts.dashboard-app')--}}
{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <section class="content-header">--}}
{{--        <div>--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- /.container-fluid -->--}}
{{--        </section>--}}
{{--        <section class="content">--}}
{{--        <div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-6">--}}
{{--                        <div class="card card-primary">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h3 class="card-title">Order Details</h3>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="exampleInputBorder"> Laundry Name </label>--}}
{{--                                        <input type="text" class="form-control form-control-border" id="exampleInputBorder" value="{{$order->subCategoriesTrashed->name_ar}}">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company" n>Customer name </label>--}}
{{--                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->userTrashed->name}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company" n>Delegate name </label>--}}
{{--                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->delegateTrashed->appUserTrashed->name ??''}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">City  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->userTrashed->citiesTrashed->name_ar}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">Region  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->userTrashed->region_name}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">Date  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->created_at}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company"> Pieces Count </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->count_products}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">Price   </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->total_price}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">Coupon   </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->coupon}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">Discount   </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->discount}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company"> Note  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->note}}"disabled>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @foreach($orderDetails as $orderDetail)--}}
{{--                        <div class="col-sm-5">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <strong>عرض تفاصيل القطع  </strong>--}}

{{--                                </div>--}}

{{--                                <div class="card-block">--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="company" >اسم القطعه</label>--}}
{{--                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->productTrashed->name_ar}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company" n>اسم الخدمه</label>--}}
{{--                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->productService->services}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company" n>السعر </label>--}}
{{--                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->price}}"disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">الكميه  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$orderDetail->quantity}}"disabled>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    @if($order->audio_note!= Null)--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="company"> الملاحظات الصوتيه </label>--}}
{{--                            <br>--}}
{{--                            <audio controls>--}}
{{--                                <source src="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" type="audio/mpeg">--}}
{{--                            </audio>--}}
{{--                            <a class="btn btn-info" href="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" download style="margin-top: -32px;">Download</a>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--        </section>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('customers.layouts.dashboard-app')
@section('content')


<div class="app-content content ">

    <div class="content-wrapper">

        <div class="content-body">
            <!-- users edit start -->
            <section class="app-user-edit">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center active" id=customer-tab" data-toggle="tab" href="#customer" aria-controls="customer" role="tab" aria-selected="true">
                                    <i data-feather="user"></i><span class="d-none d-sm-block">{{__(('lang.customerDetails'))}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                    <i data-feather="info"></i><span class="d-none d-sm-block">{{__(('lang.delegateDetails'))}}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                    <i data-feather="share-2"></i><span class="d-none d-sm-block">{{__(('lang.orderDetails'))}}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Account Tab starts -->
                            <div class="tab-pane active" id="customer" aria-labelledby="customer-tab" role="tabpanel">

                                <!-- users edit account form start -->
                                <form class="form-validate">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="mb-1">
                                                <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                <span class="align-middle">{{__('lang.delegateInformation')}}</span>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="username">{{__('lang.customerName')}}</label>

                                                <input type="text" class="form-control" placeholder="Username" value="{{$order->userTrashed->name}}" name="username" id="username" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">{{__('lang.city')}}</label>
                                                <input type="text" class="form-control" placeholder="Name" value="{{$order->userTrashed->citiesTrashed->name_ar}}" name="name" id="name" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">{{__('lang.region')}}</label>
                                                <input type="email" class="form-control" placeholder="Email" value="{{$order->userTrashed->region_name}}" name="email" id="email" disabled />
                                            </div>
                                        </div>


                                    </div>
                                </form>
                                <!-- users edit account form ends -->
                            </div>
                            <!-- Account Tab ends -->

                            <!-- Information Tab starts -->
                            <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                <!-- users edit Info form start -->
                                <form class="form-validate">
                                    <div class="row mt-1">
                                        <div class="col-12">
                                            <h4 class="mb-1">
                                                <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                <span class="align-middle">{{__('lang.delegateInformation')}}</span>
                                            </h4>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label for="mobile">{{__('lang.delegateName')}}</label>
                                                <input type="text" class="form-control" placeholder="Username" value="{{$order->delegateTrashed->appUserTrashed->name ??''}}" name="username" id="username" disabled />

                                            </div>
                                        </div>

                                    </div>
                                </form>
                                <!-- users edit Info form ends -->
                            </div>
                            <!-- Information Tab ends -->

                            <!-- Social Tab starts -->
                            <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                <div class="col-12">
                                    <div class="table-responsive border rounded mt-1">
                                        <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                            <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                            <span class="align-middle">{{__('lang.orderInformation')}}</span>
                                        </h6>
                                        <table class="table table-striped table-borderless">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>{{__('lang.pieceName')}}</th>
                                                <th>{{__('lang.serviceName')}}</th>
                                                <th>{{__('lang.price')}}</th>
                                                <th>{{__('lang.quantity')}}</th>
                                                <th>{{__('lang.audioNote')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orderDetails as $orderDetail)
                                            <tr>

                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input id="mobile" type="text" class="form-control" value="{{$orderDetail->productTrashed->name_ar}}" disabled />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input id="mobile" type="text" class="form-control" value="{{$orderDetail->productService->services}}" disabled />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input id="mobile" type="text" class="form-control" value="{{$orderDetail->price}}" disabled />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input id="mobile" type="text" class="form-control" value="{{$orderDetail->quantity}}" disabled />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        @if($order->audio_note!= Null)
                                                        <audio controls>
                                                            <source src="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" type="audio/mpeg">
                                                        </audio>
                                                        <a class="btn btn-info" href="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" download style="margin-top: -32px;">Download</a>
                                                        @endif
                                                    </div>
                                                </td>


                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Social Tab ends -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->

        </div>
    </div>
</div>

@endsection
