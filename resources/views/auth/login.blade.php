{{--<!DOCTYPE html>--}}
{{--<html lang="en"dir="rtl">--}}

{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">--}}
{{--    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">--}}
{{--    <meta name="author" content="Lukasz Holeczek">--}}
{{--    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">--}}
{{--    <title> Admin Dashboard</title>--}}
{{--    <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('assets/admin/css/simple-line-icons.css')}}" rel="stylesheet">--}}
{{--    <link href="{{asset('assets/admin/dest/style.css')}}" rel="stylesheet">--}}
{{--</head>--}}

{{--<body class="">--}}
{{--<div class="validationMsg" style="width: 600px">--}}
{{--    @if($errors->any())--}}
{{--        <div class="alert alert-danger" >--}}
{{--            <h6>{{$errors->first()}}</h6>--}}
{{--        </div>--}}
{{--    @elseif(session()->has('message'))--}}
{{--        <div class="alert alert-success"  >--}}
{{--            {{ session()->get('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--</div>--}}
{{--<div class="container" style="margin-top: 150px">--}}
{{--    <div class="row">--}}

{{--        <div class="col-md-4 m-x-auto pull-xs-none vamiddle">--}}
{{--            <div class="card-group border border-primary ">--}}
{{--                <div class="card p-a-2" style="border-radius: 29px">--}}

{{--                    <div class="card-block" class="border border-primary" >--}}
{{--                        <h4>تسجيل دخول</h4>--}}
{{--                        <p class="text-muted"></p>--}}
{{--                        <div class="input-group m-b-1">--}}
{{--                                <span class="input-group-addon"><i class="icon-user"></i>--}}
{{--                                </span>--}}
{{--                            <input type="text" class="form-control en" placeholder=" البريد الألكترونى.... " name="email"  autofocus required >--}}
{{--                       </div>--}}
{{--                        <div class="input-group m-b-2">--}}
{{--                                <span class="input-group-addon"><i class="icon-lock"></i>--}}
{{--                                </span>--}}
{{--                            <input type="password" class="form-control en" placeholder="كلمه المرور " name="password">--}}
{{--                            @if ($errors->has('password'))--}}
{{--                                <span class="text-danger">{{ $errors->first('password') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-xs-6">--}}
{{--                                <input type="submit" class="btn btn-primary p-x-2" value="تسجيل دخول">--}}

{{--                            </div>--}}
{{--                            <div class="col-xs-6 text-xs-right">--}}
{{--                                <button type="button" class="btn btn-link p-x-0">  </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="card card-inverse card-primary p-y-3" style="width:44%">--}}
{{--                    <div class="card-block text-xs-center">--}}
{{--                        <div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<script src="{{asset('assets/admin/js/libs/jquery.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/libs/tether.min.js')}}"></script>--}}
{{--<script src="{{asset('assets/admin/js/libs/bootstrap.min.js')}}"></script>--}}

{{--</body>--}}

{{--</html>--}}

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
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5 logoImg">
                                <img class="img-fluid" src="{{asset('assets/customers/app-assets/images/pages/login/logo.png')}}" alt="Login V2" /></div>
                        </div>
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title font-weight-bold mb-1">LAUNDRY! 👋</h2>
                                <p class="card-text mb-2"></p>

                                <form method="POST" action="{{ route('adminLogin') }}">
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
