@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div class="container-fluid">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">المغاسل   </li>
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
                            <input type="hidden" value="{{$id}}" id="laundry_id">
                            <tr>
                                <th>رقم الطلب  </th>
                                <th>اسم العميل</th>
                                <th>اسم المندوب</th>
                                <th>حاله الطلب</th>
                                <th> المبلغ الاجمالى</th>
                                <th>المبلغ المستحق </th>
                                <th>التاريخ</th>
                                <th>الاجراءات </th>
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
            var id= document.getElementById('laundry_id').value;

            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('laundries.orders',$id) }}",
                data: { id: id},
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'userTrashed',
                    name: 'userTrashed'
                },{
                    data: 'delegateTrashed',
                    name: 'delegateTrashed'
                },{
                    data:'status',
                    name:'status'
                },{
                    data:'total_price',
                    name:'total_price'
                },{
                    data:'percentage',
                    name:'percentage'
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
