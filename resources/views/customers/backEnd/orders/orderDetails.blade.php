@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-body">
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
                                <div class="tab-pane active" id="customer" aria-labelledby="customer-tab" role="tabpanel">
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

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">{{__('lang.address')}}</label>
                                                    <input type="email" class="form-control" placeholder="Email" value="{{$order->userTrashed->address}}" name="email" id="email" disabled />
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
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
                                </div>

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
                                                    <th>{{__('lang.quantity')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orderDetails as $orderDetail)
                                                    <tr>

                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                        <img src="{{$orderDetail->image}}" style="width: 50px;height: 50px">
                                                            </div>
                                                        </td>         <td>
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
                                                                <input id="mobile" type="text" class="form-control" value="{{$orderDetail->quantity}}" disabled />
                                                            </div>
                                                        </td>


                                                    </tr>

                                                @endforeach
                                                </tbody>
                                            </table>



                                        </div>
                                        <div class="col-12">
                                            <div class="table-responsive border rounded mt-1">

                                                <div class="col-12">
                                                    <h4 class="mb-1">
                                                        <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                        <span class="align-middle">{{__('lang.note')}}</span>
                                                    </h4>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    @if($order->audio_note!= Null)
                                                        <audio controls>
                                                            <source src="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" type="audio/mpeg">
                                                        </audio>
                                                    @endif

                                                </div>
                                                </br>
                                                <div class="custom-control custom-checkbox">
                                                    @if($order->note!= Null)
                                                        <input id="mobile" type="text" class="form-control" value="{{$order->note}}" disabled />
                                                    @endif
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
