@extends('customers.layouts.app')
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="auth-wrapper auth-v2">
                <div class="auth-inner row m-0">
                    <!-- Brand logo--><a class="brand-logo" href="javascript:void(0);">
                    </a>
                    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('assets/customers/app-assets/images/pages/login/logo.png')}}" alt="Login V2" /></div>
                    </div>
                    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                            <h2 class="card-title font-weight-bold mb-1">LAUNDRY! 👋</h2>
                            <p class="card-text mb-2"></p>

                                <form method="POST" class="auth-login-form mt-2" action="{{ route('customer.customerLogin') }}">
                                    @csrf
                                <div class="form-group">
                                    <label class="form-label" for="login-email">Email</label>
                                    <input class="form-control" id="login-email" type="text" name="email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" />
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="login-password">Password</label><a href="page-auth-forgot-password-v2.html"><small>Forgot Password?</small></a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                                        <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                    </div>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <div class="custom-control custom-checkbox">--}}
{{--                                        <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />--}}
{{--                                        <label class="custom-control-label" for="remember-me"> Remember Me</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
