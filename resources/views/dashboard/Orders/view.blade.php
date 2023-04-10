@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{url('laundryStore')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong>عرض تفاصيل الطلب  </strong>

                                </div>
                                <div class="card-block">

                                    <div class="form-group">
                                        <label for="company" n>اسم المغسله</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->subCategories->name_ar??'مغسله محذوفه'}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم العميل</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->user->name ??'حساب العميل محذوف'}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم المندوب</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$order->delegate->appUser->name ??''}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المدينه  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->user->cities->name_ar}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->user->region_name??'الحى غير محدد'}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">التاريخ  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->created_at}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> عدد القطع </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->count_products}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المبلغ المطلوب  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->total_price??''}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">كوبون   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->coupon}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">خصم   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->discount}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> ملاحظات  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->note}}"disabled>
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company"> الملاحظات الصوتيه </label>--}}
{{--                                        <audio controls>--}}
{{--                                            <source src="/mp3/{{$record->recording_filename}}" type="audio/mpeg">--}}
{{--                                        </audio>--}}
{{--                                        <a class="btn btn-success" href="/mp3/{{$record->recording_filename}}" download>Download</a>--}}
{{--                                    </div>--}}

                                </div>
                            </div>
                        </div>
                        @foreach($orderDetails as $orderDetail)
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong>عرض تفاصيل القطع  </strong>

                                </div>

                                <div class="card-block">

                                    <div class="form-group">
                                        <label for="company" n>اسم القطعه</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->product->name_ar}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم الخدمه</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->productService->services}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>السعر </label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$orderDetail->price}}"disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الكميه  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$orderDetail->quantity}}"disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

