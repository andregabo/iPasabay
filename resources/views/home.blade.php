@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-xs-12">
    <p>Blank Page</p>
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
