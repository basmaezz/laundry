@extends('layouts.dataTable-app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a> </li>
                            <li class="breadcrumb-item"><a href="{{route('carpetLaundries.index')}}">مغاسل السجاد</a> </li>
                            <li class="breadcrumb-item active">مغاسل السجاد </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="add-btn">
            <a href="{{route('carpetCategories.create',$id)}}" class="btn btn-primary" style="margin-right: 1126px;"  >اضافه جديد</a>

        </div>

        <section id="multilingual-datatable">
                <input type="hidden" name="carpet_laundry_id" id="carpet_laundry_id" value="{{$id}}">
            <div class="row">
                <div class="col-10">
                    <div class="card invoice-list-wrapper">

                        <div class="card-datatable table-responsive">
                            <table class="productTable table" id="carpetLaundryTable">
                                <thead>
                                <tr>
                                    <th>اسم المنتج(عربى)</th>
                                    <th>اسم المنتج(انجليزى)</th>
                                    <th>الوصف(عربى)</th>
                                    <th>الوصف (انجليزى) </th>
                                    <th>سعر  </th>
                                    <th>ربح المغسله  </th>
                                    <th>  </th>
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
    $(function() {
        var id= document.getElementById('carpet_laundry_id').value;

        var table = $('#carpetLaundryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('carpetCategories.index',$id) }}",
            data: { id: id},
            columns: [{
                data: 'category_ar',
                name: 'category_ar'
            },{
                data: 'category_en',
                name: 'category_en'
            },{
                data: 'desc_ar',
                name: 'desc_ar'
            },{
                data: 'desc_en',
                name: 'desc_en'
            },{
                data: 'price',
                name: 'price'
            },{
                data: 'laundry_profit',
                name: 'laundry_profit'
            },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ]
        });
    });
    $('body').on('click', '#deleteBtn', function () {
        // $('#myModal').modal('show');
        if (confirm("هل تريد اتمام الحذف ؟") == true) {
            var id = $(this).data('id');
            window.location.reload();
            $.ajax({
                type:"get",
                url: "{{ route('carpetCategories.destroy') }}",
                data: { id: id},
                dataType: 'json',
                success: function(res){
                    var oTable = $('#carpetLaundryTable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    });

</script>
@endpush
