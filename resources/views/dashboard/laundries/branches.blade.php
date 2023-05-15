@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
    <div>
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
                        <a href="{{route('laundries.branches.create',$id)}}" class="btn btn-primary custom" style="float: left" >اضافه فرع</a>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="table_id">
                            <thead>
                            <input type="hidden" value="{{$id}}" id="laundry_id">
                            <tr>
                                <th>  الصورة </th>
                                <th>اسم المغسله </th>
                                <th>الفرع الرئيسى </th>
                                <th>المدينه </th>
                                <th>الحى</th>
                                <th>ساعات العمل</th>
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
                ajax: "{{ Route('laundries.branches',$id) }}",
                data: { id: id},
                columns: [{
                    data: 'image',
                    name: 'image'
                },{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data: 'parentTrashed',
                    name: 'parentTrashed'
                },{
                    data:'city',
                    name:'city'
                },{
                    data:'address',
                    name:'address'
                },{
                    data:'around_clock',
                    name:'around_clock'
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
                    url: "{{ route('laundries.destroy') }}",
                    data: { id: id},
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#datatable-crud').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });

    </script>

@endpush
