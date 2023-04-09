@extends('../layouts.app')
@section('content')
    <main class="main">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">العملاء   </li>
            </ol>
        </nav>

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>
                                <a href="{{route('customers.index')}}" class="btn btn-info" style="float: left">تحديث</a>
                            </div>
                            <div class="card-block">
                                <table id="customers" class="table table-bordered table-striped">
                                    <thead >
                                    <tr >
                                        <th>الاسم </th>
                                        <th>البريد الألكترونى</th>
                                        <th>الجوال</th>
                                        <th>المدينه</th>
                                        <th>الحى</th>
                                        <th>gender </th>
                                        <th>المحفظه </th>
                                        <th>Actions </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}} </td>
                                            <td>{{$user->mobile}} </td>
                                            <td>{{$user->cities->name_ar ??''}} </td>
                                            <td> {{$user->region_name}}</td>
                                            <td>{{$user->gender}}</td>
                                            <td>{{$user->wallet}}</td>
                                            <td>
                                                <a href="{{route('customer.Orders',$user->id)}}" class="btn btn-info">عرض الطلبات</a>
                                                <a href="{{route('customer.wallet',$user->id)}}" class="btn btn-info">اضافه للمحفظه</a>
{{--                                                <a href="{{route('customer.delete',$user->id)}}" class="btn btn-danger">حذف</a>--}}
                                                <form class="delete" action="{{route('customer.delete',$user->id)}}" method="get">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="حذف" class="edit btn btn-danger btn-sm">
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
        $("#customers").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#customers_wrapper .col-md-6:eq(0)');
    </script>
    <script>
        $(".delete").on("submit", function(){
            return confirm("هل أنت متأكد من الحذف  ؟");
        });
    </script>
@endpush

