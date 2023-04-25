@extends('../layouts.app')
@section('content')
    <main class="main">

        <div class="container-fluid">
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
                                        <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{$order->subCategoriesTrashed->name_ar}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم العميل</label>
                                        <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{$order->userTrashed->name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم المندوب</label>
                                        <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{$order->delegateTrashed->appUserTrashed->name ??''}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المدينه  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->userTrashed->citiesTrashed->name_ar}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الحى  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->userTrashed->region_name}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">التاريخ  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->created_at}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> عدد القطع </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->count_products}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">المبلغ المطلوب  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->total_price??''}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">كوبون   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->coupon}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">خصم   </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->discount}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company"> ملاحظات  </label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" value="{{$order->note}}" disabled>
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
                        @foreach($orderDetails as $orderDetail)
                        <div class="col-sm-5">
                            <div class="card">
                                <div class="card-header">
                                    <strong>عرض تفاصيل القطع  </strong>

                                </div>

                                <div class="card-block">

                                    <div class="form-group">
                                        <label for="company">اسم القطعه</label>
                                        <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{$orderDetail->productTrashed->name_ar}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم الخدمه</label>
                                        <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{$orderDetail->productService->services}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">السعر </label>
                                        <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{$orderDetail->price}}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="company">الكميه  </label>
                                        <input type="text" name="name_en" class="form-control" id="name_ar" value="{{$orderDetail->quantity}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
