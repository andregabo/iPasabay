/*
Created by: Kenrick Beckett

Name: Chat Engine
*/

var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getStateChat = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat(room){
  console.log("state:"+room);
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
			   },
			});
	}
}

//Updates the chat
function updateChat(){
  console.log("update:"+room);
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
                            $('#chat-area').append($("<li>"+ data.text[i] +"</li>"));
                        }
				   }
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
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
  console.log("send:"+room);
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
