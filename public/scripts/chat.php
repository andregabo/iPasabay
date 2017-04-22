<?php
date_default_timezone_set('Asia/Manila');

    $function = $_POST['function'];
    $room = $_POST['chatroom'];

    $log = array();

    switch($function) {

    	 case('getState'):
        	 if(file_exists('chatrooms/'.$room.'.txt')){
               $lines = file('chatrooms/'.$room.'.txt');
        	 }
             $log['state'] = count($lines);
        	 break;

    	 case('update'):
        	$state = $_POST['state'];
        	if(file_exists('chatrooms/'.$room.'.txt')){
        	   $lines = file('chatrooms/'.$room.'.txt');
        	 }
        	 $count =  count($lines);
        	 if($state == $count){
        		 $log['state'] = $state;
        		 $log['text'] = false;

        		 }
        		 else{
        			 $text= array();
        			 $log['state'] = $state + count($lines) - $state;
        			 foreach ($lines as $line_num => $line)
                       {
        				   if($line_num >= $state){
                         $text[] =  $line = str_replace("\n", "", $line);
        				   }

                        }
        			 $log['text'] = $text;
        		 }

             break;

    	 case('send'):
		  $nickname = htmlentities(strip_tags($_POST['nickname']));
			 $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			  $message = htmlentities(strip_tags($_POST['message']));
		 if(($message) != "\n"){

			 if(preg_match($reg_exUrl, $message, $url)) {
       			$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
				}

          $time = date("g.ia",time());
        	 fwrite(fopen('chatrooms/'.$room.'.txt', 'a'), "<message><sender>". $nickname . "</sender><body>" . $message = str_replace("\n", " ", $message) ."</body><time>".$time."</time></message>"."\n");
		 }
        	 break;

    }

    echo json_encode($log);

?>
