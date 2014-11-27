<?php
$pageTitle = "Photo Upload PHP";
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();


 
 
$user = $_SESSION["username"];
$userID = $_SESSION["user_id"];
	$circleID = $_POST['circleID'];
	$content = $_POST["Commentaaa"]; 
	$uploaddir = "Upload Test/$userID/";
	$type=array("jpg","jpeg","png");
	mkdir("Upload Test/$userID");

	
	function fileext($filename)
	{
	return substr(strrchr($filename, '.'), 1);
	}
	//get the type of the file
	
	function random($length)
	{
		$hash = 'CR-';
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
		$max = strlen($chars) - 1;
		mt_srand((double)microtime() * 1000000);
		for($i = 0; $i < $length; $i++)
		{
		$hash .= $chars[mt_rand(0, $max)];
		}
	return $hash;
	}
	//Random a file name
	
	$a=strtolower(fileext($_FILES['File']['name']));
	//Judge the file type
	if(!in_array(strtolower(fileext($_FILES['File']['name'])),$type))
	{
		$text=implode(",",$type);
		echo "This file can not be uploaded";
	}
	//Give the file name
	else
	{
		$filename=explode(".",$_FILES['File']['name']);
	
		do
		{
			$filename[0]=random(10);
			$name=implode(".",$filename);
			$uploadfile=$uploaddir.$name;
		}
		while(file_exists($uploadfile));

		if (move_uploaded_file($_FILES['File']['tmp_name'],$uploadfile))
		{
			if(is_uploaded_file($_FILES['File']['tmp_name']))
			{
				echo "Upload failed";
			}
			else
			{
				echo "Successfully";
			}
		}
	}
	
		$myquery="insert into PhotoUpload (photoID, userID, photo, comment, circleShared) VALUES('','$userID','$uploadfile','$content','$circleID')";
		
		if ($insert_stmt = $mysqli->prepare($myquery)) {
			
            if (! $insert_stmt->execute()) {
				
                header('Location: ../error.php?err=Upload failure: INSERT');
            }
        }
        header('Location: circles.php');
	
?>
	