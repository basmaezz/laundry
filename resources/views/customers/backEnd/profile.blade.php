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
                                        <i data-feather="user"></i><span class="d-none d-sm-block">{{__(('lang.profile'))}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                        <i data-feather="info"></i><span class="d-none d-sm-block">{{__(('lang.laundryDetails'))}}</span>
                                    </a>
                                </li>
                           </ul>
                            <div class="tab-content">
                                <!-- Account Tab starts -->
                                <div class="tab-pane active" id="customer" aria-labelledby="customer-tab" role="tabpanel">
                                    <form class="form-validate">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="mb-1">
                                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                    <span class="align-middle">{{__('lang.profile')}}</span>
                                                </h4>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="username">{{__('lang.firstname')}}</label>

                                                    <input type="text" class="form-control" placeholder="Username" value="{{Auth::user()->name}}" name="username" id="username" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">{{__('lang.lastname')}}</label>
                                                    <input type="text" class="form-control" placeholder="Name" value="{{Auth::user()->last_name}}" name="name" id="name" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">{{__('lang.email')}}</label>
                                                    <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}" name="email" id="email" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">{{__('lang.phone')}}</label>
                                                    <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->phone}}" name="email" id="email" disabled />
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
                                <!-- Account Tab ends -->

                                <!-- Information Tab starts -->
                                <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">

                                    <form class="form-validate">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="mb-1">
                                                    <i data-feather="user" class="font-medium-4 mr-25"></i>
                                                    <span class="align-middle">{{__('lang.laundryDetails')}}</span>
                                                </h4>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.laundryName')}}</label>
                                                    <input type="text" class="form-control" placeholder="Username" value="{{$laundry['name_'.app()->getLocale()]}}" name="username" id="username" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.urgentWash')}}</label>
                                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$laundry->urgentWash ==1 ? 'نعم' :'لا'}}"disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.city')}}</label>
                                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$laundry->urgentWash ==1 ? 'نعم' :'لا'}}"disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.address')}}</label>
                                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$laundry->address}}"disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.location')}}</label>
                                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$laundry->location}}"disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.range')}}</label>
                                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$laundry->range}}"disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.delivery')}}</label>
                                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$laundry->price}} "disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mobile">{{__('lang.approximate_duration')}}</label>
                                                    <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$laundry->approximate_duration}}"disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="company">مواعيد الدوام</label>
                                                    @if($laundry->around_clock ==1)
                                                        <input type="text" name="address"class="form-control view" id="name_ar" value="طوال اليوم"disabled>
                                                    @else
                                                        <input type="text" name="address"class="form-control view" id="name_ar" value="{{abs($hours=((int)$laundry->clock_end)-((int)$laundry->clock_at))}}"disabled>

                                                    @endif
                                                </div>
                                            </div>


                                        </div>
                                    </form>

                                </div>
                                <!-- Information Tab ends -->

                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>

@endsection
