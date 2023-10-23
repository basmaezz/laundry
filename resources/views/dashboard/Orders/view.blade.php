{{--@extends('../layouts.app')--}}
{{--@section('content')--}}
{{--    <main class="main" style="margin-top: 25px">--}}
{{--    <div>--}}
{{--            <div class="animated fadeIn">--}}
{{--                <div class="row">--}}
{{--                        <div class="col-sm-5">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-header">--}}
{{--                                    <strong>عرض تفاصيل الطلب  </strong>--}}

{{--                                </div>--}}
{{--                                <div class="card-block">--}}

{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">اسم المغسله</label>--}}
{{--                                        <input type="text" name="name_ar" class="form-control view" id="name_ar" value="{{$order->subCategoriesTrashed->name_ar}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">اسم العميل</label>--}}
{{--                                        <input type="text" name="name_ar" class="form-control view" id="name_ar" value="{{$order->userTrashed->name }}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">عنوان العميل</label>--}}
{{--                                        <input type="text" name="name_ar" class="form-control view" id="name_ar" value="{{$order->userTrashed->address }}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">اسم المندوب</label>--}}
{{--                                        <input type="text" name="name_ar" class="form-control view" id="name_ar" value="{{$order->delegateTrashed->appUserTrashed->name ??''}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">المدينه  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->userTrashed->citiesTrashed->name_ar}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">الحى  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->userTrashed->region_name}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">التاريخ  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->created_at}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company"> عدد القطع </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->count_products}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">المبلغ الاجمالى   </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->total_price??''}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">ربح التطبيق    </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{($order->sum_price *$order->subCategoriesTrashed->percentage)/100}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">ربح المغسله   </label>--}}
{{--                                        <input type="text" name="profit"class="form-control view" id="name_ar" value="{{($order->sum_price-($order->sum_price *$order->subCategoriesTrashed->percentage)/100)}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">كوبون   </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->coupon}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">خصم   </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->discount}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company">قيمه التوصيل   </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->subCategoriesTrashed->price}}" disabled>--}}
{{--                                    </div>--}}


