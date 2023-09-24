
{{--@extends('customers.layouts.dashboard-app')--}}
{{--@section('content')--}}
{{--    <!-- Multilingual -->--}}
{{--    <input type="hidden" id="category_id" name="category_id" value="{{$id}}">--}}
{{--    <section id="multilingual-datatable">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header border-bottom">--}}
{{--                        <h4 class="card-title">Multilingual</h4>--}}
{{--                    </div>--}}
{{--                    <div class="card-datatable">--}}
{{--                        <table class="dt-multi table" id="productTable">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>{{__('lang.service')}}</th>--}}
{{--                                <th>{{__('lang.price')}} </th>--}}
{{--                                <th>{{__('lang.urgentPrice')}} </th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    </div>--}}
{{--    </div>--}}
{{--    </div>--}}

{{--@endsection--}}


@extends('customers.layouts.dashboard-app')
@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <input type="hidden" id="category_id" name="category_id" value="{{$id}}">
                <section id="dashboard-analytics">
                    <div class="row">
                        <div class="col-12">
                            <div class="card invoice-list-wrapper">
                                <div class="card-datatable table-responsive">
                                    <table class="productTable table" id="productTable">
                                        <thead>
                                        <tr>
                                            <th>{{__('lang.service')}}</th>
                                            <th>{{__('lang.price')}} </th>
                                            <th>{{__('lang.urgentPrice')}} </th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ List DataTable -->
                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
@push('scripts')
    <script type="text/javascript">
        $(window).on('load', function() {
            var id= document.getElementById('category_id').value;
            $('#productTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Customer.Products.viewProductServices',$id) }}",
                data:{id:id},
                columns: [{
                    data: 'services',
                    name: 'services'
                },{
                    data: 'price',
                    name: 'price'
                },{
                    data:'priceUrgent',
                    name:'priceUrgent'
                }]
            });
        })
    </script>
@endpush
