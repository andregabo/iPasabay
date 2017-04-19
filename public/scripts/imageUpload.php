<?php

    $dbcon = mysqli_connect("localhost", "root", "") or die("SERVER IS NOT AVAILABLE~".mysql_error());
		mysqli_select_db($dbcon,"harambetadays") or die ("no data".mysql_error());

	$uniqueID = uniqid();

$filename = $_FILES['image']['name'];
//save to server
    if($filename != ""){
	 if(!file_exists("../uploads/profile/" .$uniqueID. $filename)){
 			 move_uploaded_file($_FILES["image"]["tmp_name"],"../uploads/profile/" .$uniqueID. $filename);
	 }

	 $filename = "" . $uniqueID. $filename;
    }
    else{
        $filename = "";//default profilepic
    }

  $sql = "UPDATE `harambetadays`.`users` SET profile_image='".$filename."' WHERE studentID='".$_POST['studentID']."'";

    echo $sql;

//do query
    $result = mysqli_query($dbcon,$sql);
    header('Location: ../profile');

?>
