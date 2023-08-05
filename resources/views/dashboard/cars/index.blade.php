{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--        <nav aria-label="breadcrumb" class="navBreadCrumb">--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>--}}
{{--                <li class="breadcrumb-item active" aria-current="page">السيارات  </li>--}}
{{--            </ol>--}}
{{--        </nav>--}}

{{--    <div>--}}
{{--            <div class="validationMsg" style="width: 600px">--}}
{{--                @if($errors->any())--}}
{{--                    <div class="alert alert-danger" >--}}
{{--                        <h6>{{$errors->first()}}</h6>--}}
{{--                    </div>--}}
{{--                @elseif(session()->has('message'))--}}
{{--                    <div class="alert alert-success"  >--}}
{{--                        {{ session()->get('message') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-9">--}}
{{--                        <div class="card">--}}

{{--                            <div class="card-header">--}}
{{--                                <i class="fa fa-align-justify"></i> البنوك--}}
{{--                                <a href="{{route('car.create')}}" class="btn btn-primary" style="float: left">اضافه سياره</a>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table id="example1" class="table table-bordered table-striped col-7">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>اسم السياره</th>--}}
{{--                                        <th>اسم السياره بالانجليزيه </th>--}}
{{--                                        <th>الاجراءات</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    @if($cars->count()>0)--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($cars as $car)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$car->name_ar}} </td>--}}
{{--                                                <td>{{$car->name_en}} </td>--}}
{{--                                                <td>--}}
{{--                                                    <a href="{{route('car.edit',$car->id)}}" class="btn btn-primary" style="width: 85px !important;">تعديل</a>--}}
{{--                                                    <a href="{{route('car.destroy',$car->id)}}" class="btn btn-danger" style="width: 85px !important;">حذف</a>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}

{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    @else--}}
{{--                                        <tbody>--}}

{{--                                        <tr>--}}
{{--                                            <td> لا يوجد بيانات</td>--}}
{{--                                            <td> </td>--}}
{{--                                            <td> </td>--}}
{{--                                            <td> </td>--}}

{{--                                            <td></td>--}}

{{--                                            <td>           </td>--}}
{{--                                        </tr>--}}

{{--                                        </tbody>--}}
{{--                                    @endif--}}
{{--                                </table>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        </div>--}}
{{--    </main>--}}



{{--@endsection--}}
@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <div >
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active" aria-current="page">البلاد   </li>
                </ol>
            </nav>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        <a href="{{route('car.create')}}" class="btn btn-primary custom" style="float: left; width: 100px; height: 35px " >اضافه بلد</a>
                    </div>
                    <div class="card-block">
                        <table class="table table-striped" id="cityTable">
                            <thead>
                            <tr>
                                <th>الأسم</th>
                                <th>الأسم بالانجليزيه</th>
                                <th> الاجراءات</th>
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
        $(window).on('load', function() {
            $('#cityTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('cars.index') }}",
                columns: [{
                    data: 'name_ar',
                    name: 'name_ar'
                },{
                    data: 'name_en',
                    name: 'name_en'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

                ]
            });
        });
        $('body').on('click', '#deleteBtn', function () {
            if (confirm("هل تريد اتمام الحذف ؟") == true) {
                var id = $(this).data('id');
                window.location.reload();
                $.ajax({
                    type:"get",
                    url: "{{ route('car.destroy') }}",
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

