@extends('layouts.app')

@section('content')
<style>
  #map {
    height: 100%;
    min-height: 450px;
  }
</style>


<div class="row">
    <div class="col-md-12">
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
                    <button type="button" class="btn btn-sm btn-success" id="setRouteConfirm">Route</button>
                    <button type="button" class="btn btn-sm btn-info" id="setRouteSave">Save</button>
                    <a href="{{ url('/home') }}"><button type="button" class="btn btn-sm btn-warning">Cancel</button></a>
                  </div>
                </div>

                <div id="daniel"></div>


        </div>
      </div>
    </div>
  </div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM6qIb6FxMLJMQ2YeiOSvRD3afyUgKQeU&v=3.exp&libraries=geometry,places&callback=initMap" async defer></script>


  <script>



  function initMap() {
    // Try HTML5 geolocation.

    //infoWindow = new google.maps.InfoWindow;
    var myPosition;
    var markerPosition;
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
    var markerMe;

   google.maps.event.addListener(map, 'click', function(event) {
     placeMarker(event.latLng);
     markerLatLng = event.latLng;
  });
  function placeMarker(location) {

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
    markerMe.setVisible(true);

    var places = searchBox.getPlaces();

    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for (i = 0; place = places[i]; i++) {
      (function(place) {
        if(markerMe){
          markerMe.setPosition(place.geometry.location);
        }
         else{
           map: map,
           markerMe = new google.maps.Marker({
           draggable : true,
          position: place.geometry.location
          });
        }
          //map.setCenter(place.geometry.location);

        markerMe.bindTo('map', searchBox, 'map');
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
  var directionsDisplay = new google.maps.DirectionsRenderer();


  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('panel'));


var generatedRoute;

      function getRoute(){
        iacademyMarker.setVisible(false);
        markerMe.setVisible(false);
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
            //console.log(google.maps.geometry.poly.containsLocation(iacademyMarker.position, generatedRoute));
          }
        });
      }


      document.getElementById("setRouteConfirm").addEventListener("click", function(event) {

        getRoute();
        var routePoly = new google.maps.Polyline({paths: generatedRoute});
        var someBoolean = google.maps.geometry.poly.containsLocation(iacademyMarker.position, routePoly);
        //alert(someBoolean);

      });

      document.getElementById("setRouteSave").addEventListener("click", function(event) {

        // FIXME: TO DO DB Operations

        // alert(JSON.stringify(markerMe.position));
        var id = 1;
        var string;
        string = "{\"userID\":"+id+"},{$set:{\"points.route\":"+JSON.stringify(markerMe.position)+"}}";

        //alert(string);

        $('#daniel').append(string);

      });

}//initMap

// google.maps.event.addDomListener(window, 'load', initMap);







  </script>


@endsection
