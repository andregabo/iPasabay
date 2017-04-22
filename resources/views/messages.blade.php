@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-xs-12">
    <p>Messages</p>
  </div>
<input type="text" class="form-control" placeholder="Room" id="room" value="newchat" readonly>
  <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
    <script type="text/javascript" src="{{asset('assets/js/chat.js')}}"></script>
    <script type="text/javascript">

        var name = {{Auth::User()->studentID}};
        var room = $('#room').val();

        $('#room').on('change', function(){
          room = $(this).val();
          console.log(room);
        });

    	// strip tags
    	name = name.replace(/(<([^>]+)>)/ig,"");

    	// kick off chat
        var chat =  new Chat();
    	$(function() {

    		 chat.getStateChat(room);

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



<!-- //////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="app-messaging-container" onload="setInterval('chat.update()', 1000)">
<div class="app-messaging" id="collapseMessaging">
  <div class="messaging">
    <div class="heading">
      <div class="title">

        Chat Kayo bes.
      </div>

    </div>
    <ul class="chat">
      <div id="chat-area"></div>
    </ul>
    <div class="footer">
      <form id="send-message-area">
      <div class="message-box">
        <textarea id="sendie" maxlength = '100' placeholder="type something..." class="form-control"></textarea>
        <button type="button" id="sendButton" class="btn btn-default"><i class="fa fa-paper-plane"></i><span>Send</span></button>
      </div>
    </form>
    </div>
  </div>
</div>
</div>
</div>
@endsection
