@extends('layouts.app')

@section('content')
<style>
  #map {
    height: 100%;
    min-height: 450px;
  }
</style>
<!-- @foreach($routes as $route)
{{$route}}<br>
@endforeach -->
<?php
  $routesarray = [];
  foreach ($routes as $index => $route) {
    $temp = [];
    $temp['userID'] = $route->userID;
    $temp['lat'] = $route->pickup['lat'];
    $temp['lng'] = $route->pickup['lng'];
    // $routesarray[]['userID'] = $route->userID;
    // $routesarray[]['lng'] = $route->pickup['lng'];
    // $routesarray[]['lat'] = $route->pickup['lat'];

    $routesarray[] = $temp;

  }

// echo '<pre>';
// echo var_dump($routesarray);
// echo '</pre>';
$routesCount = count($routesarray,0);
?>



<div class="row">
    <div class="col-md-12">
      <div id="message-area"></div>
      <div class="card">
        <div class="card-header">
          <div class="card-title">Map</div>

        </div>
        <div class="card-body">
          <div class="row">
              <div class="col-md-6">
                    <!-- <a href="#" class="thumbnail">
                      <img src="http://placehold.it/900x450" class="img-responsive">
                    </a> -->

                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">
                          <i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                        <input id="searchLocation" type="text" class="form-control" placeholder="Location" aria-describedby="basic-addon1" value="">
                      </div>
                    <div id='map'></div>
                </div>
                <div class="col-md-6">
                <div class="section">
                  <div class="section-title">Directions</div>
                  <div class="section-body">
                <div id="panel"></div>
              </div>
            </div>

                </div>
              </div>
              <br><br>
                <div class="row">
                  <div class="col-sm-5"></div>
                  <div class="col-sm-6">
                    <form id="formRoute" action="{{url('storepaths')}}" method="post">
                      {{csrf_field()}}
                      <input type="hidden" id="plong" name="plong" value="">
                      <input type="hidden" id="plat" name="plat" value="">
                      <button type="button" class="btn btn-sm btn-success" id="setRouteSave" disabled="true">Match Me</button>
                    <button type="button" class="btn btn-sm btn-info" id="setRouteConfirm" disabled="true">Save My Route</button>
                    <a href="{{ url('/home') }}"><button type="button" class="btn btn-sm btn-warning">Cancel</button></a>
                  </form>
                  </div>
                </div>

                <form id="formMatches" action="{{url('storematch')}}" method="post">
                  {{csrf_field()}}
                  <input type="hidden" id="matchDriver" name="driver" value="">
                  <input type="hidden" id="matchSabayer" name="sabayer" value="">
                </form>


        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('assets/js/RouteBoxer.js')}}" async defer></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM6qIb6FxMLJMQ2YeiOSvRD3afyUgKQeU&v=3.exp&libraries=geometry,places&callback=initMap" async defer></script>


  <script>



  function initMap() {
    var markerMe;
    // Try HTML5 geolocation.

    var defLatLng = null;
    @if($myPath != "[]")
    defLatLng = new google.maps.LatLng({{$myPath[0]->path['lat']}}, {{$myPath[0]->path['lng']}});
    @endif

    //infoWindow = new google.maps.InfoWindow;
    var myPosition;
    var markerPosition;
    var boxpolys = null;
    var gmarkers = [];
    var submitMarkers = [];


    // if (navigator.geolocation) {
    //   navigator.geolocation.getCurrentPosition(function(position) {
    //     var pos = {
    //       lat: position.coords.latitude,
    //       lng: position.coords.longitude
    //     };
    //     myPosition = pos;
    //
    //   //  markerPosition = new google.maps.Marker({
    //   //     position: pos,
    //   //     map: map,
    //   //     title: 'You',
    //   //     draggable: true
    //   //   });
    //
    //     //infoWindow.setPosition(pos);
    //     //infoWindow.setContent('You are here.');
    //     //infoWindow.open(map);
    //     //map.setCenter(pos);
    //   }, function() {
    //     handleLocationError(true, infoWindow, map.getCenter());
    //   });
    // } else {
    //   // Browser doesn't support Geolocation
    //   handleLocationError(false, infoWindow, map.getCenter());
    // }

    // var locations = [
    //     ['1', 14.704645183865715, 120.99117636680603],
    //     ['2', 14.562566921840498, 121.01711869239807],
    //     ['201401037', 14.555158171027532, 121.03444576287984],
    //     ['4', 27.036116, -81.717045],
    //     ['5', 34.104058, -117.444583],
    //     ['6', 44.790790, -121.443607] ];

        var locations = [
          //            userID    , lat               , lng
          <?php
          // echo "['201401037', 14.555158171027532, 121.03444576287984]";
          foreach ($routesarray as $key => $value) {
            if($key == ($routesCount-1)){
            echo "['".$value['userID']."', ".$value['lat'].", ".$value['lng']."]";
            }
            else{
              echo "['".$value['userID']."', ".$value['lat'].", ".$value['lng']."],";
            }
          }
          ?>
        ];


        var marker, i;

    for (i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker({
            // map: map,
            title: locations[i][0],
            position: new google.maps.LatLng(locations[i][1], locations[i][2])
            //visible: false,  //true for all, but hidden
            // icon: 'img/the_icon.png'
        });
        gmarkers.push(marker);
    }

    var myLatLng = {lat: 14.561350, lng: 121.019490};


    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: myLatLng,
      clickableIcons: false,
      mapTypeControl: false
    });
    map.setOptions({streetViewControl: false});
   var markerLatLng;
    var iacademyMarker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'iACADEMY',
      icon: "images/pubIcons/iacademylogo2.png",
      draggable: false
    });


   google.maps.event.addListener(map, 'click', function(event) {
     placeMarker(event.latLng);
     markerLatLng = event.latLng;
  });



  function placeMarker(location) {

$('#setRouteConfirm').prop('disabled', false);
$('#setRouteSave').prop('disabled', true);

      markerLatLng = location;

      if ( markerMe ) {
      markerMe.setPosition(location);
    } else {
      markerMe = new google.maps.Marker({
        position: location,
        map: map,
        draggable : true
      });

    }
  markerMe.setVisible(true);

    //getRoute();
  }





  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchLocation'));
  // map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('searchLocation')); //to bind it in the map
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    searchBox.set('map', null);

