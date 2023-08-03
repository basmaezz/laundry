<!DOCTYPE html>
<html class="loading bordered-layout" lang="en" data-layout="bordered-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>DataTables - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/themes/semi-dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/customers/assets/css/style.css')}}">


</head>


<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">


<div class="app-content content ">
            <!-- Basic table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Em</th>
                                    <th>Date</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </section>

        </div>

<script src="{{asset('assets/customers/app-assets/vendors/js/vendors.min.js')}}"></script>

<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('assets/customers/app-assets/js/scripts/tables/table-datatables-basic.js')}}"></script>
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
