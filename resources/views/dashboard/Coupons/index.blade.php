@extends('../layouts.app')
@section('content')
    <main class="main">
        @if($errors->any())
            <div class="alert alert-danger">
                <h6>{{$errors->first()}}</h6>
            </div>
        @elseif(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="container-fluid">
            <a href="{{route('coupon.create')}}" class="btn btn-primary">اضافه كوبون</a>

                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i> الأقسام
                                </div>
                                <div class="card-block">
                                    <table id="example1" class="table table-bordered table-striped col-7">
                                        <thead>
                                        <tr>
                                            <th>اسم الكوبون</th>
                                            <th>القيمه </th>
                                            <th>بدايه من </th>
                                            <th>نهايه الكوبون </th>
                                            <th> status </th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($coupons as $coupon)
                                            <tr>
                                                <td>{{$coupon->code_name}} </td>
                                                <td>{{$coupon->discount_value}} </td>
                                                <td>{{$coupon->date_from}} </td>
                                                <td>{{$coupon->date_to}} </td>
                                                @if ($coupon->status=='0')
                                                <td><span class="tag tag-danger">DeActive</span></td>
                                                @else
                                                <td><span class="tag tag-success">Active</span></td>
                                                @endif
                                                <td>

{{--                                                    <a href="{{route('coupon.show',$coupon->id)}}" class="btn btn-info">عرض  القطع </a>--}}
                                                    <a href="{{route('coupon.edit',$coupon->id)}}" class="btn btn-primary">تعديل</a>
                                                    <a href="{{route('coupon.destroy',$coupon->id)}}" class="btn btn-danger">حذف</a>
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
