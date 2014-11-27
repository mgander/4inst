<?php 
$pageTitle = "Friends";

require('includes/header.php');
if (isset($_GET['id'])) {
	$profileID = $mysqli->real_escape_string($_GET['id']);
$my_friends=$mysqli->query("SELECT friendArray FROM profile WHERE userID=$profileID");
$myfriends=mysqli_fetch_row($my_friends);
$myfriends=implode("",$myfriends);
if ($myfriends != "") {
$my_friends_array=explode(",",$myfriends);
$friends_number=count($my_friends_array);
}else{
$friends_number=0;	
}
$name=$mysqli->query("SELECT firstname, lastname FROM profile WHERE userID=$profileID");
$getname = mysqli_fetch_array($name);
$firstname = $getname['firstname'];
$lastname = $getname['lastname'];
}
?>
<div class="container">
<h3><?php echo $firstname.' '.$lastname.'\'s Friends' ?></h3>

<?php 
echo "<hl>$firstname has $friends_number friends.</hl></p>";
echo '<table class="table">';

	foreach($my_friends_array as $id){
		$foto_=$mysqli->query("SELECT profile_Picture FROM profilepicture WHERE userID='$id'"); 
		$foto=$foto_->fetch_object();
		$username=$mysqli->query("SELECT username FROM login WHERE userID='$id'");
		$get_username_row=mysqli_fetch_array($username);
		$user_name=$get_username_row['username'];
		
		$get_user_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$id'");
	$get_name=mysqli_fetch_array($get_user_name);
	
	$user_friend[0]=$get_name['firstname'] ;
	$user_friend[1]=$get_name['lastname'] ;
		
		
		
		echo 
		
		'<td><a style="margin-right:10px;" href="profile.php?u='.$user_name.'"><img  src="userdata/profile_pics/'.$foto->profile_Picture.'" width="64px" height="64px"></a>  <a href="profile.php?u='.$user_name.'">'.$user_friend[0].' '.$user_friend[1].'</a></td>';
		}
	echo "</table>";
?>
</div>

<?php require('includes/footer.php');?>