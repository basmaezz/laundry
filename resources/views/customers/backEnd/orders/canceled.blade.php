@extends('customers.layouts.dataTable-app')
@section('content')

    <input type="hidden" id="category_id" name="category_id" value="{{$id}}">
    <section id="multilingual-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{__('lang.orders')}}</h4>
                    </div>
                    <div class="card-datatable">
                        <table class="dt-multi table" id="productTable">
                            <thead>
                            <tr>
                                <th>{{__('lang.orderNumber')}}</th>
                                <th>{{__('lang.customerName')}}</th>
                                <th>{{__('lang.cancelledDate')}} </th>
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
                ajax: "{{ route('Customer.Orders.canceledOrder',$id) }}",
                data:{id:id},


                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'user',
                    name: 'user'
                },{
                    data: 'date',
                    name: 'date'
                },{
                    data: 'details',
                    name: 'details',
                    orderable: false,
                    searchable: false
                },]
            });
        })
    </script>
@endpush

