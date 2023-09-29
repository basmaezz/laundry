@extends('customers.layouts.details-app')
@section('content')

    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">

                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="bs-stepper checkout-tab-steps">
                    <!-- Wizard starts -->
                    <div class="bs-stepper-header">

                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>

                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>

                        <div class="step" data-target="#step-cart">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="shopping-cart" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">{{__(('lang.orderDetails'))}}</span>
                                    <span class="bs-stepper-subtitle">{{__(('lang.orderDetails'))}}</span>
                                </span>
                            </button>
                        </div>

                        <div class="step" data-target="#step-address">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="home" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">{{__(('lang.customerDetails'))}}</span>
                                    <span class="bs-stepper-subtitle">{{__(('lang.customerDetails'))}}</span>
                                </span>
                            </button>
                        </div>
                        <div class="step" data-target="#step-payment">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="credit-card" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">{{__(('lang.delegateDetails'))}}</span>
                                    <span class="bs-stepper-subtitle">{{__(('lang.delegateDetails'))}}</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!-- Wizard ends -->

                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content" style="margin-top: 40px">
                            <div class="row pricing-card">
                                <div class="col-12 col-sm-offset-2 col-sm-10 col-md-12 col-lg-offset-2 col-lg-10 mx-auto">
                                    <div class="row">
                                        <!-- basic plan -->
                                        @foreach($orderDetails as $orderDetail)
                                            <div class="col-12 col-md-4">
                                                <div class="card basic-pricing text-center">
                                                    <div class="card-body">
                                                        <img src="{{$orderDetail->productTrashed->image}}" style="width:150px !important ;height:150px !important" />
                                                        @if(app()->getLocale()=='ar')
                                                            <h3>{{$orderDetail->productTrashed->name_ar}}</h3>
                                                        @elseif(app()->getLocale()=='en')
                                                            <h3>{{$orderDetail->productTrashed->name_en}}</h3>
                                                        @endif
                                                        <h3>{{$orderDetail->productTrashed->name_franco}}</h3>

                                                        <div class="annual-plan">

                                                            <small class="annual-pricing d-none text-muted"></small>
                                                        </div>
                                                        <ul class="list-group list-group-circle text-left">
                                                            @if(app()->getLocale()=='ar')
                                                                <li class="list-group-item">{{$orderDetail->productService->services}}</li>
                                                            @elseif(app()->getLocale()=='en')
                                                                <li class="list-group-item">{{$orderDetail->productService->services_en}}</li>
                                                            @endif
                                                            <li class="list-group-item">{{$orderDetail->productService->services_franco}}</li>
                                                            <li class="list-group-item">{{$orderDetail->quantity}}</li>

                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>

                                    @endforeach
                                    <!--/ basic plan -->


                                    </div>
                                    @if($order->audio_note!= Null)
                                        <div class="col-12 ">
                                            <div class="card basic-pricing text-center">
                                                <div class="card-body">
                                                    <audio controls>
                                                        <source src="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" type="audio/mpeg">
                                                    </audio>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Checkout Customer Address Starts -->
                        <div id="step-address" class="content">
                            <form id="checkout-address" class="list-view product-checkout">
                                <!-- Checkout Customer Address Left starts -->
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">{{__(('lang.customerDetails'))}}</h4>

                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-name">{{__('lang.customerName')}}:</label>
                                                    <input type="text" id="checkout-name" class="form-control" name="fname" value="{{$order->userTrashed->name}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-number">{{__('lang.city')}}:</label>
                                                    <input type="text" id="checkout-number" class="form-control" name="mnumber" value="{{$order->userTrashed->citiesTrashed->name_ar}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-apt-number">{{__('lang.region')}}</label>
                                                    <input type="text" id="checkout-apt-number" class="form-control" name="apt-number" value="{{$order->userTrashed->region_name}}" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-landmark">{{__('lang.address')}}:</label>
                                                    <input type="text" id="checkout-landmark" class="form-control" name="landmark"  value="{{$order->userTrashed->address}}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- Checkout Customer Address Ends -->
                        <!-- Checkout Payment Starts -->
                        <div id="step-payment" class="content">
                            <form id="checkout-payment" class="list-view product-checkout">
                                <div class="payment-type">
                                    <div class="card">
                                        <div class="card-header flex-column align-items-start">
                                            <h4 class="card-title">{{__('lang.delegateInformation')}}</h4>
                                        </div>
                                        <div class="card-body">

                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-name">{{__('lang.customerName')}}:</label>
                                                    <input type="text" id="checkout-name" class="form-control" name="fname" value="{{$order->userTrashed->name}}" />
                                                </div>
                                            </div>
                                            <hr class="my-2" />

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
