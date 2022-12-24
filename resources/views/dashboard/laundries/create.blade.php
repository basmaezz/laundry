@extends('../layouts.app')
@section('content')
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a>
            </li>
            <li class="breadcrumb-item active">Dashboard</li>
            <!-- Breadcrumb Menu-->
            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" href="./"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn btn-secondary" href="#"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <form method="post" action="{{url('laundryStore')}}" enctype="multipart/form-data">
                        @csrf
                         <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>اضافه مغسله جديده</strong>

                                </div>
                                <div class="card-block">
                                    <div class="form-group">
                                        <label for="company">التصنيف </label>
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name_ar}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="company" n>اسم المغسله</label>
                                        <input type="text" name="name_ar"class="form-control" id="name_ar" placeholder="اسم المغسله">
                                    </div>
                                    <div class="form-group">
                                        <label for="company">اسم المغسله بالانجليزيه</label>
                                        <input type="text" name="name_en"class="form-control" id="name_ar" placeholder="اسم المغسله">
                                    </div>
                                    <div class="form-group">
                                        <label for="company">العنوان</label>
                                        <input type="text" name="address"class="form-control" id="name_ar" placeholder="العنوان ">
                                    </div>

                                    <div class="form-group">
                                        <label for="country">صوره الشعار</label>
                                        <input type="file" name="image "class="form-control" id="image" placeholder="Country name">
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                                        </div>
                                        <div class="col-5">
                                            <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
                                        </div>
                                    </div>

                                    <div id="map" style="height:300px; width: 500px;" class="my-3"></div>


                                </div>
                            </div>

                        </div>
                        <div>

                        <div class="card-footer col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                        </div>
                        </div>

                    </form>


                </div>

                <!--/row-->
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>
@endsection


    <script>
        let map;
        function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
            scrollwheel: true,
        });

        const uluru = { lat: -34.397, lng: 150.644 };
        let marker = new google.maps.Marker({
        position: uluru,
        map: map,
        draggable: true
    });

        google.maps.event.addListener(marker,'position_changed',
        function (){
        let lat = marker.position.lat()
        let lng = marker.position.lng()
        $('#lat').val(lat)
        $('#lng').val(lng)
    })

        google.maps.event.addListener(map,'click',
        function (event){
        pos = event.latLng
        marker.setPosition(pos)
    })
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
        type="text/javascript"></script>
</script>
