<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  	<link rel="icon" href="{{asset('/favicon.ico')}}" type="image/x-icon">
	<title>{{config('app.name')}}</title>
	<style type="text/css">
  	.gradientbg{
    background-color:#77d9c4; filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#77d9c4, endColorstr=#57bc90); background-image:-moz-linear-gradient(top, #77d9c4 0%, #57bc90 100%); background-image:-webkit-linear-gradient(top, #77d9c4 0%, #57bc90 100%); background-image:-ms-linear-gradient(top, #77d9c4 0%, #57bc90 100%); background-image:linear-gradient(top, #77d9c4 0%, #57bc90 100%); background-image:-o-linear-gradient(top, #77d9c4 0%, #57bc90 100%); background-image:-webkit-gradient(linear, right top, right bottom, color-stop(0%,#77d9c4), color-stop(100%,#57bc90));
  	}
  	#errorCode{
  		font-size: 7em; text-align: center;
  	}
]
</style>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendor.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flat-admin.css')}}">
</head>
<body class="gradientbg">
<div class="col-xs-8 col-xs-offset-2" style="margin-top: 50px; margin-bottom: ">
	<div class="card">
		<div class="card-header" style="background-color: #ff4444; color: white; font-weight: bold;">
			<div class="card-title"><i class="fa fa-exclamation-circle"></i>&nbsp;Error</div>
		</div>
		<div class="card-body" style="text-align: center;">
			<h1 id="errorCode">404</h1>
			<p align="center" style="font-size: 2em;">Oops! Something went wrong there.</p>
			<a href="{{url('/')}}" class="btn btn-success">Go Back</a>

			<img src="{{asset('uploads/error/cat.png')}}" width="100%" style="display: inline;">
		</div>
	</div>
</div>
</body>
</html>