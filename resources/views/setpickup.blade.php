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
                    <div class="col-sm-3">
                    <select class="select2" name="prad" id="prad" value="100">
                      <?php
                      for($ctr = 100 ; $ctr <= 300; $ctr+=50){
                        echo '<option value='.$ctr.'>'.$ctr.' Meters </option>';
                      }
                      ?>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success" id="setPickupConfirm" disabled="true">Confirm</button>
                    <a href="{{ url('/home') }}"><button type="button" class="btn btn-sm btn-warning">Cancel</button></a>
                    </form>
                  </div>
                </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM6qIb6FxMLJMQ2YeiOSvRD3afyUgKQeU&v=3.exp&libraries=places&callback=initMap" async defer></script>


  <script>

  function initMap() {
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

  function placeCircle() {

      if(circleMe)
      {
      circleMe.setRadius(radius);
      circleMe.setCenter(markerMe.getPosition());
      }
      else
      {
     circleMe = new google.maps.Circle({
              strokeColor: '#FF0000',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FF0000',
              fillOpacity: 0.35,
              map: map,
              center: markerMe.getPosition(),
              radius: radius
              });
       }
  }
  document.getElementById("setPickupConfirm").addEventListener("click", function(event) {
     //placeCircle();
     // FIXME: Do DB insert for this
     //alert($('#plat').val());
     //alert($('#plong').val());

     $('#plat').val(markerMe.position.lat);
     $('#plong').val(markerMe.position.lng);
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

       $('#message-area').append('<div class="flash-message"><strong><p class="alert alert-info">Pickup Point has been successfully saved!<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
       window.setTimeout(function(){
      $(".flash-message").fadeTo(500,0).slideUp(500,function(){
          $(this).remove();
      });
     },7000);
  });

}//initMap

// google.maps.event.addDomListener(window, 'load', initMap);


  </script>


@endsection
