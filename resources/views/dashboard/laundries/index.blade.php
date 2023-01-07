@extends('../layouts.app')
@section('content')
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">خانه</li>
            <li class="breadcrumb-item"><a href="#">مدیریت</a>
            </li>
            <li class="breadcrumb-item active">داشبرد</li>

            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;داشبرد</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;تنظیمات</a>
                </div>
            </li>
        </ol>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> المغاسل المسجله
                                <a href="{{route('laundries.create')}}" class="btn btn-primary" style="float:left;margin-top: 2px;">اضافه مغسله </a>

                            </div>
                            <div class="card-block">
                                <table class="table table-striped"id="yajra-datatable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المغسله </th>
                                        <th> المدينه </th>
                                        <th>العنوان</th>
                                        <th>التفعيل</th>
                                        <th>الاجراءات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>

    <script>
        $('#yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('laundries.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name_en', name: 'name_en' },
                {data: 'city', name: 'city.name_ar',searchable: true},
                {data: 'address', name: 'address' },
                {data: 'checkbox', name: 'checkbox'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],

            'columnDefs': [ {

                'targets': [1,2,3,4],
                'orderable': true,
            }]
        });

    </script>
    <script>

        function changeStatus(id){
            console.log(id)
            let status = $(this).prop('checked') == true ? 1 : 0;
            let laundryId=id
            $.ajax({

                type: "GET",
                dataType: "json",
                url: 'laundryUpdateStats/'.laundryId,
                data: {'status': status, 'id': laundryId},
                success: function(data){
                    console.log(data)
                    console.log(data.success)
                }

            });
        }
    </script>
@endsection

