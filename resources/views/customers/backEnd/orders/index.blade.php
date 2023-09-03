@extends('customers.layouts.dataTable-app')
@section('content')

    <input type="hidden" id="category_id" name="category_id" value="{{$id}}">
    <section id="multilingual-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{__('lang.products')}}</h4>
                    </div>
                    <div class="card-datatable">
                        <table class="dt-multi table" id="productTable">
                            <thead>
                            <tr>
                                <th>{{__('lang.orderNumber')}}</th>
                                <th>{{__('lang.customerName')}}</th>
                                <th>{{__('lang.status')}} </th>
                                <th>{{__('lang.orderType')}} </th>
                                <th>{{__('lang.date')}} </th>
                                <th>{{__('lang.details')}}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </div>
    </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(window).on('load', function() {
            var id= document.getElementById('category_id').value;
            $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: "{{ route('Customer.Orders.index',$id) }}",
                data:{id:id},
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'user',
                    name: 'user'
                },{
                    data: 'status',
                    name: 'status'
                },{
                    data: 'orderType',
                    name: 'orderType'
                },{
                    data: 'date',
                    name: 'date'
                },{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },]
            });
        })
    </script>
@endpush

