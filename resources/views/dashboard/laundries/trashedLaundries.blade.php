@extends('../layouts.app')
@section('content')
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> المغاسل المحذوفه

                            </div>
                            <div class="card-block">
                                <table id="laundries" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th> الصوره </th>
                                        <th>اسم المغسله </th>
                                        <th>المدينه </th>
                                        <th>الحى</th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subCategories as $subCategory)
                                        <tr>
                                            <td><img src="{{$subCategory->image}}" style="width:50px;height:50px"></td>
                                            <td>{{$subCategory->name_ar}}</td>
                                            <td>{{$subCategory->parent->name_ar??''}}</td>
                                            <td>{{$subCategory->city->name_ar}}</td>
                                            <td>{{$subCategory->address}}</td>

                                            <td>
                                                <form class="delete" action="{{route('laundries.restoreDeleted',$subCategory->id)}}" method="get">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="استعاده الحذف" class="edit btn btn-danger btn-sm">
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>
@endsection
@push('scripts')
    <script>
        $("#laundries").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#laundries_wrapper .col-md-6:eq(0)');
    </script>
    <script>
        $(".delete").on("submit", function(){
            return confirm("هل أنت متأكد من استعاده الحذف ؟");
        });
    </script>
@endpush

