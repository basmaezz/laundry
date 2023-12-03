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
                <!-- Bootstrap Validation -->
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اضافه فترات جديده</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('carpetLaundryTimes.update',$carpetLaundryTime->id)}}" >
                                @csrf

                                <input type="hidden"  name="subCategory_id" class="form-control"value="{{$carpetLaundryTime->subCategory_id}}">

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="hf-email">اسم المنطقه</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="area_name" class="form-control"value="{{$carpetLaundryTime->subCategory->name_ar}}" disabled >

                                    </div>
                                </div>
                                <div class="form-group  row" id="receivedTimes" >
                                    <label  class="col-md-3 form-control-label" for="hf-email"  for="company">وقت الاستلام </label>
                                    <div class="col-md-9">
                                        <div class="form-group" id="durations" >
                                            <label for="country">من </label>
                                            <input type="time" name="start_from" value="{{$carpetLaundryTime->start_from}}" />

                                            <label for="country">الى </label>
                                            <input type="time" name="end_to" value="{{$carpetLaundryTime->end_to}}" />
                                        </div>
                                    </div>
                                    <input type="hidden" name="service_type" value="{{$carpetLaundryTime->service_type}}">
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
