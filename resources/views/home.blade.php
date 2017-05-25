@extends('layouts.app')

@section('content')
<style>

.gmap-control-container {
    margin: 15px;

}
.gmap-control {
    cursor: pointer;
    background-color: -moz-linear-gradient(center top , #FEFEFE, #F3F3F3);
    background-color: #FEFEFE;
    border: 1px solid #A9BBDF;
    border-radius: 2px;
    padding: 0 6px;
    padding-top: 2px;
    padding-left: 12px;
    padding-right: 12px;
    padding-bottom: 2px;
    line-height: 160%;
    font-size: 15px;
    font-family: Arial,sans-serif;
    box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.35);
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -o-user-select: none;
    user-select: none;
}
.gmap-control:hover {
    border: 1px solid #678AC7;
}
.gmap-control-active {
    background-color: -moz-linear-gradient(center top , #6D8ACC, #7B98D9);
    background-color: #6D8ACC;
    color: #fff;
    font-weight: bold;
    border: 1px solid #678AC7;
}
.gmap-control-legend {

    position: absolute;
    text-align: left;
    z-index: -1;
    top: 35px;
    right: 1;
    width: 150px;
    height: 75px;
    font-size: 13px;
    background: #FEFEFE;
    border: 1px solid #A9BBDF;
    padding: 8px;
    box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.35);
}
.gmap-control-legend ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
}
</style>

<div class="row">
<div class="col-xs-12">
  <div class="card">
    <div class="card-header">Traffic Conditions</div>
    <div class="card-body">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-location-arrow" aria-hidden="true"></i></span>
        <input id="searchLocation" type="text" class="form-control" placeholder="Location" aria-describedby="basic-addon1" value="">
      </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <div id="map" style="height:70vh"></div>
    </div>


  <script>
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
          streetViewControl: false,
        mapTypeControlOptions: {

      mapTypeIds: []
    },
        clickableIcons: false,
        center: {lat: 14.561350, lng: 121.019490}
        @if(true)
        ,styles:[
    {
        "featureType": "all",
        "elementType": "labels",
        "stylers": [
            {
                "lightness": 63
            },
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#000bff"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels",
        "stylers": [
            {
                "color": "#4a4a4a"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "labels.text",
        "stylers": [
            {
                "weight": "0.01"
            },
            {
                "color": "#727272"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "labels",
        "stylers": [
            {
                "color": "#ff0000"
            }
        ]
    },
    {
        "featureType": "administrative.country",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#ff0000"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#545454"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.locality",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#737373"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.neighborhood",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#7c7c7c"
            },
            {
                "weight": "0.01"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.land_parcel",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#404040"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "lightness": 16
            },
            {
                "hue": "#ff001a"
            },
            {
                "saturation": -61
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#828282"
            },
            {
                "weight": "0.01"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.business",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.business",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.government",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#4c4c4c"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#00ff91"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#7b7b7b"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#999999"
            },
            {
                "visibility": "on"
            },
            {
                "weight": "0.01"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#ff0011"
            },
            {
                "lightness": 53
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#626262"
            }
        ]
    },
    {
        "featureType": "road.highway.controlled_access",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "geometry",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "labels.text",
        "stylers": [
            {
                "color": "#676767"
            },
            {
                "weight": "0.01"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "hue": "#0055ff"
            }
        ]
    }
]
@endif
      });

      var iacademyMarker = new google.maps.Marker({
        position: {lat: 14.561350, lng: 121.019490},
        map: map,
        title: 'iACADEMY',
        icon: "images/pubIcons/iacademylogo2.png",
        draggable: false
      });


//var trafficLayer = new google.maps.TrafficLayer();
//trafficLayer.setMap(map);
  var controlDiv = document.createElement('DIV');
$(controlDiv).addClass('gmap-control-container')
             .addClass('gmnoprint');

var controlUI = document.createElement('DIV');
$(controlUI).addClass('gmap-control');
$(controlUI).text('Traffic');
$(controlDiv).append(controlUI);

var legend = '<ul>'
           + '<li><span style="background-color: #30ac3e">&nbsp;&nbsp;</span><span style="color: #30ac3e"> &gt; 80 km per hour</span></li>'
           + '<li><span style="background-color: #ffcf00">&nbsp;&nbsp;</span><span style="color: #ffcf00"> 40 - 80 km per hour</span></li>'
           + '<li><span style="background-color: #ff0000">&nbsp;&nbsp;</span><span style="color: #ff0000"> &lt; 40 km per hour</span></li>'
           + '<li><span style="background-color: #c0c0c0">&nbsp;&nbsp;</span><span style="color: #c0c0c0"> No data available</span></li>'
           + '</ul>';

var controlLegend = document.createElement('DIV');
$(controlLegend).addClass('gmap-control-legend');
$(controlLegend).html(legend);
$(controlLegend).hide();
$(controlDiv).append(controlLegend);

// Set hover toggle event
$(controlUI)
    .mouseenter(function() {
        $(controlLegend).show();
    })
    .mouseleave(function() {
        $(controlLegend).hide();
    });

var trafficLayer = new google.maps.TrafficLayer();
$(controlUI).addClass('gmap-control-active');
trafficLayer.setMap(map);


google.maps.event.addDomListener(controlUI, 'click', function() {
    if (typeof trafficLayer.getMap() == 'undefined' || trafficLayer.getMap() === null) {
        $(controlUI).addClass('gmap-control-active');
        trafficLayer.setMap(map);
    } else {
        trafficLayer.setMap(null);
        $(controlUI).removeClass('gmap-control-active');
    }
});

map.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);


      var searchBox = new google.maps.places.SearchBox(document.getElementById('searchLocation'));
      // map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('searchLocation')); //to bind it in the map
      google.maps.event.addListener(searchBox, 'places_changed', function() {
        searchBox.set('map', null);
        var places = searchBox.getPlaces();

        var bounds = new google.maps.LatLngBounds();
        var i, place;
        for (i = 0; place = places[i]; i++) {
          (function(place) {

            bounds.extend(place.geometry.location);


          }(place));

        }
        map.fitBounds(bounds);
        searchBox.set('map', map);
        map.setZoom(Math.min(map.getZoom(),15));

      });
    }
  </script>
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM6qIb6FxMLJMQ2YeiOSvRD3afyUgKQeU&libraries=places&callback=initMap">
  </script>

  </div>
