@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('cities.index')}}">البلاد</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه بلد  </li>
            </ol>
        </nav>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>تعديل بلد </strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{route('city.update',$city->id)}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم البلد</label>
                            <div class="col-md-9">
                                <input type="text"  name="name_ar" class="form-control" value="{{$city->name_ar}}" >
                                @if ($errors->has('name_ar'))
                                    <span class="text-danger">{{ $errors->first('name_ar') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email"> اسم البلد بالانجليزيه</label>
                            <div class="col-md-9">
                                <input type="text"  name="name_en" class="form-control" value="{{$city->name_en}}" >
                                @if ($errors->has('name_en'))
                                    <span class="text-danger">{{ $errors->first('name_en') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="card-footer">
                           <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <a href="{{route('coupons.index')}}" class="btn btn-sm btn-danger">الغاء </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

