<?php
$pageTitle = "Circles";
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();

if ((!login_check($mysqli) == true)) {
	header('Location: login.php');
}
else {
$user = $_SESSION["username"];
$userID = $_SESSION["user_id"];
}

if (isset($_GET['id'])) {
	$circleID = $mysqli->real_escape_string($_GET['id']);
	$getCircle = $mysqli->query("SELECT circleName, circleCreator, circleUserArray FROM Circles WHERE circleID='$circleID'");
	$getCircleRow = mysqli_fetch_array($getCircle);
	$circleName = $getCircleRow['circleName'];
	$circleCreator = $getCircleRow['circleCreator'];
	$circleUserArray = $getCircleRow['circleUserArray'];
	$query_image = "SELECT * FROM PhotoUpload WHERE circleShared=$circleID ORDER BY datestamp DESC";
	$result=$mysqli->query($query_image);
	while($photoUpload = $result->fetch_array(MYSQLI_ASSOC))
		{
		$rows[] = $photoUpload;
		}
		
	
	if ($circleUserArray != "") {
		
   		$circleUserArray = explode(",",$circleUserArray);
	
 }
 }
 if (in_array($userID,$circleUserArray)){
		
	
		}
	else
	{
		header('Location: circles.php');
		}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $pageTitle;?></title>
<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
 <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><b class="glyphicon glyphicon-camera"></b>  4Inst</b></a>
        </div>
        <div class="navbar-collapse collapse">
        
          <ul class="nav navbar-nav navbar-right">
          
          
            <li><a href="home.php"><b class="glyphicon glyphicon-th-list"></b> News Feed</a></li>
            <li><a href="friend_activity.php"><b class="glyphicon glyphicon-eye-open"></b> Activity</a></li>
            <li><a href="uploadPhoto.php"><b class="glyphicon glyphicon-open"></b> Upload</a></li>
            <li><a href="search.php"><b class="glyphicon glyphicon-search"></b> Search</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b class="glyphicon glyphicon-user"></b> <?php echo htmlentities($_SESSION['username']); ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php?u=<?php echo htmlentities($_SESSION['username']);?>">Profile</a></li>
                <li><a href="friend_list.php">Friends</a></li>
                <li><a href="inbox.php">Direct Messages</a></li>
                <li><a href="invites.php">Invites</a></li>
                <li><a href="circles.php">Circles</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="includes/logout.php">Log Out</a></li>
              </ul>
            </li>
          </ul>
          </ul>
         
        </div>
      </div>
    </div>
    </div>
 
 <div class="container">
 <p><a href="circles.php"><b class="glyphicon glyphicon-chevron-left"></b> Back to Your Circles</a></p>
	
    <h3><?php echo $circleName;?></h3><form action="/circle_picture_upload.php"><button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-camera"></span> Upload Photo to Circle</button><input type="hidden" name="id" value="<?php echo $circleID;?>"/></form>
 
 <h3>Photos</h3>
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
 
 </div>
 
 <?php require('includes/footer.php');?>