</div>
</div>
<!-- <div class="row">
<div class="col-xs-12">
<div class="card">

<div class="card-body">
  <div class="section">
        <div class="section-title" id="top-instructions-pickup">Setting your pick up</div>
        <div class="section-body">
          <div class="step">
<ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="step" class="active" id="step1-li-pickup">
        <a href="#step1-pickup" id="step1-tab-pickup" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
            <div class="icon fa fa-car"></div>
            <div class="heading">
                <div class="title">Using the quick access car</div>
                <div class="description">Click the car</div>
            </div>
        </a>
    </li>
    <li role="step" id="step2-li-pickup">
        <a href="#step2-pickup" role="tab" id="step2-tab-pickup" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-map-marker"></div>
            <div class="heading">
                <div class="title">Setting a Pick up</div>
                <div class="description">Placing a Marker.</div>
            </div>
        </a>
    </li>
    <li role="step" id="step3-li-pickup">
        <a href="#step3-pickup" role="tab" id="step3-tab-pickup" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-group"></div>
            <div class="heading">
                <div class="title">Matches</div>
                <div class="description">Check your matches</div>
            </div>
        </a>
    </li>
    <li role="step" id="step4-li-pickup">
        <a href="#step4-pickup" role="tab" id="step4-tab-pickup" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-paper-plane "></div>
            <div class="heading">
                <div class="title">Contact</div>
                <div class="description">Message your matched users</div>
            </div>
        </a>
    </li>
