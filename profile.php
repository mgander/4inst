<?php 
 $pageTitle = "Profile";
 require('includes/header.php');

//checkProfile 
if (isset($_GET['u'])) {
	$profileUsername = $mysqli->real_escape_string($_GET['u']);

	if (ctype_alnum($profileUsername)) {
 	//check user exists
	$check = $mysqli->query("SELECT username, userID FROM Login WHERE username='$profileUsername'");
	$numrows = $check->num_rows;
		if ($numrows == 1) {
		$get = mysqli_fetch_array($check);
		$profileUsername = $get['username'];
		$profileID = $get['userID'];
		$profileInfo = $mysqli->query("SELECT firstname, lastname, about, location FROM Profile WHERE userID='$profileID'");
		$getProfileInfo = mysqli_fetch_array($profileInfo);
		$firstname = $getProfileInfo['firstname'];
		$lastname = $getProfileInfo['lastname'];
		$about = $getProfileInfo['about'];
		$location = $getProfileInfo['location'];
		$picquery = $mysqli->query("SELECT profile_Picture FROM ProfilePicture WHERE userID=$profileID");
		$row= $picquery->fetch_object();
		//$query_image = "SELECT * FROM PhotoUpload WHERE userID=$profileID AND circleShared IS NULL ORDER BY datestamp DESC";
		$result=$mysqli->query("SELECT * FROM PhotoUpload WHERE userID='$profileID'&&circleShared='' ORDER BY datestamp DESC");
		$my_friends=$mysqli->query("SELECT friendArray FROM profile WHERE userID=$profileID");
		$myfriends=mysqli_fetch_row($my_friends);
		$myfriends=implode("",$myfriends);
		if ($myfriends != "") {
		$my_friends_array=explode(",",$myfriends);
		$friends_number=count($my_friends_array);
		}else{
		$friends_number=0;	
		}

		while($photoUpload = $result->fetch_array(MYSQLI_ASSOC))
		{
		$rows[] = $photoUpload;
		}
		}
		else
		{
		exit();
		}
	}else
		{
		exit();
		}
}else
		{
		header('Location: index.php');
		}
		
		//Adding Friend
if (isset($_POST['addfriend'])) {
     $friend_request = $_POST['addfriend'];
     
     $senderID = $userID;
     $receiverID = $profileID;
     
     if ($receiverID == $userID) {
      $errorMsg = "You can't send a friend request to yourself!<br />";
     }
     else
     {
      $create_request = $mysqli->query("INSERT INTO invites VALUES ('','$senderID','$receiverID')");
      $errorMsg = "Your friend Request has been sent!";
     }

  }
  
  //Remove Friend
if (isset($_POST['removefriend'])) {
  //Friend array for logged in user
  $add_friend_check = $mysqli->query("SELECT friendArray FROM Profile WHERE userID='$userID'");
  $get_friend_row = mysqli_fetch_array($add_friend_check);
  $friend_array = $get_friend_row['friendArray'];
  $friend_array_explode = explode(",",$friend_array);
  $friend_array_count = count($friend_array_explode);
  
  //Friend array for user who owns profile
  $add_friend_check_username = $mysqli->query("SELECT friendArray FROM Profile WHERE userID='$profileID'");
  $get_friend_row_username = mysqli_fetch_array($add_friend_check_username);
  $friend_array_username = $get_friend_row_username['friendArray'];
  $friend_array_explode_username = explode(",",$friend_array_username);
  $friend_array_count_username = count($friend_array_explode_username);
  
  $usernameComma = ",".$profileID;
  $usernameComma2 = $profileID.",";
  
  $userComma = ",".$userID;
  $userComma2 = $userID.",";
  
  if (strstr($friend_array,$usernameComma)) {
   $friend1 = str_replace("$usernameComma","",$friend_array);
  }
  elseif (strstr($friend_array,$usernameComma2)) {
   $friend1 = str_replace("$usernameComma2","",$friend_array);
  }
  elseif (strstr($friend_array,$profileID)) {
   $friend1 = str_replace("$profileID","",$friend_array);
  }
  //Remove logged in user from other persons array
  if (strstr($friend_array_username,$userComma)) {
   $friend2 = str_replace("$userComma","",$friend_array_username);
  }
  elseif (strstr($friend_array_username,$userComma2)) {
   $friend2 = str_replace("$userComma2","",$friend_array_username);
  }
  elseif (strstr($friend_array_username,$userID)) {
   $friend2 = str_replace("$userID","",$friend_array_username);
  }


  $removeFriendQuery = $mysqli->query("UPDATE Profile SET friendArray='$friend1' WHERE userID='$userID'");
  $removeFriendQuery_profile = $mysqli->query("UPDATE Profile SET friendArray='$friend2' WHERE userID='$profileID'");
  echo "Friend Removed ...";
  header("Location: $profileUsername");
}


	?>
    
    
 <link href="css/profilestyle.css" rel="stylesheet">    
