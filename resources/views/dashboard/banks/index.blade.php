@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">البنوك  </li>
            </ol>
        </nav>

    <div>
            <div class="validationMsg" style="width: 600px">
                @if($errors->any())
                    <div class="alert alert-danger" >
                        <h6>{{$errors->first()}}</h6>
                    </div>
                @elseif(session()->has('message'))
                    <div class="alert alert-success"  >
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> البنوك
                                <a href="{{route('bank.create')}}" class="btn btn-primary" style="float: left">اضافه بنك</a>
                            </div>
                            <div class="card-block">
                                <table id="example1" class="table table-bordered table-striped col-7">
                                    <thead>
                                    <tr>
                                        <th>اسم البنك</th>
                                        <th>اسم البنك بالانجليزيه </th>
                                        <th>الاجراءات</th>
                                    </tr>
                                    </thead>
                                    @if($banks->count()>0)
                                        <tbody>
                                        @foreach($banks as $bank)
                                            <tr>
                                                <td>{{$bank->name_ar}} </td>
                                                <td>{{$bank->name_en}} </td>
                                                <td>
                                                    <a href="{{route('bank.edit',$bank->id)}}" class="btn btn-primary">تعديل</a>
                                                    <a href="{{route('bank.destroy',$bank->id)}}" class="btn btn-danger">حذف</a>
                                                </td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    @else
                                        <tbody>

                                        <tr>
                                            <td> لا يوجد بيانات</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>

                                            <td></td>

                                            <td>           </td>
                                        </tr>

                                        </tbody>
                                    @endif
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
