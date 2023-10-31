@extends('layouts.dataTable-app')
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
    <div class="add-btn">
        <a href="{{route('carpetLaundryTimes.create',$id)}}" class="btn btn-primary"  >اضافه  مواعيد استلام</a>
        <a href="{{route('createDeliveredTimes.create',$id)}}" class="btn btn-primary"   >اضافه  مواعيد تسليم</a>
    </div>
<div class="row" id="table-bordered">


    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> مواعيد الاستلام</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>من</th>
                        <th>الى</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carpetLaundryReceivedTimes as $carpetLaundryReceivedTime)
                    <tr>
                        <td> {{$carpetLaundryReceivedTime->id}}</td>
                        <td>{{ date('h:i A', strtotime($carpetLaundryReceivedTime->start_from))}}</td>
                        <td>{{ date('h:i A', strtotime($carpetLaundryReceivedTime->end_to))}}</td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('carpetLaundryTimes.edit',$carpetLaundryReceivedTime->id)}}">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>تعديل</span>
                                    </a>
                                    <a class="dropdown-item" id="deleteBtn"  href="{{route('carpetLaundryTimes.destroy',$carpetLaundryReceivedTime->id)}}">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>حذف</span>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> مواعيد التسليم</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>الرقم</th>
                        <th>من</th>
                        <th>الى</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    @foreach($carpetLaundryDeliveredTimes as $carpetLaundryDeliveredTime)
                        <tr>
                            <td> {{$carpetLaundryDeliveredTime->id}}</td>
                            <td>{{ date('h:i A', strtotime($carpetLaundryDeliveredTime->start_from))}}</td>
                            <td>{{ date('h:i A', strtotime($carpetLaundryDeliveredTime->end_to))}}</td>

                        <td>

                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('carpetLaundryTimes.edit',$carpetLaundryDeliveredTime->id)}}">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>تعديل</span>
                                    </a>
                                    <a class="dropdown-item" id="deleteBtn"  href="{{route('carpetLaundryTimes.destroy',$carpetLaundryDeliveredTime->id)}}">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>حذف</span>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Bordered table end -->
@endsection
