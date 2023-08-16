@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">

    <div>
            <div class="animated fadeIn">
                <div class="row">
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong>عرض تفاصيل الطلب  </strong>

                                </div>
                                <div class="card-block">

                                    <div class="form-group">
                                        <label for="company">اسم المغسله</label>
                                        <input type="text" name="name_ar" class="form-control view" id="name_ar" value="{{$order->subCategoriesTrashed->name_ar}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم العميل</label>
                                        <input type="text" name="name_ar" class="form-control view" id="name_ar" value="{{$order->userTrashed->name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم المندوب</label>
                                        <input type="text" name="name_ar" class="form-control view" id="name_ar" value="{{$order->delegateTrashed->appUserTrashed->name ??''}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المدينه  </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->userTrashed->citiesTrashed->name_ar}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى  </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->userTrashed->region_name}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">التاريخ  </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->created_at}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> عدد القطع </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->count_products}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المبلغ الاجمالى   </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->total_price??''}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">ربح المغسله   </label>
                                        <input type="text" name="profit"class="form-control view" id="name_ar" value="{{($order->total_price-($order->total_price *$order->subCategoriesTrashed->percentage)/100)}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">كوبون   </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->coupon}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">خصم   </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->discount}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> ملاحظات  </label>
                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->note}}" disabled>
                                    </div>
                                    @if($order->audio_note!= Null)
                                    <div class="form-group">
                                        <label for="company"> الملاحظات الصوتيه </label>
                                        <br>
                                        <audio controls>
                                            <source src="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" type="audio/mpeg">
                                        </audio>
                                        <a class="btn btn-info" href="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" download style="margin-top: -32px;">Download</a>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>عرض تفاصيل القطع </strong>
                            </div>
                            <div class="card-block">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>اسم القطعه</th>
                                            <th>اسم الخدمه</th>
                                            <th>السعر</th>
                                            <th>العموله</th>
                                            <th>الكميه</th>
                                            <th>قيمه التوصيل</th>
                                            <th>القيمه الاجماليه</th>
                                            <th>نسبه الربح للمغسله</th>
                                            <th>نسبه الربح </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderDetails as $orderDetail)
                                        <tr>
                                            <td>{{$orderDetail->productTrashed->name_ar}}</td>
                                            <td>{{$orderDetail->productService->services}}</td>
                                            <td>{{$orderDetail->price}}</td>
                                            <td>{{$orderDetail->productService->commission}}</td>
                                            <td>{{$orderDetail->quantity}}</td>
                                        @endforeach
                                            <td>{{$order->subCategoriesTrashed->price}}</td>
                                            <td>{{$order->subCategoriesTrashed->price}}</td>
                                            <td>{{$order->subCategoriesTrashed->price}}</td>
                                            <td>{{$order->subCategoriesTrashed->price}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>سجل التحديث للطلب</strong>
                            </div>
                            <div class="card-block">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>الحالة</th>
                                            <th>الوقت المستغرق</th>
                                            <th>تاريخ الانشاء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->histories as $history)
                                        <tr>
                                            <td>{{$history->status}}</td>
                                            @if($history->is_finished)
                                                <td>{{minutesToHumanReadable($history->spend_time ?? 0)}}</td>
                                            @else
                                                <td><time class="timeago" datetime="{{$history->created_at->toISOString() ?? $order->created_at->toISOString()}}">{{$history->created_at->toDateString() ?? $order->created_at->toDateString() }}</time></td>
                                            @endif
                                            <td>{{$history->created_at->toDateString()}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>سجل المدفوعات</strong>
                            </div>
                            <div class="card-block">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>رقم المعاملة</th>
                                            <th>الحالة</th>
                                            <th>تاريخ الانشاء</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->payments as $payment)
                                        <tr>
                                            <td>{{$payment->transaction_id}}</td>
                                            <td>{{$history->status}}</td>
                                            <td>{{$history->created_at->toDateString()}}</td>
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
    </main>
@endsection
@push('scripts')
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.js')}}"></script>
    <script src="{{asset('assets/admin/js/libs/jquery.timeago.ar.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery("time.timeago").timeago();
        });
    </script>
@endpush
