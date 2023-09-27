<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Laundry Dashboard</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    @if(app()->getLocale()=="en")
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/extensions/toastr.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/bordered-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/semi-dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/pages/app-ecommerce.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/plugins/forms/pickers/form-pickadate.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/plugins/forms/form-wizard.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/plugins/forms/form-number-input.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/assets/css/style.css')}}">
    @elseif(app()->getLocale()=="ar")
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/extensions/toastr.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/themes/dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/themes/bordered-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/themes/semi-dark-layout.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/pages/app-ecommerce.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/plugins/forms/pickers/form-pickadate.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/plugins/forms/form-wizard.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/plugins/forms/form-number-input.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css-rtl/custom-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/assets/css/style-rtl.css')}}">
    @endif
</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

@include('customers.layouts.nav')
@yield('content')
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
@include('customers.layouts.footer')

<script src="{{asset('assets/customers/app-assets/vendors/js/vendors.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/scripts/pages/app-ecommerce-checkout.js')}}"></script>
<!-- END: Page JS-->

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