<div class="container">
<div class="thumbnail">
<div class="media">
<div id="profilepiccontainer" class="pull-left" style="overflow:hidden; height:150px; width:150px;">
	
    
    <img src="userdata/profile_pics/<?php echo $row->profile_Picture;?>" height="150px" style="display: block; margin-left: auto; margin-right: auto; margin: 0 auto;" alt=""/>
	
  </div>
  <div class="media-body">
    <h2 class="media-heading"><? echo $firstname.' '.$lastname;?></h2>
    <span class="glyphicon glyphicon-user"></span> <a href="friend_list.php?id=<?php echo $profileID; ?>"> <?php echo $friends_number;?></a><br />
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $about;?> <br />
    <span class="glyphicon glyphicon-map-marker"></span> <?php echo $location;?>.
  </div>
  <div class="btn-group">     
            
<?php
if ($userID == $profileID){
echo '<form action="/profilePicUpload.php"><button type="submit" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-camera"></span> Change Profile Picture</button></form>';
}
?>
<form action="<? echo $profileUsername; ?>" method="POST">
<?php
//Add Button
$friendsArray = "";
$countFriends = "";
//$friendsArray12 = "";
$addAsFriend = "";
$selectFriendsQuery = $mysqli->query("SELECT friendArray FROM Profile WHERE userID='$profileID'");
$friendRow = mysqli_fetch_array($selectFriendsQuery);
$friendArray = $friendRow['friendArray'];
$friendRequested = $mysqli->query("SELECT * FROM invites WHERE receiverID='$profileID'&&senderID='$userID'");
$requests = $friendRequested->num_rows;
$friendRequested2 = $mysqli->query("SELECT * FROM Invites WHERE receiverID='$userID'&&senderID='$profileID'");
$requests2 = $friendRequested2->num_rows;

if ($userID != $profileID){
if ($friendArray != "") {
   $friendArray = explode(",",$friendArray);
   $countFriends = count($friendArray);
   
if (in_array($userID,$friendArray)) {
 $addAsFriend = '<button type="submit" class="btn btn-danger btn-xs" name="removefriend" value="Remove Friend"><span class="glyphicon glyphicon-remove"></span> Remove Friend</button>';
  echo $addAsFriend;
}
elseif($requests == 1){
$addAsFriend = '<button type="submit" class="btn btn-success btn-xs" name="friendrequested" value="Friend Requested"><span class="glyphicon glyphicon-ok"></span> Friend Request Sent</button>';
echo $addAsFriend;
}
elseif($requests2 == 1){
$addAsFriend = '</form><form method="get" action="/invites.php"><button type="submit" class="btn btn-success btn-xs" name="respondrequest" value="Respond to friend request"><span class="glyphicon glyphicon-share-alt"></span> Respond to Friend Request</button></form>';
echo $addAsFriend;
}
else
{
 $addAsFriend = '<button type="submit" class="btn btn-primary btn-xs" name="addfriend" value="Add Friend"><span class="glyphicon glyphicon-ok"></span> Add Friend</button>';
 echo $addAsFriend;
}


}//friendArrayempty

elseif($requests == 1){
$addAsFriend = '<button type="submit" class="btn btn-success btn-xs" name="friendrequested" value="Friend Requested"><span class="glyphicon glyphicon-ok"></span> Friend Request Sent</button>';
echo $addAsFriend;
}
elseif($requests2 == 1){
$addAsFriend = '</form><form method="get" action="/invites.php"><button type="submit" class="btn btn-success btn-xs" name="respondrequest" value="Respond to friend request"><span class="glyphicon glyphicon-share-alt"></span> Respond to Friend Request</button></form>';
echo $addAsFriend;
}
else
{
 $addAsFriend = '<button type="submit" class="btn btn-primary btn-xs" name="addfriend" value="Add Friend"><span class="glyphicon glyphicon-ok"></span> Add Friend</button>';
 echo $addAsFriend;
}


}//user not profile
?>

<?php echo $errorMsg; ?>
</form>
<?php
if($userID != $profileID){
	$messageButton = '<form action="/sendmsg.php"><button type="submit" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-envelope"></span> Send Message</button><input type="hidden" name="id" value="'.$profileID.'"/></form>';
	echo $messageButton;
}
?>
</div>
</div>
</div>
     
            
<h3>Photos</h3>
<?php if (in_array($userID,$friendArray)||$profileID==$userID): ?>

<div class="row">

  
		<?php if ($rows): ?>
		<?php $counter = 1 ?>
		
		<?php foreach ($rows as $photoUpload): ?>
        <div class="col-xs-6 col-md-3">
		    <a href="PhotoInfo.php?photoid=<?php echo $photoUpload['photoID']?>" class="thumbnail">
		    <img src="<?php echo $photoUpload['photo']?>">
		    </a>
            </div>
		<?php endforeach ?>
		
		<?php endif?>
	</div>
    
    <?php  else: ?>
	You may not view this person's photos.
<?php  endif ?>
</div>
            

        <?php require('includes/footer.php');?>  