$('#setRouteConfirm').prop('disabled', false);
$('#setRouteSave').prop('disabled', false);
    var places = searchBox.getPlaces();

    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for (i = 0; place = places[i]; i++) {
      (function(place) {

        placeMarker(place.geometry.location);
        /*if(markerMe){
          markerMe.setPosition(place.geometry.location);
          markerMe.setVisible(true);
        }
         else{
           map: map,
           markerMe = new google.maps.Marker({
           draggable : true,
          position: place.geometry.location
          });
        }*/
          //map.setCenter(place.geometry.location);

        //markerMe.bindTo('map', searchBox, 'map');
        google.maps.event.addListener(markerMe, 'map_changed', function() {
          if (!this.getMap()) {
            this.unbindAll();
          }

          //getRoute();
        });
        bounds.extend(place.geometry.location);


      }(place));

    }
    map.fitBounds(bounds);
    searchBox.set('map', map);
    map.setZoom(Math.min(map.getZoom(),17));

  });


  var directionsService = new google.maps.DirectionsService();
  var directionsDisplay = new google.maps.DirectionsRenderer({
    polylineOptions: {
                    strokeColor: "#9676bb",
                    strokeWeight: 6,
                    strokeOpacity: 0.6
                },
      suppressMarkers: true
    });


  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('panel'));
  routeBoxer = new RouteBoxer();


var generatedRoute;

