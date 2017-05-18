@extends('layouts.app')

@section('content')
<?php

//dbcon the ancient php lord ways
$dbcon = mysqli_connect("localhost", "root", "") or die("SERVER IS NOT AVAILABLE~".mysql_error());
mysqli_select_db($dbcon,"harambetadays") or die ("no data".mysql_error());

$selector = "SELECT * FROM `harambetadays`.`matches` WHERE ";
$where = "(user1 = '".Auth::User()->studentID."' OR user2='".Auth::User()->studentID."')AND isDeleted = '0'";
$sql = $selector.$where;
//echo $sql;
$result = mysqli_query($dbcon,$sql);
$catcher = [];
$matches = [];

while($row = mysqli_fetch_assoc($result)){
        $catcher[] = $row;
        $temp = [];
        $temp["roomId"] = $row['id'];
        $temp["studentID"] = ($row['user1'] == Auth::User()->studentID ? $row['user2'] : $row['user1']);
        $temp["role"] = ($row['user1'] == Auth::User()->studentID ? "Driver" : "Passenger");

        if($temp["role"] == "Driver"){
          if($row['isRatedUser2'] == 1){
            $temp["rated"] = true;
          }
          else{
            $temp["rated"] = false;
          }
        }else if($temp["role"] == "Passenger"){
          if($row['isRatedUser1'] == 1){
          $temp["rated"] = true;
        }
        else{
          $temp["rated"] = false;
          }
        }
        //$temp["icon"] = ($row['user1'] == Auth::User()->studentID ? '<i class="fa fa-car"></i>' : '<i class="fa fa-male"></i>');
        $matches[] = $temp;
    }

foreach ($matches as $key => $value) {
  $selector = "SELECT firstName, lastName, profile_image FROM `harambetadays`.`users` WHERE ";
  $where = "studentID='".$value["studentID"]."'";
  $sql = $selector.$where;
  //echo $sql."<br>";
  $result = mysqli_query($dbcon,$sql);

  while($row = mysqli_fetch_assoc($result)){
          $matches[$key]["firstName"] = $row["firstName"];
          $matches[$key]["lastName"] = $row["lastName"];
          $matches[$key]["profile_image"] = $row["profile_image"];
      }

}

// echo '<pre>';
// echo var_dump($matches);
// echo '</pre>';

/////////////////////deleted matches
$selector = "SELECT * FROM `harambetadays`.`matches` WHERE ";
$where = "(user1 = '".Auth::User()->studentID."' OR user2='".Auth::User()->studentID."') AND isDeleted = '1'";
$sql = $selector.$where;
//echo $sql;
$result = mysqli_query($dbcon,$sql);
$catcher = [];
$matchess = [];

while($row = mysqli_fetch_assoc($result)){
        $catcher[] = $row;
        $temp = [];
        $temp["roomId"] = $row['id'];
        $temp["studentID"] = ($row['user1'] == Auth::User()->studentID ? $row['user2'] : $row['user1']);
        $temp["role"] = ($row['user1'] == Auth::User()->studentID ? "Driver" : "Passenger");

        if($temp["role"] == "Driver"){
          if($row['isRatedUser2'] == 1){
            $temp["rated"] = true;
          }
          else{
            $temp["rated"] = false;
          }
        }else if($temp["role"] == "Passenger"){
          if($row['isRatedUser1'] == 1){
          $temp["rated"] = true;
        }
        else{
          $temp["rated"] = false;
          }
        }
        //$temp["icon"] = ($row['user1'] == Auth::User()->studentID ? '<i class="fa fa-car"></i>' : '<i class="fa fa-male"></i>');
        $matchess[] = $temp;
    }

foreach ($matchess as $key => $value) {
  $selector = "SELECT firstName, lastName, profile_image FROM `harambetadays`.`users` WHERE ";
  $where = "studentID='".$value["studentID"]."'";
  $sql = $selector.$where;
  //echo $sql."<br>";
  $result = mysqli_query($dbcon,$sql);

  while($row = mysqli_fetch_assoc($result)){
          $matchess[$key]["firstName"] = $row["firstName"];
          $matchess[$key]["lastName"] = $row["lastName"];
          $matchess[$key]["profile_image"] = $row["profile_image"];
      }

}
$trueKaBa = false;
  if($matches == null && $matchess == null)
  {
    $trueKaBa = true;
  }

// echo '<pre>';
// echo var_dump($matchess);
// echo '</pre>';

?>

