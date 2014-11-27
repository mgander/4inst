<?php 
 require('includes/header.php');
 $photo_id= $_GET['photoid'];
if(isset($_POST['submit']))
    {
        $comment=$_POST["photo_comment"];
        $myqueryComment="INSERT into Comments(photoID,userID,commentText) VALUES('$photo_id','$userID','$comment')";
        $mysqli->query($myqueryComment);
    }
	
if (isset($_POST['buttonLike'])){
 	
        $myqueryLike=$mysqli->query("INSERT INTO Likes (photoID,userID) VALUES ('$photo_id','$userID')");
        ($myqueryLike);
    
    }

if (isset($_POST['buttonUnlike'])){
 	
        $myqueryLike=$mysqli->query("DELETE FROM Likes WHERE photoID ='$photo_id'&&userID='$userID'");
        
    
    }
	
if (isset($_POST['deleteButton'])){
  
        
        $deleteComments="DELETE FROM Comments WHERE photoID= $photo_id ";
        $mysqli->query($deleteComments);

        $deleteLikes="DELETE FROM Likes WHERE photoID=$photo_id";
        $mysqli->query($deleteLikes);

        $deletePhoto="DELETE FROM PhotoUpload WHERE photoID=$photo_id";
        $mysqli->query($deletePhoto);
        
        }

	
//get user name
$getuserID = $mysqli->query("SELECT userID, datestamp FROM PhotoUpload WHERE photoID=$photo_id");
$getuserIDrow = mysqli_fetch_array($getuserID);
$photoUser = $getuserIDrow['userID'];
$datestamp = $getuserIDrow['datestamp'];
$getuserNames = $mysqli->query("SELECT firstname, lastname FROM Profile WHERE userID=$photoUser");
$getuserNamesrow = mysqli_fetch_array($getuserNames);
$photoUserFname = $getuserNamesrow['firstname'];
$photoUserLname = $getuserNamesrow['lastname'];
$getuserU = $mysqli->query("SELECT username FROM Login WHERE userID=$photoUser");
$getuserUrow = mysqli_fetch_array($getuserU);
$photoUserU = $getuserUrow['username'];


//get photoID and comment to display specific photo

$GetPicPath = $mysqli->query("SELECT photo FROM PhotoUpload WHERE photoID=$photo_id");
$row11= $GetPicPath->fetch_object();
$GetPicComment = $mysqli->query("SELECT comment FROM PhotoUpload WHERE photoID=$photo_id");
$piccomment= $GetPicComment->fetch_object();

//select how many likes this photo got
$photo_likes=$mysqli->query("SELECT count(*) likeID FROM  Likes WHERE  photoID =$photo_id");
$rowlikes=$photo_likes->fetch_object();

//friendArray
$selectFriendsQuery = $mysqli->query("SELECT friendArray FROM Profile WHERE userID=$photoUser");
$friendRow = mysqli_fetch_array($selectFriendsQuery);
$friendArray = $friendRow['friendArray'];
$friendArray = explode(",",$friendArray);

//get comments
$query_comments = "SELECT * FROM Comments WHERE photoID=$photo_id ORDER BY commentStamp DESC";
$result11=$mysqli->query($query_comments);

//select how many likes this photo got
$photo_likes=$mysqli->query("SELECT * FROM Likes WHERE photoID ='$photo_id'");
$totalLikes=$photo_likes->num_rows;

//check if user has liked photo
$userLikes=$mysqli->query("SELECT * FROM Likes WHERE photoID ='$photo_id'&&userID='$userID'");
$userLikesCheck=$userLikes->num_rows;

while($row111 = $result11->fetch_array(MYSQLI_ASSOC))
{
$rows11[] = $row111;
}
 ?>


<link href="css/4Inst.css"rel="stylesheet" type="text/css"/>


<div class="container">
<?php if (in_array($userID,$friendArray)||$photoUser==$userID): ?>

 <div class="SetCenterImage">  
 <div class="col-md-6 col-md-offset-3">
    <a class="thumbnail" >
      <img src="<?php echo $row11->photo;?>">
      </a>
      </div>
      <hr class="featurette-divider">
      <div class="col-md-6 col-md-offset-3">
      <p><?php echo $piccomment->comment;?> <br /> <?php echo '<a href="profile.php?u='.$photoUserU.'">'.$photoUserFname.' '.$photoUserLname.'</a> <small>on '.$datestamp.'</small>';?></p>
      </div>
</div>
<div class="container-fluid">
  <div class="row">
  
  <?php
  
  $url = 'PhotoInfo.php?photoid='.$photo_id;
  
  if($userLikesCheck==0){
	
	$likebutton='<form method="post" action="'.$url.'">
	<button type="submit" class="btn btn-primary" name="buttonLike">
    	<span class="badge">'.$totalLikes.'</span>
    	<span class="glyphicon glyphicon-heart"></span></button></form>';
    		

}

elseif($userLikesCheck==1){
$likebutton='<form method="post" action="'.$url.'">
	<button type="submit" class="btn btn-danger" name="buttonUnlike">
    	<span class="badge">'.$totalLikes.'</span>
    	<span class="glyphicon glyphicon-heart"></span></button></form>';
    		

}

  echo $likebutton;
  
  if($userID==$photoUser){
	  $deletebutton='<form method="post" action="'.$url.'">
	<button type="submit" class="btn btn-danger" name="deleteButton" value="Delete Photo">
    	<span class="glyphicon glyphicon-remove"></span></button></form>';
	  
  }
  
  echo $deletebutton;
   ?>
  


       <form id="upload_comment" enctype="multipart/form-data" method="post" action="">
	
	<div class="input-group">
      <input type="text" class="form-control" name="photo_comment" placeholder="Write a comment...">
      <span class="input-group-btn">
        <input class="btn btn-default" name="submit" type="submit" value="Send">
      </span>
    </div>
	
</form>
</div>
</div>
		<?php if ($rows11): ?>
				<?php foreach ($rows11 as $row111): ?>

		    
		    	<?php  
		    	$user_id=$row111['userID'];
				$query_username= $mysqli->query("SELECT username FROM Login WHERE userID=$user_id"); 
		    	$result111=$query_username->fetch_object();
		    	$query_name= $mysqli->query("SELECT firstname, lastname FROM Profile WHERE userID=$user_id"); 
				$query_name_row=mysqli_fetch_array($query_name);
		    	$firstname = $query_name_row['firstname'];
				$lastname = $query_name_row['lastname'];
		    	?>
               
		    	<dl class="dl-horizontal">
		     		<dt><?php echo '<a href="profile.php?u='.$result111->username.'">'.$firstname.' '.$lastname.'</a>';?><footer><small><?php echo $row111['commentStamp']?></small></footer></dt>
		     		<dd><?php echo $row111['commentText']?></dd>
                </dl>
               
		    
		<?php endforeach ?>
		

		<?php endif?>

		
		<?php if (empty($rows11)): ?>

		<?php  endif ?>


	<?php  else: ?>
	You may not view this photo.
<?php  endif ?>


  
</div>

<?php

  
    
	
	require('includes/footer.php');
?>
