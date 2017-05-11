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
    </div>
                  </div>
                </div>
      </div>
  </div>
</div>
<?php
}
?>
</div>

@endsection
