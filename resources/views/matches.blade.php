@extends('layouts.app')

@section('content')
<?php

//dbcon the ancient php lord ways
$dbcon = mysqli_connect("localhost", "root", "") or die("SERVER IS NOT AVAILABLE~".mysql_error());
mysqli_select_db($dbcon,"harambetadays") or die ("no data".mysql_error());

$selector = "SELECT * FROM `harambetadays`.`matches` WHERE ";
$where = "user1 = '".Auth::User()->studentID."' OR user2='".Auth::User()->studentID."'";
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
?>

<div class="row">
<?php foreach($matches as $key => $value){?>
    <div class="col-lg-4">
      <div class="card card-mini">
                    <?php
                    if($value["role"] == "Passenger"){
                    echo  '<div class="card-header" style="background-color: #39c3da; color: #fff;">';
                    echo '<h5><i class="fa fa-car"></i> &nbsp Driver</h5>';
                    }
                    else{
                    echo  '<div class="card-header" style="background-color: #095077; color: #fff;">';
                    echo '<h5><i class="fa fa-male"></i> &nbsp Passenger</h5>';
                    }
                    ?>
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
    <button type="button" class="btn btn-success"><i class="fa fa-thumbs-up"></i></button>
    <button type="button" class="btn btn-danger"><i class="fa fa-thumbs-down"></i></button>
    <button type="button" class="btn btn-warning report" data-toggle="modal" data-target="#modalReport">Report User</button>
    </div>
                  </div>
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
              <option value="Verbal Abuse" selected>Verbal Abuse</option>
              <option value="Spiritual Abuse">Spiritual Abuse</option>
              <option value="Psychological Abuse">Psychological Abuse</option>
            </select>
            </div>
          </div>
            <textarea style="resize:none" name="reportContent" rows="5" class="form-control" id="modalTextArea"></textarea>
          </form>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-success" id="btnSubmitReport" form="reportForm">Submit Report</button>
          </div>
        </div>
      </div>
    </div>
</div>
<?php
}
?>
</div>
<script>
$(function() {
  $('.report').on('click', function(){
  var userName = $(this).closest(".media-content").closest(".media-body").find(".title").text();
  var userID = $(this).closest(".media-content").closest(".media-body").find(".timeing").text();

  $('#modalUserName').val(userName);
  $('#modalUserID').val(userID);
  $('#modalTextArea').val("");
  });

  $('#btnSubmitReport').on('click', function(){
    $('#reportForm').submit();
  });

  // $('#reportForm').on('submit', function(e){

  //   e.preventDefault();
  //   $.ajax({
  //          type: "POST",
  //          url: "{{url('submitreport')}}",//FIXME Backend here
  //          data: $("#reportForm").serialize()
  //      });
  // });
});
</script>
@endsection
