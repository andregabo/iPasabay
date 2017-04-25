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
  <div class="col-xs-12">
<input type="hidden" class="form-control" placeholder="Room" id="room" value="11138254AND201401130" readonly>
  <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
    <script type="text/javascript" src="{{asset('assets/js/chat.js')}}"></script>
    <script type="text/javascript">





        var name = {{Auth::User()->studentID}};
        var room;

        // $('#room').on('change', function(){
        //   room = $(this).val();
        //   console.log(room);
        // });

    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");

    	// declare chat
        var chat;

    	$(function() {



         $('#chatBack').click(function(e){
           e.preventDefault();
           $('#collapseMessaging').removeClass('collapsed');
           $('#collapseMessaging').removeClass('in');


         });

         $('.chatIn').css('cursor', 'pointer');

         $('.chatIn').on('click', function(e){
           e.preventDefault();
           $('#collapseMessaging').addClass('collapsed');
           $('#collapseMessaging').addClass('in');

           $('#namePlace').text($(this).find('.title').text());
           //alert($(this).find('.description').text());
           $("#room").val($(this).find('.roomNo').val());
           room = $('#room').val();
           $('#chat-area').empty();
           chat =  new Chat(""+name, ""+room);
           chat.getStateChat(room);

           setInterval('chat.update()', 1000);
         });



        $('#sendButton').on('click', function(){

             var maxLength = $(this).attr("maxlength");
             var length = this.value.length;

             // don't allow new content if length is maxed out
             if (length >= maxLength) {
                 event.preventDefault();
             }else{
               var text = $('#sendie').val();
               chat.send(text, name, room);
               $('#sendie').val("");
             }
          });

    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {

                 var key = event.which;

                 //all keys including return.
                 if (key >= 33) {

                     var maxLength = $(this).attr("maxlength");
                     var length = this.value.length;

                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {
                         event.preventDefault();
                     }
                  }
    		 																																																});
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {

    			  if (e.keyCode == 13) {

                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");
                    var length = text.length;

                    // send
                    if (length <= maxLength + 1) {

    			        chat.send(text, name, room);
    			        $(this).val("");

                    } else {

    					$(this).val(text.substring(0, maxLength));

    				}


    			  }
             });

    	});
    </script>


<div class="app-messaging-container">
<div class="app-messaging collapse" id="collapseMessaging">
  <div class="chat-group">
  <div class="heading">Contacts</div>
  <ul class="group full-height" id="messageLeftPanel">
    <li class="section">Matches</li>
<?php
// $matches = [["ID" => "11138254", "NAME"=>"DLSU Ralph Bausas"],["ID" => "201401130", "NAME"=>"Ralph Bausas"]];
foreach($matches as $key => $value){?>
            <li class="message">
              <a class="chatIn">
                <div class="message">
                  <img class="profile" src="https://placehold.it/100x100">
                  <div class="content">
                    <div class="title">{{$value["firstName"]." ".$value["lastName"]}}</div>
                    <div class="description">{{$value["studentID"]}}</div>
                    <input type="hidden" class="roomNo" value="{{$value['roomId']}}"></input>
                  </div>
                </div>
              </a>
            </li>

    <?php
  }?>

</ul>
</div>
<!-- /////////////////////////// -->
  <div class="messaging x-scroll-top" style="height: 80vh">
    <div class="heading">
      <div class="title">
        <a id="chatBack" class="btn-back">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <div id="namePlace"></div>
      </div>
<div class="action"></div>
    </div>
    <ul class="chat" id="chat-area">


                <li class="line">
                  <div class="title">Chat Here</div>
                </li>


    </ul>
    <div class="footer">
      <form id="send-message-area">
      <div class="message-box">
        <textarea id="sendie" maxlength = '100' placeholder="Type something..." class="form-control"></textarea>
        <button type="button" id="sendButton" class="btn btn-default"><i class="fa fa-paper-plane"></i><span>Send</span></button>
      </div>
    </form>
    </div>
  </div>
</div>

</div>
</div>
</div>
@endsection
