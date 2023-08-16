@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active" aria-current="page">الأسئله الشائعه  </li>
            </ol>
        </nav>
        <div>

            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">

                            <div class="card-header">
                                <i class="fa fa-align-justify"></i> الاسئله
                                <a href="{{route('faq.create')}}" class="btn btn-primary btns" style="float: left;">اضافه سؤال</a>
                            </div>
                            <div class="card-block">
                                <table id="example1" class="table table-bordered table-striped col-7">
                                    <thead>
                                    <tr>
                                        <th>السؤال </th>
                                        <th>السؤال باللغه الانجليزيه </th>

                                        <th></th>
                                    </tr>
                                    </thead>
                                    @if($faqs->count()>0)
                                        <tbody>
                                        @foreach($faqs as $faq)
                                            <tr>
                                                <td>{{$faq->question_ar}} </td>
                                                <td>{{$faq->question_en}} </td>

                                                <td>
                                                    <a href="{{route('faq.edit',$faq->id)}}" class="btn btn-primary btns ">تعديل</a>
                                                    <a href="{{route('faq.destroy',$faq->id)}}" class="btn btn-danger btns ">حذف</a>
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