function drawBoxes(boxes) {
boxpolys = new Array(boxes.length);
for (var i = 0; i < boxes.length; i++) {
boxpolys[i] = new google.maps.Rectangle({
bounds: boxes[i],
fillOpacity: 0,
strokeOpacity: 1.0,
strokeColor: '#000000',
strokeWeight: 1,
visible: false,
map: map
});
for (var j=0; j< gmarkers.length; j++) {
    if (boxes[i].contains(gmarkers[j].getPosition()))
    {
        //gmarkers[j].setMap(map);
        submitMarkers.push([gmarkers[j].getTitle(), gmarkers[j].getPosition().lat(), gmarkers[j].getPosition().lng()]);
      }
}

}

//alert(submitMarkers.toString());
}

      function matchMe(){
        for(var i=0; i < submitMarkers.length; i++ )
        {

          //alert(submitMarkers[i][0] + " " + submitMarkers[i][1] + " " + submitMarkers[i][2] );
          $('#matchDriver').val({{Auth::User()->studentID}});
          $('#matchSabayer').val(submitMarkers[i][0]);

          $('#formMatches').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                   type: "POST",
                   url: "{{url('storematch')}}",
                   data: $("#formMatches").serialize()

               });
             });
             $('#formMatches').submit();
        }
      }

      function getRoute(){
        clearBoxes();
        submitMarkers = [];
        distance = /* parseFloat(document.getElementById("distance").value) */ 0.100 * 1.609344;
        //iacademyMarker.setVisible(false);
        //markerMe.setVisible(false);
        //markerPosition.setVisible(false);
        var request = {
          origin: markerMe.position,
          destination: iacademyMarker.position,
          provideRouteAlternatives: false,
          travelMode: google.maps.DirectionsTravelMode.DRIVING //Change this to WALKING if needed
        };

        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            generatedRoute = response.routes;

            var path = response.routes[0].overview_path;

            //gets boxes around route
            var boxes = routeBoxer.box(path, distance);

            //draw boxes on the map
            drawBoxes(boxes);


            //console.log(google.maps.geometry.poly.containsLocation(iacademyMarker.position, generatedRoute));
          }
        });


      }

      function clearBoxes() {
  if (boxpolys != null) {
    for (var i = 0; i < boxpolys.length; i++) {
      boxpolys[i].setMap(null);
    }
  }
  boxpolys = null;
}


      document.getElementById("setRouteConfirm").addEventListener("click", function(event) {
        $('#plat').val(markerMe.position.lat);
        $('#plong').val(markerMe.position.lng);


        getRoute();
        var routePoly = new google.maps.Polyline({paths: generatedRoute});
        console.log({paths: generatedRoute});
        //var someBoolean = google.maps.geometry.poly.containsLocation(iacademyMarker.position, routePoly);
        //alert(someBoolean);

        $('#setRouteSave').prop('disabled', false);
        $('#setRouteConfirm').prop('disabled', true);

        $('#formRoute').submit();


      });

      document.getElementById("setRouteSave").addEventListener("click", function(event) {

        // FIXME: TO DO DB Operations



        matchMe();

        $('#setRouteSave').prop('disabled', true);
        var word = "";
        if(submitMarkers.length == 1){
          word = "passenger";
        }
        else{
          word = "passengers";
        }
        $('#message-area').append('<div class="flash-message"><strong><p class="alert alert-info">Success! Matched with '+ submitMarkers.length + ' ' + word + '<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
        window.setTimeout(function(){
       $(".flash-message").fadeTo(500,0).slideUp(500,function(){
           $(this).remove();
       });
      },7000);

      });

      $('#formRoute').on('submit', function(e){
        e.preventDefault();

        $.ajax({
               type: "POST",
               url: "{{url('storepaths')}}",
               data: $("#formRoute").serialize()

           });


      });

      if(defLatLng != null)
      {
        placeMarker(defLatLng);
        getRoute();
        $('#setRouteConfirm').prop('disabled', true);
        $('#setRouteSave').prop('disabled', false);

      }
}//initMap

// google.maps.event.addDomListener(window, 'load', initMap);







  </script>


@endsection