<div class="row">
  <div id="message-area"></div>
  @if($trueKaBa)
    <h1 class="well"><center>No Matches Available</center></h1>
  @endif


  @foreach($matches as $value)
    <div class="col-lg-4">
      <div class="card card-mini">
        @if($value["role"] == "Passenger")
        <div class="card-header" style="background-color: #39c3da; color: #fff;">
        <h5><i class="fa fa-car"></i> Driver</h5>
        @else
        <div class="card-header" style="background-color: #095077; color: #fff;">
        <h5><i class="fa fa-male"></i> Passenger</h5>
        @endif
                  </div>
                  <div class="card-body">
                    <div class="media social-post">
  <div class="media-left">

      <img class="profile-img" src="{{asset('uploads/profile').'/'.$value['profile_image']}}">

  </div>
  <div class="media-body">
    <div class="media-heading">
      <h4 class="title">{{$value["firstName"]." ".$value["lastName"]}}</h4>
      <h5 class="timeing">{{$value["studentID"]}}</h5>
    </div>
    <div class="media-content">
      <p>You were matched as {{$value["role"]}}</p>
      <input type="hidden" class="room-container" value="{{$value['roomId']}}">
    @if($value['rated'] == 0)
    <button type="button" class="btn btn-success btn-up"><i class="fa fa-thumbs-up"></i></button>
    <button type="button" class="btn btn-danger btn-down"><i class="fa fa-thumbs-down"></i></button>
    @else
    <button type="button" class="btn btn-success btn-up" disabled><i class="fa fa-thumbs-up"></i></button>
    <button type="button" class="btn btn-danger btn-down" disabled><i class="fa fa-thumbs-down"></i></button>
    @endif
    <button type="button" class="btn btn-warning report" data-toggle="modal" data-target="#modalReport">Report User</button>
    <button type="button" class="btn btn-info delete-match"><i class="fa fa-trash"></i></button>
    </div>
  </div>
  </div>
      </div>
  </div>

</div>
@endforeach
</div>
<div class="row">
@foreach($matchess as $value)
  <div class="col-lg-4">
    <div class="card card-mini">
      @if($value["role"] == "Passenger")
      <div class="card-header" style="background-color: #100000; color: #fff;">
      <strike><h5><i class="fa fa-car"></i> Driver</h5></strike>
      @else
      <div class="card-header" style="background-color: #100000; color: #fff;">
      <strike><h5><i class="fa fa-male"></i> Passenger</h5></strike>
      @endif
                </div>
                <div class="card-body">
                  <div class="media social-post">
<div class="media-left">

    <img class="profile-img" src="{{asset('uploads/profile').'/'.$value['profile_image']}}">

</div>
<div class="media-body">
  <div class="media-heading">
    <h4 class="title">{{$value["firstName"]." ".$value["lastName"]}}</h4>
    <h5 class="timeing">{{$value["studentID"]}}</h5>
  </div>
  <div class="media-content">
    <p>You were matched as {{$value["role"]}}</p>
    <input type="hidden" class="room-container" value="{{$value['roomId']}}">
  <button type="button" class="btn btn-warning revive-match"><i class="fa fa-heart"></i></button>
  </div>
</div>
</div>
    </div>
</div>

</div>
@endforeach
</div>
</div>



</div>

<div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Report User</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="{{url('submitreport')}}" id="reportForm">
                              {{csrf_field()}}
          <div class="row">
          <input type="hidden" class="form-control" name="userID" id="modalUserID">
          <input type="hidden" class="form-control" name="userName" id="modalUserName">
          <div class="row">
          <div class="col-sm-12">
          <select class="" name="reportCategory">
            <option value="Positive Report" selected>Positive Report</option>
            <option value="Verbal Abuse">Verbal Abuse</option>
            <option value="Tardiness">Tardiness</option>
            <option value="Unclean Vehicle">Unclean Vehicle</option>
          </select>
          </div>
        </div>
          <textarea style="resize:none" maxlength = '1000' name="reportContent" rows="5" class="form-control" id="modalTextArea"></textarea>
          <div id="charNum">1000 characters left.</div>
        </form>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" id="btnSubmitReport">Submit Report</button>
        </div>
      </div>
    </div>
  </div>

</div>
<form id="thumbForm" method="post" action="{{url('updown')}}">
   {{csrf_field()}}
  <input type="hidden" id="thumbUserID" name="userID">
  <input type="hidden" id="thumbRating" name="rating">
</form>

<form id="deleteMatchForm" method="post" action="{{url('removematch')}}">
   {{csrf_field()}}
   {{method_field('PUT')}}
  <input type="hidden" id="matchID" name="id">
