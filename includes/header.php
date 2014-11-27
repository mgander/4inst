<?php
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
          <a class="navbar-brand" href="home.php"><b class="glyphicon glyphicon-camera"></b>  4Inst</b></a>
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
                <li><a href="friend_list.php?id=<?php echo $userID; ?>">Friends</a></li>
                <li><a href="inbox.php">Direct Messages</a></li>
                <li><a href="invites.php">Invites</a></li>
                <li><a href="circles.php">Circles</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li class="divider"></li>
                <li><a href="includes/logout.php">Log Out</a></li>
              </ul>
            </li>
          </ul>
          </ul>
         
        </div>
      </div>
    </div>
    </div>

