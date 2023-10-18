@extends('../layouts.app')
@section('content')
    <div class="row" id="basic-table">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('faq.create')}}" class="btn btn-primary" >اضافه سؤال</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
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
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
