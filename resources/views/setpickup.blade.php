@extends('layouts.app')

@section('content')
<style>
  #map {
    height: 100%;
    min-height: 450px;
  }
</style>

<?php
  $routesarray = [];
  foreach ($routes as $index => $route) {
    $temp = [];
    $temp['userID'] = $route->userID;
    $temp['lat'] = $route->path['lat'];
    $temp['lng'] = $route->path['lng'];
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
              <div class="col-md-12">
                    <!-- <a href="#" class="thumbnail">
                      <img src="http://placehold.it/900x450" class="img-responsive">
                    </a> -->

                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">
                          <i class="fa fa-location-arrow" aria-hidden="true"></i></span>
                        <input id="searchLocation" type="text" class="form-control" placeholder="Location" aria-describedby="basic-addon1" value="">
                      </div>
                    <div id='map'></div>
                    <hr>



                </div>
                <div class="row">
                  <div class="col-sm-5"></div>
                  <div class="col-sm-6">
                    <form id="formPickup"action="{{url('storepoints')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" id="plong" name="plong" value="">
                    <input type="hidden" id="plat" name="plat" value="">
                    <!-- <div class="col-sm-3">
                    <select class="select2" name="prad" id="prad" value="100">
                      <?php
                      //for($ctr = 100 ; $ctr <= 300; $ctr+=50){
                        //echo '<option value='.$ctr.'>'.$ctr.' Meters </option>';
                      //}
                      ?>
                    </select>
                    </div> -->

                    <button type="button" class="btn btn-sm btn-success" id="setPickupSave" disabled="true">Match Me!</button>
                    <button type="button" class="btn btn-sm btn-info" id="setPickupConfirm" disabled="true">Save My Pickup</button>



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

    var defLatLng = null;
    @if($myPickup != "[]")
    defLatLng = new google.maps.LatLng({{$myPickup[0]->pickup['lat']}}, {{$myPickup[0]->pickup['lng']}});
    @endif

    var myLatLng = {lat: 14.561350, lng: 121.019490};
    var routeBoxer;

    //FIXME: turn hardcoded values into variable from dataabase
     //[["201401110" , 14.567135903897958, 121.04583978652954 ], ["201401112" , 14.567135903897958, 121.04583978652954 ]];
 var routeMarkers = [
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

    var submitMarkers = [];
    var boxpolys = null;
    var distance;

    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer({
      polylineOptions: {
                      strokeColor: "#9676bb",
                      strokeWeight: 1
                  },
        suppressMarkers: true
      });


	directionsDisplay.setMap(map);
    //directionsDisplay.setPanel(document.getElementById('panel'));
    routeBoxer = new RouteBoxer();


    function matchMe(){
    alert(submitMarkers.length);
      for(var i=0; i < submitMarkers.length; i++ )
      {
        //alert(submitMarkers[i]);
        //alert(submitMarkers[i][0] + " " + submitMarkers[i][1] + " " + submitMarkers[i][2] );
        $('#matchDriver').val(submitMarkers[i]);
        $('#matchSabayer').val({{Auth::User()->studentID}});



        $('#formMatches').submit();

      }

      $('#message-area').append('<div class="flash-message"><strong><p class="alert alert-info">Pickup Point has been successfully saved!<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
      window.setTimeout(function(){
     $(".flash-message").fadeTo(500,0).slideUp(500,function(){
         $(this).remove();
     });
    },7000);


    }

    $('#formMatches').on('submit', function(e){
      e.preventDefault();

      $.ajax({
             type: "POST",
             url: "{{url('storematch')}}",
             data: $("#formMatches").serialize()

         });
       });


function getRoute(location, index)
  {
    clearBoxes();
    distance = /* parseFloat(document.getElementById("distance").value) */ 0.100 * 1.609344;
    //iacademyMarker.setVisible(false);
    //markerMe.setVisible(false);
    //markerPosition.setVisible(false);
    var request = {
      origin: location,
      destination: iacademyMarker.position,
      provideRouteAlternatives: false,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        //generatedRoute = response.routes;

        var path = response.routes[0].overview_path;

        //gets boxes around route
        var boxes = routeBoxer.box(path, distance);

        //draw boxes on the map
        drawBoxes(boxes, index);


        //console.log(google.maps.geometry.poly.containsLocation(iacademyMarker.position, generatedRoute));
      }
    });
  }


function drawBoxes(boxes, index) {
    boxpolys = new Array(boxes.length);
    for (var i = 0; i < boxes.length; i++) {
      boxpolys[i] = new google.maps.Rectangle({
      bounds: boxes[i],
      fillOpacity: 0,
      strokeOpacity: 1.0,
      strokeColor: '#000000',
      strokeWeight: 1,
      visible: true,
      map: map
      });
      if (boxes[i].contains(markerMe.getPosition()))
      {
          //gmarkers[j].setMap(map);


          submitMarkers.push(routeMarkers[index][0]);

        }


      }
  clearBoxes();

  //alert(submitMarkers.toString());
  }

function clearBoxes() {
    if (boxpolys != null) {
      for (var i = 0; i < boxpolys.length; i++) {
        boxpolys[i].setMap(null);
      }
    }
      boxpolys = null;
      }
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 17,
      center: myLatLng,
      clickableIcons: false,
      mapTypeControl: false
    });
    if(defLatLng != null){
      map.setCenter(defLatLng);
      placeMarker(defLatLng);
    }
    map.setOptions({streetViewControl: false});
   var markerLatLng;
    var iacademyMarker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'iACADEMY',
      draggable: false,
      icon: "images/pubIcons/iacademylogo2.png"
    });
    var markerMe;

   google.maps.event.addListener(map, 'click', function(event) {
     placeMarker(event.latLng);
     markerLatLng = event.latLng;
  });
  var circleMe;
  var radius = 100;

  function placeMarker(location) {
     // var marker = new google.maps.Marker({
      //    position: location,
       //   map: map,
        //  draggable: true
     // });
     $('#setPickupConfirm').prop('disabled', false);
     $('#setPickupSave').prop('disabled', false);
      markerLatLng = location;

      if ( markerMe) {
      markerMe.setPosition(location);
    } else {
      markerMe = new google.maps.Marker({
        position: location,
        map: map,
        draggable : true
      });

    }
    //placeCircle();
    //markerMe.bindTo("position", circleMe, "center");
  }

  // function placeCircle() {
  //
  //     if(circleMe)
  //     {
  //     circleMe.setRadius(radius);
  //     circleMe.setCenter(markerMe.getPosition());
  //     }
  //     else
  //     {
  //    circleMe = new google.maps.Circle({
  //             strokeColor: '#FF0000',
  //             strokeOpacity: 0.8,
  //             strokeWeight: 2,
  //             fillColor: '#FF0000',
  //             fillOpacity: 0.35,
  //             map: map,
  //             center: markerMe.getPosition(),
  //             radius: radius
  //             });
  //      }
  // }
  document.getElementById("setPickupConfirm").addEventListener("click", function(event) {
     //placeCircle();
     // FIXME: Do DB insert for this
     //alert($('#plat').val());

         $('#plat').val(markerMe.position.lat);
         $('#plong').val(markerMe.position.lng);

     submitMarkers = [];

     //alert($('#plong').val());
     for(i = 0; i < routeMarkers.length; i++)
     {
       getRoute(new google.maps.LatLng(routeMarkers[i][1], routeMarkers[i][2]), i);

     }

     $('#setPickupSave').prop('disabled', false);
     $('#setPickupConfirm').prop('disabled', true);
     $('#formPickup').submit();
/////
    //   alert(submitMarkers.length);
    //   matchMe();
     //
    //  $('#setPickupSave').click();


  });

  document.getElementById("setPickupSave").addEventListener("click", function(event) {

    //alert("NACLICK");
    matchMe();
    $('#setPickupSave').prop('disabled', true);
    //$('#formMatches').submit();

  });



  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchLocation'));
  // map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('searchLocation')); //to bind it in the map
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    searchBox.set('map', null);

