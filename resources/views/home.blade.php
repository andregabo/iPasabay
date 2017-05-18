@extends('layouts.app')

@section('content')
<div class="row">
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
<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="step1-pickup">
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
        <div class="col-lg-6">
        <div style="float: right"><img src="{{asset('/uploads/instructions/4.jpg')}}"></div>
        </div>
        <div class="col-lg-3">
        <b>Step 6</b> : Check here to see your matches.
        </div>
        <div class="col-lg-3"></div>
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
</div>


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
