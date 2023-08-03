{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
{{--    <title>Laundry Dashboard </title>--}}

{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}

{{--    <link rel="stylesheet" href="{{asset('assets/customers/plugins/fontawesome-free/css/all.min.css')}}">--}}

{{--    <link rel="stylesheet" href="{{asset('assets/customers/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">--}}

{{--    <link rel="stylesheet" href="{{asset('assets/customers/dist/css/adminlte.min.css?v=3.2.0')}}">--}}
{{--    <script nonce="00457b8d-96fd-4c40-ac46-8807a41ed7a7">(function(w,d){!function(eK,eL,eM,eN){eK.zarazData=eK.zarazData||{};eK.zarazData.executed=[];eK.zaraz={deferred:[],listeners:[]};eK.zaraz.q=[];eK.zaraz._f=function(eO){return function(){var eP=Array.prototype.slice.call(arguments);eK.zaraz.q.push({m:eO,a:eP})}};for(const eQ of["track","set","debug"])eK.zaraz[eQ]=eK.zaraz._f(eQ);eK.zaraz.init=()=>{var eR=eL.getElementsByTagName(eN)[0],eS=eL.createElement(eN),eT=eL.getElementsByTagName("title")[0];eT&&(eK.zarazData.t=eL.getElementsByTagName("title")[0].text);eK.zarazData.x=Math.random();eK.zarazData.w=eK.screen.width;eK.zarazData.h=eK.screen.height;eK.zarazData.j=eK.innerHeight;eK.zarazData.e=eK.innerWidth;eK.zarazData.l=eK.location.href;eK.zarazData.r=eL.referrer;eK.zarazData.k=eK.screen.colorDepth;eK.zarazData.n=eL.characterSet;eK.zarazData.o=(new Date).getTimezoneOffset();if(eK.dataLayer)for(const eX of Object.entries(Object.entries(dataLayer).reduce(((eY,eZ)=>({...eY[1],...eZ[1]})))))zaraz.set(eX[0],eX[1],{scope:"page"});eK.zarazData.q=[];for(;eK.zaraz.q.length;){const e_=eK.zaraz.q.shift();eK.zarazData.q.push(e_)}eS.defer=!0;for(const fa of[localStorage,sessionStorage])Object.keys(fa||{}).filter((fc=>fc.startsWith("_zaraz_"))).forEach((fb=>{try{eK.zarazData["z_"+fb.slice(7)]=JSON.parse(fa.getItem(fb))}catch{eK.zarazData["z_"+fb.slice(7)]=fa.getItem(fb)}}));eS.referrerPolicy="origin";eS.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(eK.zarazData)));eR.parentNode.insertBefore(eS,eR)};["complete","interactive"].includes(eL.readyState)?zaraz.init():eK.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,0,"script");})(window,document);</script></head>--}}
{{--<body class="hold-transition login-page">--}}
{{--@yield('content')--}}

{{--<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>--}}

{{--<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}

{{--<script src="{{asset('assets/dist/js/adminlte.min.js?v=3.2.0')}}"></script>--}}
{{--</body>--}}
{{--</html>--}}
    <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{asset('assets/customers/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/customers/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/pages/page-auth.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/assets/css/style.css')}}">

</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
@yield('content')
<!-- END: Content-->

<script src="{{asset('assets/customers/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/scripts/pages/page-auth-login.js')}}"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->

</html>
