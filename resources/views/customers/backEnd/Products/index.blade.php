
@extends('customers.layouts.dataTable-app')
@section('content')
    <!-- Multilingual -->
    <input type="hidden" id="category_id" name="category_id" value="{{$id}}">
    <section id="multilingual-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Multilingual</h4>
                    </div>
                    <div class="card-datatable">
                        <table class="dt-multi table" id="productTable">
                            <thead>
                            <tr>
                                <th>{{__('lang.number')}}</th>
                                <th>{{__('lang.productName')}}</th>
                                <th>{{__('lang.actions')}}</th>
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
                ajax: "{{ route('Customer.Products.index',$id) }}",
                data:{id:id},
                columns: [{
                    data: 'id',
                    name: 'id'
                },{
                    data: 'category_type',
                    name: 'category_type'
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
