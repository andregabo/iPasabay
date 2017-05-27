@extends('layouts.app')

@section('content')
<?php

//dbcon the ancient php lord ways
$dbcon = mysqli_connect("localhost", "root", "") or die("SERVER IS NOT AVAILABLE~".mysql_error());
mysqli_select_db($dbcon,"harambetadays") or die ("no data".mysql_error());

$selector = "SELECT * FROM `harambetadays`.`matches` WHERE ";
$where = "(user1 = '".Auth::User()->studentID."' OR user2='".Auth::User()->studentID."')";
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
        $temp["role"] = ($row['user1'] == Auth::User()->studentID ? "Passenger" : "Driver");
        $temp["isBoth"] = ($row['matched_again'] == 1 ? true : false);
				$temp["isDeleted"] = $row['isDeleted'];

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
  $selector = "SELECT firstName, lastName, profile_image, thumbs_up, thumbs_down FROM `harambetadays`.`users` WHERE ";
  $where = "studentID='".$value["studentID"]."'";
  $sql = $selector.$where;
  //echo $sql."<br>";
  $result = mysqli_query($dbcon,$sql);

  while($row = mysqli_fetch_assoc($result)){
          $matches[$key]["firstName"] = $row["firstName"];
          $matches[$key]["lastName"] = $row["lastName"];
          $matches[$key]["profile_image"] = $row["profile_image"];
          $matches[$key]['thumbsUp'] = $row['thumbs_up'];
          $matches[$key]['thumbsDown'] = $row['thumbs_down'];
      }

}

// echo '<pre>';
// echo var_dump($matches);
// echo '</pre>';


$trueKaBa = false;
  if($matches == null && $matchess == null)
  {
    $trueKaBa = true;
  }

// echo '<pre>';
// echo var_dump($banList);
// echo '</pre>';

?>
<div class="row">
	<div class="col-xs-10 col-xs-offset-1">
  <div class="flash-message" style="">
                @foreach(['danger','warning','success','info'] as $message)
                 @if (Session::has('alert-'. $message))
                  <strong><p class="alert alert-{{$message}}"><i class='fa fa-lock'></i>&nbsp;{{Session::get('alert-'.$message)}} <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong>
                  @endif
                @endforeach
            </div>
		<div class="card">

			<div class="card-header" style="background-color: #ff4444; color: white; font-weight: bold;">
				<p><strong>User {{Auth::User()->studentID}}'s Profile Details</strong></p>
			</div>
				<div class="card-body no-padding">
					<div class="row">
						<div class="col-md-6">
						<table class="table">
							<tr>
								<td><strong>User ID:</strong></td>
								<td>{{Auth::User()->studentID}}</td>
							</tr>
							<tr>
								<td><strong>First Name:</strong></td>
								<td>{{Auth::User()->firstName}}</td>
							</tr>
							<tr>
								<td><strong>Last Name:</strong></td>
								<td>{{Auth::User()->lastName}}</td>
							</tr>
							<tr>
								<td><strong>Like Vs. Dislike</strong></td>
							@if((Auth::User()->thumbs_up + Auth::User()->thumbs_down) > 0)
							<td>
							<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" style="width: {{(Auth::User()->thumbs_up/(Auth::User()->thumbs_up+Auth::User()->thumbs_down))*100}}%"><i class="fa fa-thumbs-up"></i> ({{Auth::User()->thumbs_up}})</div>
							<div class="progress-bar progress-bar-danger" role="progressbar" style="width: {{(Auth::User()->thumbs_down/(Auth::User()->thumbs_up+Auth::User()->thumbs_down))*100}}%"><i class="fa fa-thumbs-down"></i> ({{Auth::User()->thumbs_down}})</div>
							</div>
							</td>
							@else
							<td>No Data Available.</td>
							@endif
							</tr>
              <tr>
                <td><button type="button" class="btn btn-sm btn-warning" id="btnModal">Edit Details</button></td>
                <td><button id="btnModalPassword" class="btn btn-primary">Change Password</button></td>
              </tr>
						</table>




						</div>
						<div class="col-md-6">
							<ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#pickup" aria-controls="home" role="tab" data-toggle="tab">Pick Up Point</a></li>
        <li role="presentation"><a id="routeTabClick" href="#route" aria-controls="profile" role="tab" data-toggle="tab">Route</a></li>
    				</ul>

						<div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="pickup">

					<div id="pickUpMap" style="height:60vh"> </div>

				</div>
        <div role="tabpanel" class="tab-pane" id="route">
					<div id="routeMap" style="height:60vh"> </div>
					</div>
			</div>

							<!-- Hello, Please display google route using the given variables:<br>
							$plong = {{$plong}}<br>
							$plat={{$plat}} -->
						</div>
					</div>

			</div>

		</div>



	</div>


