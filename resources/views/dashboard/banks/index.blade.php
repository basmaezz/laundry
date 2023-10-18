@extends('../layouts.app')
@section('content')
<div class="row" id="basic-table">
    <div class="col-7">
        <div class="card">
            <div class="card-header">

                <a href="{{route('bank.create')}}" class="btn btn-primary" style="float: right; margin-right: 700px;">اضافه بنك</a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>اسم البنك</th>
                        <th>اسم البنك بالانجليزيه </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                       @foreach($banks as $bank)
                    <tr>
                        <td> {{$bank->name_ar}} </td>
                        <td> {{$bank->name_en}} </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('bank.edit',$bank->id)}}">
                                        <i data-feather="edit-2" class="mr-50"></i>
                                        <span>Edit</span>
                                    </a>
                                    <a class="dropdown-item" href="{{route('bank.destroy',$bank->id)}}">
                                        <i data-feather="trash" class="mr-50"></i>
                                        <span>Delete</span>
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
<!-- Basic Tables end -->

@endsection
