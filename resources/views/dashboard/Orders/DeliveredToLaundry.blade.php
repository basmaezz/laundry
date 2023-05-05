@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">الطلبات المنتهيه   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>

                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <tr>
                                <th>رقم الطلب  </th>
                                <th>اسم المغسله </th>
                                <th>اسم العميل </th>
                                <th> نوع التوصيل </th>
                                <th> المده المستغرقه  </th>
                                <th> تاريخ وصول المغسله  </th>
                                <th>التفاصيل</th>
                            </tr>
                            </thead>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('javascripts')
    <script type="text/javascript">
        $(function() {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('Order.DeliveredToLaundry') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'category',
                    name: 'category'
                },{
                    data: 'user',
                    name: 'user'
                },{
                    data:'delegate',
                    name:'delegate'
                },{
                    data:'duration',
                    name:'duration'
                },{
                    data:'created_at',
                    name:'created_at'
                },{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

                ]
            });
        });
    </script>
@endpush
