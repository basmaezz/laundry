@extends('../layouts.app')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">لوحه التحكم</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a> </li>
                            <li class="breadcrumb-item"><a href="{{route('carpetLaundries.index')}}">مغاسل السجاد</a> </li>
                            <li class="breadcrumb-item active">مغاسل السجاد </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه توقيت جديد</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('carpetLaundryTimes.store')}}" >
                                @csrf

                                <input type="hidden"  name="carpet_laundry_id" class="form-control"value="{{$carpetLaundry->id}}">

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم المنطقه</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="area_name" class="form-control"value="{{$carpetLaundry->area_name}}" disabled >

                                    </div>
                                </div>

                                <div class="form-group  row" id="deliveredTimes" >
                                     <label  class="col-md-3 form-control-label" for="hf-email"  for="company">وقت التسليم </label>
                                              <div class="col-md-9">
                                                      <div class="form-group" id="durations" >
                                                      <label for="country">من </label>
                                                      <input type="time" name="start_from" value="22:00" />
                                                 <label for="country">الى </label>
                                                                            <input type="time" name="end_to" value="22:00" />
                                                  </div>
                                                                    </div>
                                                                    <input type="hidden" name="service_type" value="delivered">
                                                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
                @endsection
                @push('scripts')
                    <script type="text/javascript">
                        $(document).ready(function(){
                            function  hideDurations(){
                                alert('test');
                            }

                        });
    @endpush