</div>
<div class="row">
  <div class="col-xs-12">
    <!-- Modal -->
    <div class="modal fade" id="modalPanel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">User Details</h4>
          </div>
          <div class="modal-body">
            <form id="formModify" action="{{route('editprofile')}}" method="post"><?php // FIXME: Do backend for this ?>
              {{method_field('PATCH')}}

              {{ csrf_field() }}
              <div class="form-group">
                  <div class="row">
                  <label class="col-md-3 control-label">Login:</label>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="" id="txtLogin" name="studentID">
                  </div>
                </div>
                <div class="row">
                <label class="col-md-3 control-label">First Name:</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" placeholder="" id="txtFirstName" name="firstName">
                </div>
              </div>
              <div class="row">
              <label class="col-md-3 control-label">Last Name:</label>
              <div class="col-md-9">
                <input type="text" class="form-control" placeholder="" id="txtLastName" name="lastName">
              </div>
            </div>
              </div>
          </form>

          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button> -->
            <button type="button" class="btn btn-sm btn-warning" id="btnModify">Modify</button>
            <button type="submit" class="btn btn-sm btn-success" form="formModify" value="submit">Save changes</button>
          </div>
        </div>
      </div>
    </div>

</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="card">
<div class="card-body">
<form enctype="multipart/form-data" action="{{asset('scripts/imageUpload.php')}}" method="post">
        <div class="col-md-6"></div>
        <div id="image-preview">
          <label for="image-upload" id="image-label">Profile Image</label>
          <input type="hidden" name="studentID" value="{{Auth::User()->studentID}}"/>
          <input type="file" name="image" id="image-upload" accept=".jpg,.jpeg,.png,.bmp"/>
          <hr>
          <button type="submit" class="btn btn-w-m btn-warning">Change Picture</button>
          <br><br>
          <div class="well"><small>Click Change Picture without selecting an image to <strong>revert to default image</strong>.</small></div>
      </div>
</form>
</div>
</div>
</div>

<div class="col-sm-6">
<div class="card">
<div class="card-header">Ban List</div>
<div class="card-body">
	<table class="table table-striped datatable table-condensed" cellspacing="0" width="100%">
			<thead>
					<tr>
							<th>#</th>
							<th>Student ID</th>
							<th>Name</th>
							<th>Role</th>
							<th>Action</th>
					</tr>
			</thead>
			<tbody><?php
			$counter = 1;
			?>
				@if(true)
				@foreach($matches as $match)
				@if($match['isDeleted'] > 0)
					<tr>
						@else
						<tr>
						@endif
						<th>{{$counter}}</th>
						<td class="banID">{{$match["studentID"]}}</td>
						<td>{{$match["firstName"]." ".$match["lastName"]}}</td>
						<td>@if($match["isBoth"] == true)
							{{"Driver/Passenger"}}
							@else
							{{$match["role"]}}
							@endif
						</td>
						<td class="action-td">
							@if(in_array($match["studentID"], $banList))
							<button type="button" class="btn btn-info btn-sm btn-unban" title="Unban User" style="min-width: 80px">Unban</button>
							@else
							<button type="button" class="btn btn-danger btn-sm btn-ban" title="Ban User" style="min-width: 80px">Ban</button>
							@endif
						</td>
					</tr>

					<?php
					$counter++;
					?>
				@endforeach

				@else
				<tr>
				<td colspan="5"><center><h4 class="label label-primary" style="text-align: center;">No Matches to show.</h4></center>
				</td>
				</tr>
				@endif
			</tbody>
		</table>
