<!DOCTYPE html>
<html lang="en"dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
    <meta name="author" content="Lukasz Holeczek">
    <meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">
    <title> Admin Dashboard</title>
    <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/dest/style.css')}}" rel="stylesheet">
</head>

<body class="">
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-md-8 m-x-auto pull-xs-none vamiddle">
            <div class="card-group ">
                <div class="card p-a-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="card-block" >
                        <h1>تسجيل دخول</h1>
                        <p class="text-muted"></p>
                        <div class="input-group m-b-1">
                                <span class="input-group-addon"><i class="icon-user"></i>
                                </span>
                            <input type="text" class="form-control en" placeholder=" Email.... " name="email" required autofocus>
                       </div>
                        <div class="input-group m-b-2">
                                <span class="input-group-addon"><i class="icon-lock"></i>
                                </span>
                            <input type="password" class="form-control en" placeholder="Password " name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="submit" class="btn btn-primary p-x-2" value="تسجيل دخول">

                            </div>
                            <div class="col-xs-6 text-xs-right">
                                <button type="button" class="btn btn-link p-x-0">  </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="card card-inverse card-primary p-y-3" style="width:44%">
                    <div class="card-block text-xs-center">
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/admin/js/libs/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/tether.min.js')}}"></script>
<script src="{{asset('assets/admin/js/libs/bootstrap.min.js')}}"></script>

</body>

</html>

