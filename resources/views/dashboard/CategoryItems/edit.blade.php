@extends('../layouts.app')
@section('content')
    <main class="main" style="margin-top: 25px">
      <nav aria-label="breadcrumb" class="navBreadCrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">الرئيسيه</a></li>
                <li class="breadcrumb-item active"><a href="{{route('CategoryItems.index',$categoryItem->subcategory_id)}}">الأقسام</a></li>
                <li class="breadcrumb-item active" aria-current="page">تعديل  القسم</li>
            </ol>
        </nav>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>تعديل بيانات القسم</strong>
                </div>
                <div class="card-block">
                    <form method="post" action="{{Route('CategoryItems.update',$categoryItem->id)}}" >
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="hf-email">اسم القسم</label>
                            <div class="col-md-9">
                                <input type="text"  name="category_type" class="form-control" value="{{$categoryItem->category_type}}">
                                @if ($errors->has('category_type'))
                                    <span class="text-danger">{{ $errors->first('category_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                           <button type="submit" class="btn btn-sm btn-info custom"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <button type="reset" class="btn btn-sm btn-danger customOrder"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