</div>
</div>
</div>

</div>
<!-- Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Change Password</h4>
          </div>
          <div class="modal-body">
            <form id="formPassword" action="{{url('changepassword')}}" method="post"><?php // FIXME: Do backend for this ?>
              {{method_field('PATCH')}}
              {{ csrf_field() }}
              <div class="form-group">
              <div class="row">
                  <label class="col-md-4 control-label">Old Password:</label>
                  <div class="col-md-8">
                    <input type="password" class="form-control" placeholder="Minimum of 6 characters" id="oldPassword" name="oldPassword" min="6">
                  </div>
                </div>
                <div class="row">
                  <label class="col-md-4 control-label">New Password:</label>
                  <div class="col-md-8">
                    <input type="password" class="form-control" placeholder="Minimum of 6 characters" id="newPassword" name="newPassword" min="6">
                  </div>
                </div>
              <div class="row">
                <label class="col-md-4 control-label">Re-type New Password:</label>
                <div class="col-md-8">
                  <input type="password" class="form-control" placeholder="" id="confirmPassword" name="confirmPassword">
                </div>
              </div>
              </div>
          </form>

          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button> -->
            <button type="button" class="btn btn-sm btn-warning" id="btnModify">Modify</button>
            <button type="submit" class="btn btn-sm btn-success" form="formPassword" value="submit">Save changes</button>
          </div>
        </div>
      </div>
    </div>
		<form id="banForm" method="post">
			{{ csrf_field() }}
			<input type="hidden" id="banUser" name="banID">
		</form>

		<form id="unbanForm" method="post">
			{{ csrf_field() }}
			<input type="hidden" id="unbanUser" name="banID">
		</form>
    <script type="text/javascript">
    $('#btnModalPassword').on('click',function(){
    $('#passwordModal').modal();
});
    window.setTimeout(function(){
    $(".flash-message").fadeTo(500,0).slideUp(500,function(){
        $(this).remove();
    });
   },7000);
    </script>
<script>
$(function(){

	$(".btn-ban").on('click', function(){
		$('#banUser').val($(this).closest('tr').find('.banID').text());
		$('#banForm').submit();
		//$(this).closest('tr').find('.action-td').empty();
		//$(this).closest('tr').find('.action-td').append('<button type="button" class="btn btn-danger btn-sm btn-ban" title="Ban User" style="min-width: 80px">Ban</button>');

	});
	$("#banForm").on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
      url: "{{url('banuser')}}",
      data: $('#banForm').serialize(),
			success: function(){
        window.location.reload();
      }
		});
	});

	$(".btn-unban").on('click', function(){
		$('#unbanUser').val($(this).closest('tr').find('.banID').text());
		$('#unbanForm').submit();
		//$(this).closest('tr').find('.action-td').empty();
		//$(this).closest('tr').find('.action-td').append('<button type="button" class="btn btn-danger btn-sm btn-ban" title="Ban User" style="min-width: 80px">Ban</button>');

	});
	$("#unbanForm").on('submit', function(e){
		e.preventDefault();
		$.ajax({
			type: "POST",
      url: "{{url('unbanuser')}}",
      data: $('#unbanForm').serialize(),
			success: function(){
        window.location.reload();
      }
		});
	});
})
</script>


