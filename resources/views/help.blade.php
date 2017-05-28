@extends('layouts.app')

@section('content')

<style>
  img{
    max-width: 100%;
    max-height: 100%;
  }
</style>

<div class="row">
<div class="col-lg-10 col-lg-offset-1" style="">
<div class="card">

<div class="card-header" id="top-instructions-pickup" style="background-color: #ff4444; color: white; font-weight: bold;">1. Setting your pick up</div>
<div class="card-body">
  <div class="section">

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
        <b>Step 5</b> : Click "Save My Pickup" to store your pick up.
        </div>
        <div class="col-lg-3">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/3d.png')}}"></div>
        </div>


      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 6</b> : Click "Match Me" to get matched with drivers and you're done.
        </div>
        <div class="col-lg-3">
        <div style="float: left;"><img src="{{asset('/uploads/instructions/12.png')}}"></div>
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
        <b>Step 7</b> : Check here to see your matches.
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/4new.png')}}"></div>
        </div>

      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 8</b> : Here you can see your matched users.
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
        <b>Step 9</b> : Click "MESSAGING".
        </div>
        <div class="col-lg-6">
        <div style="float: left"><img src="{{asset('/uploads/instructions/6.png')}}"></div>
        </div>
      </div>
      <hr>
      <div class = "row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
        <b>Step 10</b> : Choose a user to message. <br>(You may only message users you have been matched with)
        </div>
        <div class="col-lg-6">
        <div style=""><img src="{{asset('/uploads/instructions/7.png')}}"></div>
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
</div>


  <div class="row">
  <div class="col-lg-10 col-lg-offset-1">
  <div class="card">

    <div class="card-header" id="top-instructions-route" style="background-color: #ff4444; color: white; font-weight: bold;">2. Setting your route</div>
  <div class="card-body">
    <div class="section">

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
   <!-- Tab panes -->
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
          <div class="col-lg-8">
          <div style="float: left"><img src="{{asset('/uploads/instructions/9.jpg')}}" width="100%"></div>
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
          <div class="col-lg-8">
          <div style="float: left;"><img src="{{asset('/uploads/instructions/11.jpg')}}" width="100%"></div>
          </div>


        </div>
        <hr>
        <div class = "row">
          <div class="col-lg-1"></div>
          <div class="col-lg-3">
          <b>Step 7</b> : Click "Save My Route" to store and generate your route.
          </div>
          <div class="col-lg-3">
          <div style="float: left;"><img src="{{asset('/uploads/instructions/3d.png')}}"></div>
          </div>


        </div>
        <hr>
        <div class = "row">
          <div class="col-lg-1"></div>
          <div class="col-lg-3">
          <b>Step 8</b> : Click "Match Me" to get matched with passengers and you're done.
          </div>
          <div class="col-lg-3">
          <div style="float: left;"><img src="{{asset('/uploads/instructions/12.png')}}"></div>
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
          <b>Step 9</b> : Check here to see your matches.
          </div>
          <div class="col-lg-6">
          <div style="float: left"><img src="{{asset('/uploads/instructions/4new.png')}}"></div>
          </div>

        </div>
        <hr>
        <div class = "row">
          <div class="col-lg-1"></div>
          <div class="col-lg-3">
          <b>Step 10</b> : Here you can see your matched users.
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
          <b>Step 11</b> : Click "MESSAGING".
          </div>
          <div class="col-lg-6">
          <div style="float: left"><img src="{{asset('/uploads/instructions/6.png')}}"></div>
          </div>
        </div>
        <hr>
        <div class = "row">
          <div class="col-lg-1"></div>
          <div class="col-lg-3">
          <b>Step 12</b> : Choose a user to message. <br>(You may only message users you have been matched with)
          </div>
          <div class="col-lg-6">
          <div><img src="{{asset('/uploads/instructions/7.png')}}"></div>
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
  </div>


<script>
$(function(){
  stateChange();

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
@endsection
