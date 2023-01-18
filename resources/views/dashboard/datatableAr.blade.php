<html>
<head>
    <!--   External CSS  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet"> </link>
    <link rel="stylesheet" href="{{asset('assets/admin/ar/datatableStyle.css')}}">
</head>

<body>

<div class="main-content">
    <div class="row">
        <div class="col col-md-6">
            <h3>   جدول بيانات عربي بسيط باستخدام بوتستراب اربعة</h3>
        </div>
        <div class="col col-md-6" style="    text-align: right!important;
    float: right;">
            <h3> Simple RTL (arabic) DataTable using bootstrap 4</h3>

        </div>
    </div>


    <table id="files_list" class="table table-striped dt-responsive  " style="width:100%">
        <thead class="thead_dark">
        <tr>
            <th class="th_text">اسم المستخدم</th>
            <th class="th_text">دور المستخدم</th>
            <th class="th_text">الرقم الوظيفي</th>
            <th class="th_text">تاريخ الالتحاق</th>
            <th class="th_text">الادارة</th>
            <th class="th_text">رابط الملف</th>
            <th class="th_text">تحميل الملف</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>نزار المرزوقي</td>
            <td>مصمم واب</td>
            <td>456</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>محدمد بن  المهدي</td>
            <td>مبرمج</td>
            <td>300</td>
            <td>11/05/2017</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>نزار المرزوقي</td>
            <td>مصمم واب</td>
            <td>456</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>دافنشي</td>
            <td>محلل فني</td>
            <td>406</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>علي احمد</td>
            <td>مدير</td>
            <td>366</td>
            <td>04/25/2015</td>
            <td>ادارة الموارد البشرية</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>محمد السيد</td>
            <td>مسوق</td>
            <td>426</td>
            <td>11/09/2019</td>
            <td>ادارة التسويق</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>مالك جابر</td>
            <td>خدمة العملاء</td>
            <td>416</td>
            <td>11/09/2019</td>
            <td>ادارة الشحن</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>نزار المرزوقي</td>
            <td>مصمم واب</td>
            <td>456</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>نزار المرزوقي</td>
            <td>مصمم واب</td>
            <td>456</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>نزار المرزوقي</td>
            <td>مصمم واب</td>
            <td>456</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>نزار المرزوقي</td>
            <td>مصمم واب</td>
            <td>456</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        <tr>
            <td>نزار المرزوقي</td>
            <td>مصمم واب</td>
            <td>456</td>
            <td>11/09/2019</td>
            <td>ادارة الانتاج</td>
            <td>htp://www.devinshi.com</td>
            <td>
                <button class="btn btn-sm btn-download btn-info "> <i class="fas fa-arrow-circle-down"></i> </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<script src="{{asset('assets/admin/ar/datatableScript.js')}}"></script>


</body>
</html>
