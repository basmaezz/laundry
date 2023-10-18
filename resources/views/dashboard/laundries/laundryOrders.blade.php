@extends('layouts.dataTable-app')
@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

        <div class="content-body">

            <section id="multilingual-datatable">
                <a href="{{route('laundries.export')}}" class="btn btn-info"  >Export </a>
                 <div class="row">

                    <div class="col-12">
                        <div class="card invoice-list-wrapper">
                            <div class="card-datatable table-responsive">
                                <table class="productTable table" id="laundryTable">
                                    <thead>
                                    <input type="hidden" value="{{$id}}" id="laundry_id">
                                    <tr>
                                        <th>رقم الطلب  </th>
                                        <th>اسم العميل</th>
                                        <th>اسم المندوب</th>
                                        <th>حاله الطلب</th>
                                        <th> المبلغ الاجمالى</th>
                                        <th>ربح المغسله  </th>
                                        <th>ربح التطبيق  </th>
                                        <th>التاريخ</th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Multilingual -->

        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            var id= document.getElementById('laundry_id').value;

            $('#laundryTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
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
                    data:'laundryProfit',
                    name:'total_price'
                },{
                    data:'appProfit',
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