{{--                                    <div class="form-group">--}}
{{--                                        <label for="company"> العموله الاجماليه  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->total_commission}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company"> ملاحظات  </label>--}}
{{--                                        <input type="text" name="name_en"class="form-control view" id="name_ar" value="{{$order->note}}" disabled>--}}
{{--                                    </div>--}}
{{--                                    @if($order->audio_note!= Null)--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="company"> الملاحظات الصوتيه </label>--}}
{{--                                        <br>--}}
{{--                                        <audio controls>--}}
{{--                                            <source src="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" type="audio/mpeg">--}}
{{--                                        </audio>--}}
{{--                                    <a class="btn btn-info" href="{{asset('assets/uploads/audio_note/' . $order->audio_note)}}" download style="margin-top: -32px;max-height:40px;max-width:100px">Download</a>--}}

{{--                                    </div>--}}
{{--                                    @endif--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <strong>عرض تفاصيل القطع </strong>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>اسم القطعه</th>--}}
{{--                                            <th>اسم الخدمه</th>--}}
{{--                                            <th>السعر</th>--}}
{{--                                            <th>العموله</th>--}}
{{--                                            <th>الكميه</th>--}}
{{--                                            <th>الاجمالي</th>--}}

{{--                                        </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($orderDetails as $orderDetail)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$orderDetail->productTrashed->name_ar}}</td>--}}
{{--                                            <td>{{$orderDetail->productService->services}}</td>--}}
{{--                                            <td>{{$orderDetail->price}}</td>--}}
{{--                                            <td>{{$orderDetail->total_commission}}</td>--}}
{{--                                            <td>{{$orderDetail->quantity}}</td>--}}
{{--                                            <td>{{$orderDetail->full_price}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <strong>سجل التحديث للطلب</strong>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>الحالة</th>--}}
{{--                                            <th>الوقت المستغرق</th>--}}
{{--                                            <th>تاريخ الانشاء</th>--}}
{{--                                        </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($order->histories as $history)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$history->status}}</td>--}}
{{--                                            @if($history->is_finished)--}}
{{--                                                <td>{{minutesToHumanReadable($history->spend_time ?? 0)}}</td>--}}
{{--                                            @else--}}
{{--                                                <td><time class="timeago" datetime="{{$history->created_at->toISOString() ?? $order->created_at->toISOString()}}">{{$history->created_at->toDateString() ?? $order->created_at->toDateString() }}</time></td>--}}
{{--                                            @endif--}}
{{--                                            <td>{{$history->created_at->toDateString()}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header">--}}
{{--                                <strong>سجل المدفوعات</strong>--}}
{{--                            </div>--}}
{{--                            <div class="card-block">--}}
{{--                                <table class="table table-bordered table-striped">--}}
{{--                                    <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>رقم المعاملة</th>--}}
{{--                                            <th>الحالة</th>--}}
{{--                                            <th>تاريخ الانشاء</th>--}}
{{--                                        </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($order->payments as $payment)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$payment->transaction_id}}</td>--}}
{{--                                            <td>{{$history->status}}</td>--}}
{{--                                            <td>{{$history->created_at->toDateString()}}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--@endsection--}}
{{--@push('scripts')--}}
{{--    <script src="{{asset('assets/admin/js/libs/jquery.timeago.js')}}"></script>--}}
{{--    <script src="{{asset('assets/admin/js/libs/jquery.timeago.ar.min.js')}}"></script>--}}
{{--    <script>--}}
{{--        jQuery(document).ready(function() {--}}
{{--            jQuery("time.timeago").timeago();--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
@extends('layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <nav aria-label="breadcrumb" class="navBreadCrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('laundries.index')}}">المغاسل</a></li>
                    <li class="breadcrumb-item active" aria-current="page">اضافه مغسله  </li>
                </ol>
            </nav>
            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="card-title">تفاصيل المغسله</h4>
                        </div>
                        <div class="card-body">


                            <div class="form-group">
                                <label for="company" n>اسم المغسله</label>
                                <input type="text" name="name_ar"class="form-control" id="name_ar" value="{{$subCategory->name_ar}}"disabled>
                            </div>
                            <div class="form-group">
                                <label for="company">اسم المغسله بالانجليزيه</label>
                                <input type="text" name="name_en"class="form-control" id="name_en" value="{{$subCategory->name_en}}"disabled>

                            </div>
                            <div class="form-group">
                                <label class="form-label" for="basic-addon-name"> مميزه  </label>
                                <div class="custom-control custom-checkbox">
                                    <label class="form-control check-ability-label">
                                        <input type="radio"  class="checkbox-ability" name="vip" value="1"{{$subCategory->vip ==1 ? 'checked' :''}} >نعم
                                        <br>
                                    </label>
                                    <label class="form-control check-ability-label">
                                        <input type="radio"  class="checkbox-ability" name="vip" value="0" {{$subCategory->vip == 0 ? 'checked' :''}}>لا
                                        <br>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group">
                                    <label class="form-label" for="basic-addon-name"> غسيل مستعجل </label>
                                    <div class="custom-control custom-checkbox">
                                        <label class="form-control check-ability-label">
                                            <input type="radio"  class="checkbox-ability" name="urgentWash" onchange="showMakeUrgent()" value="1"{{$subCategory->urgentWash ==1 ? 'checked' :''}} >نعم
                                            <br>
                                        </label>
                                        <label class="form-control check-ability-label">
                                            <input type="radio"  class="checkbox-ability" name="urgentWash" onchange="hideMakeUrgent()" value="0"{{$subCategory->urgentWash == 0 ? 'checked' :''}} >لا
                                            <br>
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="company">المدينه</label>
                                <select class="form-control" name="city_id">

                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}" {{$subCategory->city_id==$city->id ?'selected':''}} disabled>{{$city->name_ar}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="company">الحى</label>
                                <input type="text" name="address"class="form-control" id="name_ar" value="{{$subCategory->address}}">
                            </div>
                            <div class="form-group">
                                <label for="country">الموقع(Google Map) </label>
                                <input type="text" name="location"class="form-control" id="location" value="{{$subCategory->location}}">

                            </div>
                            <div class="form-group">
                                <label for="company">latitude </label>
                                <input type="text" name="lat"class="form-control" id="lat"value="{{$subCategory->lat}}" placeholder="latitude "disabled >
                                @error('lat')
                                <div class="text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company">longitude</label>
                                <input type="text" name="lng"class="form-control" id="address"value="{{$subCategory->lng}}" placeholder="longitude " disabled>
                                @error('address')
                                <div class="text-sm text-red-600">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="approximate_duration"> نطاق التشغيل </label>
                                <div class="input-group">
                                    <input type="text"name="range" class="form-control" value="{{$subCategory->range??''}}" max="50" min="5" disabled >
                                    <span class="input-group-addon"> كيلومتر</i>
                                                </span>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="country">سعر التوصيل  </label>
                                <div class="input-group">
                                    <input type="text" name="price" class="form-control" value="{{$subCategory->price ??Request::old('price') }}"disabled >
                                    <span class="input-group-addon"> ريال</i>
                                                </span>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="country">النسبه  </label>
                                <div class="input-group">
                                    <input type="text"name="percentage" class="form-control" value="{{$subCategory->percentage}}"disabled >
                                    <span class="input-group-addon"> %</i>
                                                </span>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="approximate_duration">  المده التقريبيه للغسيل </label>
                                <div class="input-group">
                                    <input type="text"name="approximate_duration" class="form-control"  value="{{$subCategory->approximate_duration}}" disabled >
                                    <span class="input-group-addon"> ساعه</i>
                                                </span>
                                </div>

                            </div>

                            <div class="form-group " id="approximate_duration_urgent_input" >
                                <label for="approximate_duration">  المده التقريبيه للغسيل السريع </label>
                                <div class="input-group">
                                    <input type="number"name="approximate_duration_urgent" class="form-control" placeholder="24" value="{{$subCategory->approximate_duration_urgent}}" disabled >
                                    <span class="input-group-addon"> ساعه</i>
                                                </span>
                                </div>

                            </div>

                            <div class="form-group" >
                                <div>
                                    <label for="country">فتره التشغيل  </label> <br>
                                    <input type="radio"  name="around_clock" value="1" onchange="hideDurations()"{{$subCategory->around_clock ==1 ? 'checked' :''}} >
                                    <label for="age1">طوال اليوم</label><br>
                                    <input type="radio" name="around_clock" value="0"  id="specificDuration" {{$subCategory->around_clock ==0 ? 'checked' :''}}>
                                    <label for="age2"> فتره محدده </label><br>
                                </div>
                            </div>
                            @if($subCategory->around_clock =='0')
                                <div class="form-group" id="durations" >
                                    <label for="country">بدايه الفتره </label>
                                    <input type="time" name="clock_at" value="{{$subCategory->clock_at}}" />

                                    <label for="country">نهايه الفتره </label>
                                    <input type="time" name="clock_end" value="{{$subCategory->clock_end}}" />
                                </div>
                            @elseif($subCategory->around_clock =='1')
                                <div class="form-group" id="durations" >
                                    <label for="country">بدايه الفتره </label>
                                    <input type="time" name="clock_at" value="22:00" />

                                    <label for="country">نهايه الفتره </label>
                                    <input type="time" name="clock_end"value="22:00" />
                                </div>
                            @endif
                            @if($subCategory->parent_id =='')
                                <div class="form-group">
                                    <img src="{{$subCategory->image}}" style="width: 100px; height: 100px">
                                </div>

                                <div class="form-group">
                                    <label for="country">صوره الشعار</label>
                                    <input type="file" name="image"class="form-control" id="image" placeholder="Country name">
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <strong>اضافه أدمن </strong>
                            </div>

                            <div class="form-group ">
                                <label >الأسم الأول</label>
                                <input type="text" id="text-input" name="name" class="form-control" value="{{$subCategory->userTrashed[0]->name ??''}}"disabled>

                            </div>
                            <div class="form-group ">
                                <label  for="text-input">الأسم الأخير</label>
                                <input type="text" id="text-input" name="last_name" class="form-control"value="{{$subCategory->userTrashed[0]->last_name ??''}}"disabled>

                            </div>

                            <div class="form-group ">
                                <label  for="email-input">البريد الألكترونى </label>
                                <input type="email" id="email-input" name="email" class="form-control" value="{{$subCategory->userTrashed[0]->email ??''}}"disabled>

                            </div>
                            <div class="form-group ">
                                <label  for="text-input">الجوال </label>
                                <input type="text" id="phone" name="phone" class="form-control"  value="{{$subCategory->userTrashed[0]->phone ??''}}"maxlength="10"disabled>

                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Bootstrap Validation -->
@endsection
@push('scripts')

@endpush
