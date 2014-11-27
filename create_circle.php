<?php 
$pageTitle = "Create a Circle";
require('includes/header.php');

$editFormAction = $_SERVER['PHP_SELF'];
$my_friends=$mysqli->query("SELECT friendArray FROM profile WHERE userID=$userID");
$myfriends=mysqli_fetch_row($my_friends);
$myfriends=implode("",$myfriends);

$my_friends_array=explode(",",$myfriends);

?>

<div class="container">
<h4>Create a Circle</h4>
<p><a href="circles.php"><b class="glyphicon glyphicon-chevron-left"></b> Back to Your Circles</a></p>

<form class="form-horizontal" id="circle" method="post" action="create_circle.php" >
<h4>Circle Name</h4>
<input name="circle_name" type="text" id="" placeholder="">
<h4>People you want to invite</h4>
<?php 
foreach($my_friends_array as $id){
	$get_user_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$id'");
	$get_name=mysqli_fetch_array($get_user_name);
	
	$user_friend[0]=$get_name['firstname'] ;
	$user_friend[1]=$get_name['lastname'] ;
	
	
	echo '<input type="checkbox" value='.$id.' name="list[]"><tr> '.$user_friend[0].' '.$user_friend[1].' </tr></p>';
	}
	
	


?>

<button class="btn btn-default" type="submit" value="invite" name="invite">Invite</button>
</form>


<?php
if(isset($_POST['invite'])){
		if(isset($_POST['list'])){
				 $list=$_POST['list'];
					 $list=implode(",",$list);
					// echo $list;
					 $id_into=implode(",",$_POST['list']);
					 $id_into1=$id_into.','.$userID;
					 
					 foreach($_POST['list'] as $id){
						 $name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$id'");
						 $name=mysqli_fetch_array($name);
						 
						$circlename=$_POST["circle_name"];
						
						 
						 
						 

						 
						 
						 
						 }
						
						$insert=$mysqli->query("INSERT INTO circles (circleName,circleUserArray,circleCreator) VALUES ( '$circlename','$id_into1','$userID')"); 
						 echo 'Your circle has been created!';					
					 };
		}
?>
</div>
<?php require('includes/footer.php');?>