</form>
<form id="reviveMatchForm" method="post" action="{{url('revivematch')}}">
   {{csrf_field()}}
   {{method_field('PUT')}}
  <input type="hidden" id="matchIDRevive" name="id">
</form>
<script>
$(function() {

  $('.revive-match').on('click', function(){
    $('#matchIDRevive').val($(this).closest(".media-content").closest(".media-body").find('.room-container').val());
    $.ajax({
      type: "POST",
      url: "{{url('revivematch')}}",
      data: $('#reviveMatchForm').serialize()
    });
    $('#message-area').append('<div class="flash-message alert-sucess"><strong><p class="alert alert-success">Match Successfully Restored<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
    window.setTimeout(function(){
   $(".flash-message").fadeTo(500,0).slideUp(500,function(){
       $(this).remove();
   });
  },7000);
  });

  $('.delete-match').on('click', function(){
    $('#matchID').val($(this).closest(".media-content").closest(".media-body").find('.room-container').val());
    $.ajax({
      type: "POST",
      url: "{{url('removematch')}}",
      data: $('#deleteMatchForm').serialize()
    });
    $('#message-area').append('<div class="flash-message alert-sucess"><strong><p class="alert alert-success">Match Successfully Removed<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
    window.setTimeout(function(){
   $(".flash-message").fadeTo(500,0).slideUp(500,function(){
       $(this).remove();
   });
  },7000);
  });

  $('.report').on('click', function(){
  var userName = $(this).closest(".media-content").closest(".media-body").find(".title").text();
  var userID = $(this).closest(".media-content").closest(".media-body").find(".timeing").text();

  $('#modalUserName').val(userName);
  $('#modalUserID').val(userID);
  $('#modalTextArea').val("");
  $('#charNum').text('1000 characters left.');
  });

  $('#btnSubmitReport').on('click', function(){
    $('#reportForm').submit();
  });

  $('#reportForm').on('submit', function(e){

    e.preventDefault();
    $.ajax({
           type: "POST",
           url: "{{url('submitreport')}}",//FIXME Backend here
           data: $("#reportForm").serialize()
       });

       $('#message-area').append('<div class="flash-message alert-sucess"><strong><p class="alert alert-info">Report successfully submitted. Thank you for helping the community be a better place!<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
       window.setTimeout(function(){
      $(".flash-message").fadeTo(500,0).slideUp(500,function(){
          $(this).remove();
      });
     },7000);
  });

  $('.btn-up').on('click', function(){
    $(this).closest('.media-content').find('.btn-down').prop('disabled',true);
    $(this).prop('disabled',true);
    var userName = $(this).closest(".media-content").closest(".media-body").find(".title").text();
    var userID = $(this).closest(".media-content").closest(".media-body").find(".timeing").text();
    // alert(userName + userID);
    $('#thumbUserID').val(userID);
    $('#thumbRating').val('UP');
    $.ajax({
      type: "POST",
      url: "{{url('updown')}}",//FIXME Backend here
      data: $("#thumbForm").serialize()
    });

    $('#message-area').append('<div class="flash-message alert-sucess"><strong><p class="alert alert-info">Rating successfully submitted. Thank you for helping the community be a better place!<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
    window.setTimeout(function(){
   $(".flash-message").fadeTo(500,0).slideUp(500,function(){
       $(this).remove();
   });
  },7000);
  });

  $('.btn-down').on('click', function(){
    $(this).closest('.media-content').find('.btn-up').prop('disabled',true);
    $(this).prop('disabled',true);
    var userName = $(this).closest(".media-content").closest(".media-body").find(".title").text();
    var userID = $(this).closest(".media-content").closest(".media-body").find(".timeing").text();
    //alert(userName + userID);
    $('#thumbUserID').val(userID);
    $('#thumbRating').val('DOWN');
    $.ajax({
      type: "POST",
      url: "{{url('updown')}}",//FIXME Backend here
      data: $("#thumbForm").serialize()
    });

    $('#message-area').append('<div class="flash-message alert-sucess"><strong><p class="alert alert-info">Rating successfully submitted. Thank you for helping the community be a better place!<a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong></div>');
    window.setTimeout(function(){
   $(".flash-message").fadeTo(500,0).slideUp(500,function(){
       $(this).remove();
   });
  },7000);
  });

  $('#modalTextArea').on('keyup', function () {
  var max = 1000;
  var len = $(this).val().length;
  if (len >= max) {
    $('#charNum').text(' You have reached the limit.');
  } else {
    var char = max - len;
    $('#charNum').text(char + ' characters left.');
  }
});
});
</script>
@endsection
