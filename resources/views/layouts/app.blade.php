<?php
//dbcon the ancient php lord ways
$dbcon = mysqli_connect("localhost", "root", "") or die("SERVER IS NOT AVAILABLE~".mysql_error());
mysqli_select_db($dbcon,"harambetadays") or die ("no data".mysql_error());

$selector = "SELECT COUNT(id) FROM `harambetadays`.`matches` WHERE ";
$where = "user1 = '".Auth::User()->studentID."' OR user2='".Auth::User()->studentID."'";
$sql = $selector.$where;
//echo $sql;
$result = mysqli_query($dbcon,$sql);
$countMatches = $result->fetch_assoc()['COUNT(id)'];
//echo $countMatches;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '') }}</title>


    <!-- <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"> -->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendor.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flat-admin.css')}}">

  <!-- Theme -->
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue-sky.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/blue.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/red.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/yellow.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/theme/daniel-sky.css">

  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/croppie.css')}}">

    <!-- JavaScripts -->

    <!-- <script src="js/app.js"></script> -->

     <script type="text/javascript" src="{{asset('assets/js/vendor.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
    <script>
         window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>




</head>
<body>
<div class="app app-daniel-sky">

<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="#"><span class="highlight">i</span>Pasabay</a>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li id="dashboard" class="active">
        <a href="{{url('/home')}}">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Dashboard</div>
        </a>
      </li>
      <li id="messages" class="">
        <a href="{{url('/messages')}}">
          <div class="icon">
            <i class="fa fa-comments" aria-hidden="true"></i>
          </div>
          <div class="title">Messaging</div>
        </a>
      </li>


    </ul>
  </div>
  <div class="sidebar-footer">
    <ul class="menu">
      <li>
        <a href="/" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-cogs" aria-hidden="true"></i>
        </a>
      </li>
      <li><a href="#"><span class="flag-icon flag-icon-th flag-icon-squared"></span></a></li>
    </ul>
  </div>
</aside>

<script type="text/ng-template" id="sidebar-dropdown.tpl.html">
  <div class="dropdown-background">
    <div class="bg"></div>
  </div>
  <div class="dropdown-container">
  </div>
</script>
<div class="app-container">

  <nav class="navbar navbar-default" id="navbar">
  <div class="container-fluid">
    <div class="navbar-collapse collapse in">
      <ul class="nav navbar-nav navbar-mobile">
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        <li class="logo">
          <a class="navbar-brand" href="#"><span class="highlight">i</span> Pasabay</a>
        </li>
        <li>
          <button type="button" class="navbar-toggle">
            <img class="profile-img" src="{{asset('uploads/profile')."/".Auth::User()->profile_image}}">
          </button>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown profile">
          <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="{{asset('uploads/profile')."/".Auth::User()->profile_image}}">
            <div class="title">Profile</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username">{{Auth::User()->firstName." ".Auth::User()->lastName}}</h4>
            </div>
            <ul class="action">
              <li>
                <a href="{{url('/profile')}}">
                  Profile
                </a>
              </li>
              <li>
                <a href="{{ url('/matches') }}">
                  <span class="badge badge-info pull-right">{{$countMatches}}</span>
                  My Matches
                </a>
              </li>
              <li>
                <a href="#">
                  Setting
                </a>
              </li>

            </ul>
          </div>
        </li>
        <li class="dropdown notification danger">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
            <div class="title">Notifications</div>
            <div class="count">8</div>
          </a><div class="dropdown-menu">
            <ul>
              <li class="dropdown-header">Notification</li>
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">8</span>
                  <div class="message">
                    <div class="content">
                      <div class="title">New Order</div>
                      <div class="description">$400 total</div>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">14</span>
                  Inbox
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">5</span>
                  Issues Report
                </a>
              </li>
              <li class="dropdown-footer">
                <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
        </li>

        <li class="dropdown notification warning">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" href="{{ url('/logout') }}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
            <div class="icon"><i class="fa fa-sign-out" aria-hidden="true"></i></div>
            <div class="title">Logout</div>
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>

            <div class="dropdown-menu">
              <ul>
                <li class="dropdown-header">Logout</li>
              </ul>
            </div>
        </li>


      </ul>
    </div>
  </div>
</nav>

<div class="btn-floating" id="help-actions">
  <div class="btn-bg"></div>
  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
    <i class="fa fa-car"></i>
    <span class="help-text">Shortcut</span>
  </button>
  <div class="toggle-content">
    <ul class="actions">
      <li><a href="{{ url('/setpickup') }}">Set Pickup</a></li>
      <li><a href="{{ url('/getroute') }}">Auto Route</a></li>
      <li><a href="{{ url('/messages')}}">Messaging</a></li>
      <li><a href="{{ url('/matches')}}">Matches</a></li>
    </ul>
  </div>
</div>
    @yield('content')
    </div>
    </div>

  <script type="text/javascript" src="{{asset('assets/js/vendor.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/app.js')}}"></script>
  <script type="text/javascript" src="{{asset('assets/js/croppie.js')}}"></script>
    <!-- Scripts -->

    <!-- Java script-->
    <script src="js/script.js"></script>
<script>

   $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

</script>
</body>
</html>
