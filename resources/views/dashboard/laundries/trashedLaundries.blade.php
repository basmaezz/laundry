@extends('../layouts.app')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                <li class="breadcrumb-item active" aria-current="page">المغاسل المحذوفه  </li>
            </ol>
        </nav>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> المغاسل المحذوفه
                                <div class="card-block">
                                    <table id="laundries" class="table table-bordered table-striped">
                                        <thead >
                                        <tr >
                                            <th>اسم المغسله </th>
                                            <th>المدينه </th>
                                            <th>الحى</th>
                                            <th>Actions </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subCategories as $subCategory)
                                            <tr>
                                                <td>{{$subCategory->name_ar}}</td>
                                                <td>{{$subCategory->city->name_ar??''}}</td>
                                                <td>{{ Str::limit($subCategory->address, 20) }}</td>
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
        function delConfirm(){
            return confirm("هل أنت متأكد من حذف المغسله ؟");
        }
    </script>
@endpush


