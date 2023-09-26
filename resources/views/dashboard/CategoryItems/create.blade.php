@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
        <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('CategoryItems.index',$subCategory->id)}}">الأقسام</a></li>
                <li class="breadcrumb-item active" aria-current="page">اضافه قسم  </li>
            </ol>
        </nav>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>اضافه قسم</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{url('CategoryItemsStore')}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم القسم</label>
                            <div class="col-md-9">
                                <input type="hidden"  name="subcategory_id" class="form-control" value="{{$subCategory->id}}"  >
                                <input type="text"  name="category_type" class="form-control" placeholder="اسم القسم " >
                                @if ($errors->has('category_type'))
                                    <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم القسم(معرب)</label>
                            <div class="col-md-9">

                                <input type="text"  name="category_type_franco" class="form-control" placeholder="اسم القسم(معرب) " >
                                @if ($errors->has('category_type_franco'))
                                    <span class="text-danger">{{ $errors->first('category_type_franco') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-info"style="max-height: 30px !important; max-width: 40px"> حفظ</button>
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-danger"style="max-height: 30px !important; max-width: 40px">الغاء</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

