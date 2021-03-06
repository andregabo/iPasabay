/*
Created by: Kenrick Beckett

Name: Chat Engine
*/

var instanse = false;
var state;
var mes;
var file;
var userName;
var room;
var audio = new Audio('../public/assets/music/knock.mp3');

function Chat (name, proom) {
    this.update = updateChat;
    this.send = sendChat;
	this.getStateChat = getStateOfChat;
  userName = name;
  room = proom;
  console.log(room);
}

//gets the state of the chat
function getStateOfChat(room){
  //console.log("state:"+room);
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "../public/scripts/chat.php",
			   data: {
			   			'function': 'getState',
              'chatroom': room,
						'file': file
						},
			   dataType: "json",

			   success: function(data){
				   state = data.state;
				   instanse = false;
           state = 0;
           updateChat();
			   },
			});
	}
}

//Updates the chat
function updateChat(){
  //console.log("update:"+room);
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "../public/scripts/chat.php",
			   data: {
			   			'function': 'update',
              'chatroom': room,
						'state': state,
						'file': file
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {

              var htmlDummyDoc = $.parseXML(data.text[i]);
              $htmlDummy = $(htmlDummyDoc);
              $userID = $htmlDummy.find('sender');
              $userMessage = $htmlDummy.find('body');
              $timeStamp = $htmlDummy.find('time');
              //console.log($userID.text());
              //console.log($userMessage.text());
                    if($userID.text() == userName){
                            $('#chat-area').append($("<li class='right'><div class='message1'>"+ $userMessage.text()+"</div><div class='info'><div class='datetime'>"+$timeStamp.text()+"</div></div></li>"));
                    }
                    else{
                            $('#chat-area').append($("<li><div class='message2'>"+ $userMessage.text()+"</div><div class='info'><div class='datetime'>"+$timeStamp.text()+"</div></div></li>"));
                            audio.play();
                          }
                        }
                        document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   }

				   instanse = false;
				   state = data.state;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

//send the message
function sendChat(message, nickname, room)
{
  //console.log("send:"+room);
    updateChat(room);
     $.ajax({
		   type: "POST",
		   url: "../public/scripts/chat.php",
		   data: {
		   			'function': 'send',
            'chatroom': room,
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat(room);
		   },
		});
}