<script>
$('#btnModal').on('click',function(){
    $('#modalPanel').modal();
    $('#txtLogin').val({{Auth::User()->studentID}});
    $('#txtLogin').prop('readonly', true);
    $('#txtFirstName').val("{{Auth::User()->firstName}}");
    $('#txtFirstName').prop('readonly', true);
    $('#txtLastName').val("{{Auth::User()->lastName}}");
    $('#txtLastName').prop('readonly', true);
});

$('#btnModify').on('click', function(){
      // $('#txtLogin').prop('readonly', false);
      $('#txtFirstName').prop('readonly', false);
      $('#txtLastName').prop('readonly', false);

    });

  $('#item').croppie(opts);
  // call a method via jquery
  $('#item').croppie(method, args);
</script>

<script>
      function initMap() {
var myLatLng = {lat: 14.561350, lng: 121.019490};

if("{{$rlat}}" != "none"){
	var route = {lat: {{$rlat}}, lng: {{$rlong}}};
	var routeMap = new google.maps.Map(document.getElementById('routeMap'), {
		zoom: 17,
		center: route,
		clickableIcons: false,
		mapTypeControl: false,
		streetViewControl: false
		@if(true)
		,styles: [
	{
			"featureType": "all",
			"elementType": "all",
			"stylers": [
					{
							"saturation": "-100"
					},
					{
							"gamma": "0.50"
					}
			]
	},
	{
			"featureType": "administrative.province",
			"elementType": "labels.text",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "administrative.locality",
			"elementType": "labels.text",
			"stylers": [
					{
							"visibility": "on"
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
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi",
			"elementType": "all",
			"stylers": [
					{
							"visibility": "off"
					}
			]
	},
	{
			"featureType": "poi.attraction",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi.business",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi.government",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi.medical",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi.park",
			"elementType": "all",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi.park",
			"elementType": "geometry.fill",
			"stylers": [
					{
							"color": "#059960"
					}
			]
	},
	{
			"featureType": "poi.park",
			"elementType": "labels",
			"stylers": [
					{
							"visibility": "off"
					}
			]
	},
	{
			"featureType": "poi.place_of_worship",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi.school",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "poi.sports_complex",
			"elementType": "labels.text",
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
			"elementType": "geometry.fill",
			"stylers": [
					{
							"color": "#f57f27"
					}
			]
	},
	{
			"featureType": "road.highway",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "road.highway.controlled_access",
			"elementType": "labels.text",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "road.arterial",
			"elementType": "labels",
			"stylers": [
					{
							"visibility": "on"
					},
					{
							"saturation": "0"
					},
					{
							"gamma": "0.50"
					}
			]
	},
	{
			"featureType": "road.arterial",
			"elementType": "labels.text",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "road.arterial",
			"elementType": "labels.icon",
			"stylers": [
					{
							"visibility": "off"
					}
			]
	},
	{
			"featureType": "road.local",
			"elementType": "labels",
			"stylers": [
					{
							"visibility": "off"
					}
			]
	},
	{
			"featureType": "road.local",
			"elementType": "labels.text",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "transit",
			"elementType": "all",
			"stylers": [
					{
							"visibility": "off"
					}
			]
	},
	{
			"featureType": "transit.station.bus",
			"elementType": "labels.text",
			"stylers": [
					{
							"visibility": "on"
					}
			]
	},
	{
			"featureType": "water",
			"elementType": "geometry",
			"stylers": [
					{
							"color": "#02758c"
					}
			]
	},
	{
			"featureType": "water",
			"elementType": "labels",
			"stylers": [
					{
							"visibility": "off"
					}
			]
	}
]
@endif
	});

	var iacademyMarker = new google.maps.Marker({
position: myLatLng,
map: routeMap,
title: 'iACADEMY',
draggable: false
});

var myMarker = new google.maps.Marker({
position: {lat:{{$rlat}} , lng: {{$rlong}}},
map: routeMap,
title: 'startPoint',
draggable: false
});

	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer({
	polylineOptions: {
							strokeColor: "#9676bb",
							strokeWeight: 6,
							strokeOpacity: 0.6
					},
		suppressMarkers: true
	});


directionsDisplay.setMap(routeMap);

getRoute();
}else{
$('#routeMap').append('<p>No Route Available</p>')
}



		if("{{$plat}}" != "none"){
        var pickup = {lat: {{$plat}}, lng: {{$plong}}};
				//alert("{{$plat}}");
				var map = new google.maps.Map(document.getElementById('pickUpMap'), {
          zoom: 17,
          center: pickup,
					clickableIcons: false,
      		mapTypeControl: false,
					streetViewControl: false
					@if(true)
		      ,styles: [
		    {
		        "featureType": "all",
		        "elementType": "all",
		        "stylers": [
		            {
		                "saturation": "-100"
		            },
		            {
		                "gamma": "0.50"
		            }
		        ]
		    },
		    {
		        "featureType": "administrative.province",
		        "elementType": "labels.text",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "administrative.locality",
		        "elementType": "labels.text",
		        "stylers": [
		            {
		                "visibility": "on"
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
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.attraction",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.business",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.government",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.medical",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.park",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.park",
		        "elementType": "geometry.fill",
		        "stylers": [
		            {
		                "color": "#059960"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.park",
		        "elementType": "labels",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.place_of_worship",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.school",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "poi.sports_complex",
		        "elementType": "labels.text",
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
		        "elementType": "geometry.fill",
		        "stylers": [
		            {
		                "color": "#f57f27"
		            }
		        ]
		    },
		    {
		        "featureType": "road.highway",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "road.highway.controlled_access",
		        "elementType": "labels.text",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "road.arterial",
		        "elementType": "labels",
		        "stylers": [
		            {
		                "visibility": "on"
		            },
		            {
		                "saturation": "0"
		            },
		            {
		                "gamma": "0.50"
		            }
		        ]
		    },
		    {
		        "featureType": "road.arterial",
		        "elementType": "labels.text",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "road.arterial",
		        "elementType": "labels.icon",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "road.local",
		        "elementType": "labels",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "road.local",
		        "elementType": "labels.text",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "transit",
		        "elementType": "all",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    },
		    {
		        "featureType": "transit.station.bus",
		        "elementType": "labels.text",
		        "stylers": [
		            {
		                "visibility": "on"
		            }
		        ]
		    },
		    {
		        "featureType": "water",
		        "elementType": "geometry",
		        "stylers": [
		            {
		                "color": "#02758c"
		            }
		        ]
		    },
		    {
		        "featureType": "water",
		        "elementType": "labels",
		        "stylers": [
		            {
		                "visibility": "off"
		            }
		        ]
		    }
		]
		@endif
        });
        var marker = new google.maps.Marker({
          position: pickup,
          map: map
        });
			}else{
				$('#pickUpMap').append("<p>No Pickup Available</p>")
			}

	function getRoute(){
		var request = {
			origin: route,
			destination: iacademyMarker.position,
			provideRouteAlternatives: false,
			travelMode: google.maps.DirectionsTravelMode.DRIVING //Change this to WALKING if needed
		};

		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
		});
			}

      document.getElementById("routeTabClick").addEventListener("click", function(event) {
      					getRoute();

      					google.maps.event.trigger(routeMap, 'resize');
      					routeMap.setCenter(myMarker.getPosition());

      					//google.maps.event.trigger(routeMap, 'resize');
      			});

      			google.maps.event.addListener(routeMap, 'idle', function() {
          google.maps.event.trigger(routeMap, 'resize');
      		routeMap.fitBounds(directionsDisplay.getDirections().routes[0].bounds);


      });

      google.maps.event.addListener(map, 'idle', function() {
    google.maps.event.trigger(map, 'resize');
    map.panTo(pickup);
    map.setZoom(17);


});

}//initmap

    </script>

		<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAM6qIb6FxMLJMQ2YeiOSvRD3afyUgKQeU&v=3.exp&libraries=geometry&callback=initMap">
		</script>
@endsection