$('#setPickupConfirm').prop('disabled', false);

    var places = searchBox.getPlaces();

    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for (i = 0; place = places[i]; i++) {
      (function(place) {

        placeMarker(place.geometry.location);
        /*if(markerMe){
          markerMe.setPosition(place.geometry.location);
        }
         else{
           map: map,
           markerMe = new google.maps.Marker({
           draggable : true,
          position: place.geometry.location
          });
        }*/
          //map.setCenter(place.geometry.location);
          //placeCircle();
          //markerMe.bindTo("position", circleMe, "center");
          //alert(markerMe.position);
        //markerMe.bindTo('map', searchBox, 'map');
        google.maps.event.addListener(markerMe, 'map_changed', function() {
          if (!this.getMap()) {
            this.unbindAll();
          }
        });
        bounds.extend(place.geometry.location);


      }(place));

    }
    map.fitBounds(bounds);
    searchBox.set('map', map);
    map.setZoom(Math.min(map.getZoom(),17));

  });

  $('#prad').on('change', function(){
    //alert($('#prad').val())
    radius = parseInt($('#prad').val());
    //placeCircle();
  });

  $('#formPickup').on('submit', function(e){
    e.preventDefault();

    $.ajax({
           type: "POST",
           url: "{{url('storepoints')}}",
           data: $("#formPickup").serialize()

       });


  });

}//initMap

// google.maps.event.addDomListener(window, 'load', initMap);


  </script>


@endsection
