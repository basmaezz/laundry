@extends('../layouts.app')
@section('content')
    <main class="main">

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
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> حفظ</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i>  <a href="{{URL::previous()}}" class="btn btn-sm btn-danger">الغاء</a></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

