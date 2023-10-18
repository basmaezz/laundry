@extends('../layouts.app')
@section('content')
    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">ارسال اشعار للعملاء</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{route('notification.storeCustomerNotification')}}" >
                                @csrf

                                <div class="row">
                                    <label class="form-label" for="username">الفئه</label>
                                    <div class="demo-inline-spacing">

                                            <input type="radio" id="all" name="selectCategory" value="all" onchange="hideAll()" checked>
                                                <label for="html">كل العملاء</label><br>
                                            <input type="radio" id="specificCustomers" name="selectCategory" value="customers" onchange="selectCustomers()">
                                                <label for="html">فئه محدده</label><br>
                                        <input type="radio" id="selectCustomer" name="selectCategory" value="customer" onchange="viewCustomerSearch()">
                                                <label for="html">عميل محدد</label><br>
                                    </div>
                                </div>
                              <br>
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="form-label" for="username">عنوان الاشعار / عنوان الاشعار بالانجليزيه</label>
                                        <input type="text" name="title_ar" class="form-control" >
                                        @if ($errors->has('name_ar'))
                                            <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="specificCustomers" style="display: none" id="specificCustomersInputs">
                                    <div class="row" >
                                        <div class="form-group col-md-10" >
                                            <label>المدينه</label>
                                            <div class="form-group">
                                                <select class="select2 form-control" multiple="multiple" id="default-select-multi" name="cities[]">
                                                    @foreach($cities as $city)
                                                        <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="form-label" for="username">الجنس</label>
                                        <div class="demo-inline-spacing">

                                            <input type="radio" id="all" name="gender" value="all" >
                                            <label for="html"> الكل</label><br>
                                            <input type="radio" id="specificCustomers" name="gender" value="m" >
                                            <label for="html"> ذكر</label><br>
                                            <input type="radio" id="selectCustomer" name="gender" value="f" >
                                            <label for="html"> أنثى</label><br>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div style="display: none" id="selectCustomerInput" >
                                    <div class="row" >
                                        <div class="col-md-10 mb-1">
                                            <label>العملاء</label>
                                            <select class="select2 form-control form-control-lg" name="app_user_id">
                                                <option value="0">اختر عميل</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->mobile}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <label class="form-label" for="username">نص الاشعار / نص الاشعار بالانجليزيه</label>
                                        <input type="text" name="content_ar" class="form-control " >
                                        @if ($errors->has('content_ar'))
                                            <span class="text-danger">{{ $errors->first('content_ar') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">

                                <div class="col-12">
                                        <button type="submit" class="btn btn-primary">ارسال</button>
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
        function hideAll()
        {
            let specificCustomersInputs= document.getElementById('specificCustomersInputs');
            (specificCustomersInputs.style.display ==="block") ?specificCustomersInputs.style.display ="none" :'';
            let selectCustomerInput= document.getElementById('selectCustomerInput');
            (selectCustomerInput.style.display ==="block") ?selectCustomerInput.style.display ="none" :'';
        }

        function selectCustomers()
        {
            let specificCustomersInputs= document.getElementById('specificCustomersInputs');
            let selectCustomer= document.getElementById('selectCustomer');
            (specificCustomersInputs.style.display ==="none") ?specificCustomersInputs.style.display ="block" :'';
            (selectCustomer.style.display ==="block") ?selectCustomer.style.display ="none" :'';
        }

        function viewCustomerSearch()
        {
            let specificCustomersInputs= document.getElementById('specificCustomersInputs');
            (specificCustomersInputs.style.display ==="block") ?specificCustomersInputs.style.display ="none" :'';
            let selectCustomerInput= document.getElementById('selectCustomerInput');
            (selectCustomerInput.style.display ==="none") ?selectCustomerInput.style.display ="block" :'';

        }

    </script>


    @endpush
