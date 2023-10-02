@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">العملاء</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه للمحفظه   </li>
            </ol>
        </nav>
    <div>
            <div class="animated fadeIn">
                <div class="row">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">

                                <div class="card-header">
                                    <strong>اضافه للمحفظه</strong>
                                </div>
                                <div class="card-block">

                                    <form action="{{url('increaseWallet/'.$appUser->uuid)}}" method="post"  class="form-horizontal ">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">اسم العميل</label>
                                            <div class="col-md-9">
                                                <input type="text" id="text-input" name="name" class="form-control"value="{{$appUser->name}}"disabled>
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">المبلغ</label>
                                            <div class="col-md-9">
                                                <input type="text" id="amount" name="amount" class="form-control" placeholder="100 ريال" required>

                                            @if ($errors->has('amount'))
                                                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="card-footer">
                                           <button type="submit" class="btn btn-sm btn-info" style=" max-width: 62px !important;; max-height: 30px !important;"><i class="fa fa-dot-circle-o"></i> اضافه</button>
                                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger  ">الغاء</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

@endsection
