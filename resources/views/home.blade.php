@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-xs-12">
<div class="card">

<div class="card-body">
  <div class="section">
        <div class="section-title">Step</div>
        <div class="section-body">
          <div class="step">
<ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="step" class="active">
        <a href="#step1" id="step1-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
            <div class="icon fa fa-car"></div>
            <div class="heading">
                <div class="title">Using the quick access car</div>
                <div class="description">Click the car</div>
            </div>
        </a>
    </li>
    <li role="step">
        <a href="#step2" role="tab" id="step2-tab" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-map-marker"></div>
            <div class="heading">
                <div class="title">Setting a Pick up</div>
                <div class="description">Placing a Marker.</div>
            </div>
        </a>
    </li>
    <li role="step">
        <a href="#step3" role="tab" id="step3-tab" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-group"></div>
            <div class="heading">
                <div class="title">Matches</div>
                <div class="description">Check your matches</div>
            </div>
        </a>
    </li>
    <li role="step">
        <a href="#step4" role="tab" id="step4-tab" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-paper-plane "></div>
            <div class="heading">
                <div class="title">Contact</div>
                <div class="description">Message your matched users</div>
            </div>
        </a>
    </li>
</ul>
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="step1">
      <div class = "row">
        <div class="col-lg-3">
        <div style="float: right"><img src="{{asset('/uploads/instructions/1.png')}}"></div>
        </div>
        <div class="col-lg-3">
        <b>Step 1</b> : Click the quick access car to open the menu.
        </div>
        <div class="col-lg-3"></div>
      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-3"></div>
        <div class="col-lg-3">
        <b>Step 2</b> : Click "SET PICKUP".
        </div>
        <div class="col-lg-3">
        <div style="float: left"><img src="{{asset('/uploads/instructions/2.png')}}"></div>
        </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step2">
      <div class = "row">
        <div class="col-lg-5">
        <div style="float: right;"><img src="{{asset('/uploads/instructions/3a.png')}}"></div>
        </div>
        <div class="col-lg-3">
        <b>Step 3</b> : Search for your general location (Subject to availability).
        </div>
        <!-- <div class="col-lg-3"></div> -->
      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 4</b> : Click on the map to place a marker, This will be used by the system to match you to a driver.
        </div>
        <div class="col-lg-3">
        <div style="float: left"><img src="{{asset('/uploads/instructions/3b.jpg')}}"></div>
        </div>
      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-3">
        <div style="float: right;"><img src="{{asset('/uploads/instructions/3d.png')}}"></div>
        </div>
        <div class="col-lg-3">
        <b>Step 5</b> : Click "Save" to store your pick up and you're done.
        </div>
        <!-- <div class="col-lg-3"></div> -->
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step3">
      <div class = "row">
        <div class="col-lg-6">
        <div style="float: right"><img src="{{asset('/uploads/instructions/4.jpg')}}"></div>
        </div>
        <div class="col-lg-3">
        <b>Step 6</b> : Check here to see your matches.
        </div>
        <div class="col-lg-3"></div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step4">
        <b>Step4</b> : Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequa
    </div>
</div>
</div>
        </div>
      </div>
</div>
</div>
</div>
</div>






<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(Auth::user()->isAdmin)
                    You are logged in! Hello, Founder {{Auth::user()->firstName}}
                    <div id="map" style="width:100%;height:500px"></div>



<script>
function myMap() {
  var mapCanvas = document.getElementById("map");

  var mapOptions = {
    center: new google.maps.LatLng(14.5507277,121.0126932),

    zoom: 10
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({
                map: map,
                draggable: true
            });
  google.maps.event.addListener(map, 'click', function(event){
        var marker_position = event.latLng;

       marker.setPosition(marker_position);
        })
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyAM6qIb6FxMLJMQ2YeiOSvRD3afyUgKQeU"></script>
                    @else
                    Yo-ser ka lang.
                    @endif

                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
