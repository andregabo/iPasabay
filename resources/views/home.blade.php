@extends('layouts.app')

@section('content')


<main class="page-content section-98 section-sm-110">
      <!-- Classic Breadcrumbs-->
      <section class="breadcrumb-classic">
        <div class="shell section-34 section-sm-50">
          <div class="range range-lg-middle">
            <div class="cell-lg-2 veil reveal-sm-block cell-lg-push-2"><h1><i class="fa fa-car"></i></h1></span></div>
            <div class="cell-lg-5 veil reveal-lg-block cell-lg-push-1 text-lg-left">
              <h2><span class="big">Give a ride</span></h2>
            </div>
            <div class="offset-top-0 offset-sm-top-10 cell-lg-5 offset-lg-top-0 small cell-lg-push-3 text-lg-right">
              <div class="cell-md-4 cell-lg-3 offset-top-41 offset-md-top-0"><a href="#" class="btn btn-icon btn-lg btn-success btn-icon-"><span class="icon"></span>Read more</a>
                    </div>
            </div>
          </div>
        </div>
      </section>


      
        
          <!-- Classic Breadcrumbs-->
      <section class="breadcrumb-GOM">
        <div class="shell section-34 section-sm-50">
          <div class="range range-lg-middle">
            <div class="cell-lg-2 veil reveal-sm-block cell-lg-push-2"><h1><i class="fa fa-search"></i></h1></span></div>
            <div class="cell-lg-5 veil reveal-lg-block cell-lg-push-1 text-lg-left">
              <h2><span class="big">Look for a ride</span></h2>
            </div>
            <div class="offset-top-0 offset-sm-top-10 cell-lg-5 offset-lg-top-0 small cell-lg-push-3 text-lg-right">
              <div class="cell-md-4 cell-lg-3 offset-top-41 offset-md-top-0"><a href="#" class="btn btn-icon btn-lg btn-success btn-icon-"><span class="icon"></span>Read more</a>
                    </div>
            </div>
          </div>
        
      </section>

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
