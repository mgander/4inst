<?php 
$pageTitle = "News Feed";
require('includes/header.php');
$my_friends=$mysqli->query("SELECT friendArray FROM profile WHERE userID=$userID");
$myfriends=mysqli_fetch_row($my_friends);
$myfriends=implode("",$myfriends);

$my_friends_array=explode(",",$myfriends);
//echo $my_friends_array;
?>

<link href="css/4Inst.css" rel="stylesheet">    
<div class="container">
<h3>News Feed</h3>
<div class="SetCenterImage"> 
<?php 
$query_image = $mysqli->query("SELECT * FROM PhotoUpload WHERE circleShared='' ORDER BY datestamp DESC");

while($query_image_row=mysqli_fetch_array($query_image)){
	$photoUserID = $query_image_row['userID'];
	$photoTime=$query_image_row['datestamp'];
	
	if(in_array($photoUserID,$my_friends_array)){
		$photoURL = $query_image_row['photo'];
		$photoID = $query_image_row['photoID'];
		//get photo uploader name
		$getuserNames = $mysqli->query("SELECT firstname, lastname FROM Profile WHERE userID=$photoUserID");
		$getuserNamesrow = mysqli_fetch_array($getuserNames);
		$photoUserFname = $getuserNamesrow['firstname'];
		$photoUserLname = $getuserNamesrow['lastname'];
		echo '<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
  			<div class="panel-body">
				<a href="photoInfo.php?photoid='.$photoID.'"class="thumbnail">
		    		<img src="'.$photoURL.'">
				</a>
			</div>
			 <div class="panel-footer">	
		<h4>'.$photoUserFname.' '.$photoUserLname.' <small>on '.$photoTime.'</small></h4>
			</div>
		</div>
		</div>';
	}
	else
	{
		
	}


}
	
?>
</div>
</div>



<?php require('includes/footer.php');?>