</ul>
 Tab panes
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="step1-pickup">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 1</b> : Click the quick access car to open the menu.
        </div>
        <div class="col-lg-3">
        <div style="float: left"><img src="{{asset('/uploads/instructions/1.png')}}"></div>
        </div>


      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 2</b> : Click "SET PICKUP".
        </div>
        <div class="col-lg-3">
        <div style="float: left"><img src="{{asset('/uploads/instructions/2.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-success" id="next1-pickup">Next</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step2-pickup">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 3</b> : Search for your general location (Subject to availability).
        </div>
        <div class="col-lg-5">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/3a.png')}}"></div>
        </div>


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
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 5</b> : Click "Save" to store your pick up and you're done.
        </div>
        <div class="col-lg-3">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/3d.png')}}"></div>
        </div>


      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-warning" id="prev2-pickup">Previous</button> <button type="button" class="btn btn-sm btn-success" id="next2-pickup">Next</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step3-pickup">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 6</b> : Check here to see your matches.
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/4new.png')}}"></div>
        </div>

      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 7</b> : Here you can see your matched users.
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/5.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-warning" id="prev3-pickup">Previous</button> <button type="button" class="btn btn-sm btn-success" id="next3-pickup">Next</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step4-pickup">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 8</b> : Click "MESSAGING".
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/6.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 9</b> : Choose a user to message. <br>(You may only message users you have been matched with)
        </div>
        <div class="col-lg-6">
        <div style="float: right"><img src="{{asset('/uploads/instructions/7.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-warning" id="prev4-pickup">Previous</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
</div>
</div>
        </div>
      </div>
</div>
</div>
</div>
</div> -->

<!-- Set route -->

<!-- <div class="row">
<div class="col-xs-12">
<div class="card">

<div class="card-body">
  <div class="section">
        <div class="section-title" id="top-instructions-route">Setting your route</div>
        <div class="section-body">
          <div class="step">
<ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="step" class="active" id="step1-li-route">
        <a href="#step1-route" id="step1-tab-route" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
            <div class="icon fa fa-car"></div>
            <div class="heading">
                <div class="title">Using the quick access car</div>
                <div class="description">Click the car</div>
            </div>
        </a>
    </li>
    <li role="step" id="step2-li-route">
        <a href="#step2-route" role="tab" id="step2-tab-route" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-map-marker"></div>
            <div class="heading">
                <div class="title">Setting your Route</div>
                <div class="description">Placing a Marker.</div>
            </div>
        </a>
    </li>
    <li role="step" id="step3-li-route">
        <a href="#step3-route" role="tab" id="step3-tab-route" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-group"></div>
            <div class="heading">
                <div class="title">Matches</div>
                <div class="description">Check your matches</div>
            </div>
        </a>
    </li>
    <li role="step" id="step4-li-route">
        <a href="#step4-route" role="tab" id="step4-tab-route" data-toggle="tab" aria-controls="profile">
            <div class="icon fa fa-paper-plane "></div>
            <div class="heading">
                <div class="title">Contact</div>
                <div class="description">Message your matched users</div>
            </div>
        </a>
    </li>
</ul>
 Tab panes
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="step1-route">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 1</b> : Click the quick access car to open the menu.
        </div>
        <div class="col-lg-3">
        <div style="float: left"><img src="{{asset('/uploads/instructions/1.png')}}"></div>
        </div>


      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 2</b> : Click "AUTO ROUTE".
        </div>
        <div class="col-lg-3">
        <div style="float: left"><img src="{{asset('/uploads/instructions/8.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-success" id="next1-route">Next</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step2-route">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 3</b> : Search for your general location (Subject to availability).
        </div>
        <div class="col-lg-5">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/3a.png')}}"></div>
        </div>


      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 4</b> : Click on the map to place a marker, This will be used by the system to match you to a driver.
        </div>
        <div class="col-lg-3">
        <div style="float: left"><img src="{{asset('/uploads/instructions/9.jpg')}}"></div>
        </div>
      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 5</b> : Click "Route" so the system can calculate your route.
        </div>
        <div class="col-lg-3">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/10.png')}}"></div>
        </div>


      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 6</b> : Confirm that the route generated is accurate.
        </div>
        <div class="col-lg-3">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/11.jpg')}}"></div>
        </div>


      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 7</b> : Click "Save" to store your route and you're done.
        </div>
        <div class="col-lg-3">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/3d.png')}}"></div>
        </div>


      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-warning" id="prev2-route">Previous</button> <button type="button" class="btn btn-sm btn-success" id="next2-route">Next</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step3-route">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 6</b> : Check here to see your matches.
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/4new.png')}}"></div>
        </div>

      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 7</b> : Here you can see your matched users.
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/5.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-warning" id="prev3-route">Previous</button> <button type="button" class="btn btn-sm btn-success" id="next3-route">Next</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="step4-route">
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 8</b> : Click "MESSAGING".
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/6.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 9</b> : Choose a user to message. <br>(You may only message users you have been matched with)
        </div>
        <div class="col-lg-6">
        <div style="float: right"><img src="{{asset('/uploads/instructions/7.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-8">
      <div style="float: right;"><button type="button" class="btn btn-sm btn-warning" id="prev4-route">Previous</button></div>
      </div>
      <div class="col-lg-1"></div>
      </div>
    </div>
