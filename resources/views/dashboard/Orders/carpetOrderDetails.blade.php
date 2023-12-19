@extends('layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسيه</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Order.index') }}">الطلبات</a>
                            </li>
                            <li class="breadcrumb-item active">تفاصيل طلب السجاد
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="bs-validation">

            <div class="row">
                <!-- Bootstrap Validation -->
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">تفاصيل طلب السجاد</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="company">اسم المغسله</label>
                                <input type="text" name="name_ar" class="form-control view" id="name_ar"
                                       value="{{ $order->subCategoriesTrashed->name_ar }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">اسم العميل</label>
                                <input type="text" name="name_ar" class="form-control view" id="name_ar"
                                       value="{{ $order->userTrashed->name }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">عنوان العميل</label>
                                <input type="text" name="name_ar" class="form-control view" id="name_ar"
                                       value="{{ $order->userTrashed->address }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">اسم مندوب التوصيل </label>
                                <input type="text" name="name_ar" class="form-control view" id="name_ar"
                                       value="{{ $deliveryReceive->appUserTrashed->name ?? '' }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">اسم مندوب التسليم </label>
                                <input type="text" name="name_ar" class="form-control view" id="name_ar"
                                       value="{{ $deliveryDelivered->appUserTrashed->name ?? '' }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">المدينه </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->userTrashed->citiesTrashed->name_ar }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">الحى </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->userTrashed->region_name }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">التاريخ </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->created_at }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company"> عدد القطع </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->count_products }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">المبلغ الاجمالى </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->total_price ?? '' }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">ربح التطبيق </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ ($order->sum_price * $order->subCategoriesTrashed->percentage) / 100 }}"
                                       disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">ربح المغسله </label>
                                <input type="text" name="profit"class="form-control view" id="name_ar"
                                       value="{{ $order->sum_price - ($order->sum_price * $order->subCategoriesTrashed->percentage) / 100 }}"
                                       disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">كوبون </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->coupon }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">خصم </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->discount }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company">قيمه التوصيل </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->subCategoriesTrashed->price }}" disabled>
                            </div>
                            <div class="col-sm-6">
                                <label for="company"> ملاحظات </label>
                                <input type="text" name="name_en"class="form-control view" id="name_ar"
                                       value="{{ $order->note }}" disabled>
                            </div>
                            @if ($order->audio_note != null)
                                <div class="form-group">
                                    <label for="company"> الملاحظات الصوتيه </label>
                                    <br>
                                    <audio controls>
                                        <source src="{{ asset('assets/uploads/audio_note/' . $order->audio_note) }}"
                                                type="audio/mpeg">
                                    </audio>
                                    <a class="btn btn-info"
                                       href="{{ asset('assets/uploads/audio_note/' . $order->audio_note) }}" download
                                       style="margin-top: -32px;max-height:40px;max-width:100px">Download</a>

                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
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
                                            <th>اسم المنتج</th>
                                            <th>السعر</th>
                                            <th>الكميه</th>
                                            <th>الاجمالي</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($orderDetails as $orderDetail)
                                            <tr>
                                                <td>{{ $orderDetail->carpetCategoryTrashed->category_ar }}</td>
                                                <td>{{ $orderDetail->price }}</td>
                                                <td>{{ $orderDetail->quantity }}</td>
                                                <td>{{ $orderDetail->price *$orderDetail->quantity }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
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
                                        @foreach ($order->histories as $history)
                                            <tr>
                                                <td>{{ $history->status }}</td>
                                                @if ($history->is_finished)
                                                    <td>{{ minutesToHumanReadable($history->spend_time ?? 0) }}</td>
                                                @else
                                                    <td><time class="timeago"
                                                              datetime="{{ $history->created_at->toISOString() ?? $order->created_at->toISOString() }}">{{ $history->created_at->toDateString() ?? $order->created_at->toDateString() }}</time>
                                                    </td>
                                                @endif
                                                <td>{{ $history->created_at->toDateString() }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
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
                                        @foreach ($order->payments as $payment)
                                            <tr>
                                                <td>{{ $payment->transaction_id }}</td>
                                                <td>{{ $history->status }}</td>
                                                <td>{{ $history->created_at->toDateString() }}</td>
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
            <!-- /Bootstrap Validation -->
            @endsection
            @push('scripts')
                <script src="{{ asset('assets/admin/js/libs/jquery.timeago.js') }}"></script>
                <script src="{{ asset('assets/admin/js/libs/jquery.timeago.ar.min.js') }}"></script>
                <script>
                    jQuery(document).ready(function() {
                        jQuery("time.timeago").timeago();
                    });
                </script>
    @endpush