</div>
</div>
        </div>
      </div>
</div>
</div>
</div>
</div> -->

<script>
$(function(){

  $('#next1-pickup').on('click', function(){
    $('#step1-li-pickup').removeClass('active');
    $('#step1-pickup').removeClass('active')
    $('#step2-li-pickup').addClass('active');
    $('#step2-pickup').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-pickup").offset().top
   }, 1000);
  });

  $('#next2-pickup').on('click', function(){
    $('#step2-li-pickup').removeClass('active');
    $('#step2-pickup').removeClass('active')
    $('#step3-li-pickup').addClass('active');
    $('#step3-pickup').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-pickup").offset().top
   }, 1000);
  });

  $('#next3-pickup').on('click', function(){
    $('#step3-li-pickup').removeClass('active');
    $('#step3-pickup').removeClass('active')
    $('#step4-li-pickup').addClass('active');
    $('#step4-pickup').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-pickup").offset().top
   }, 1000);
  });

  $('#prev2-pickup').on('click', function(){
    $('#step2-li-pickup').removeClass('active');
    $('#step2-pickup').removeClass('active')
    $('#step1-li-pickup').addClass('active');
    $('#step1-pickup').addClass('active');
  });

  $('#prev3-pickup').on('click', function(){
    $('#step3-li-pickup').removeClass('active');
    $('#step3-pickup').removeClass('active')
    $('#step2-li-pickup').addClass('active');
    $('#step2-pickup').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-pickup").offset().top
   }, 1000);
  });

  $('#prev4-pickup').on('click', function(){
    $('#step4-li-pickup').removeClass('active');
    $('#step4-pickup').removeClass('active')
    $('#step3-li-pickup').addClass('active');
    $('#step3-pickup').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-pickup").offset().top
   }, 1000);
  });

  $('#next1-route').on('click', function(){
    $('#step1-li-route').removeClass('active');
    $('#step1-route').removeClass('active')
    $('#step2-li-route').addClass('active');
    $('#step2-route').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-route").offset().top
   }, 1000);
  });

  $('#next2-route').on('click', function(){
    $('#step2-li-route').removeClass('active');
    $('#step2-route').removeClass('active')
    $('#step3-li-route').addClass('active');
    $('#step3-route').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-route").offset().top
   }, 1000);
  });

  $('#next3-route').on('click', function(){
    $('#step3-li-route').removeClass('active');
    $('#step3-route').removeClass('active')
    $('#step4-li-route').addClass('active');
    $('#step4-route').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-route").offset().top
   }, 1000);
  });

  $('#prev2-route').on('click', function(){
    $('#step2-li-route').removeClass('active');
    $('#step2-route').removeClass('active')
    $('#step1-li-route').addClass('active');
    $('#step1-route').addClass('active');
  });

  $('#prev3-route').on('click', function(){
    $('#step3-li-route').removeClass('active');
    $('#step3-route').removeClass('active')
    $('#step2-li-route').addClass('active');
    $('#step2-route').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-route").offset().top
   }, 1000);
  });

  $('#prev4-route').on('click', function(){
    $('#step4-li-route').removeClass('active');
    $('#step4-route').removeClass('active')
    $('#step3-li-route').addClass('active');
    $('#step3-route').addClass('active');

    $('html, body').animate({
       scrollTop: $("#top-instructions-route").offset().top
   }, 1000);
  });

});
</script>



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
