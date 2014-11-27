<?php 
 $pageTitle = "Message";
 require('includes/header.php');
 
 if (isset($_GET['id'])) {
	$msgID = $mysqli->real_escape_string($_GET['id']);
	$getmsg=$mysqli->query("SELECT * FROM Messages WHERE msgID='$msgID'");
	$get_msg_row=mysqli_fetch_array($getmsg);
	$user_from_ID=$get_msg_row['senderID'];
	$user_to_ID=$get_msg_row['receiverID'];
	$msg_content=$get_msg_row['msg_text'];
	$date=$get_msg_row['msg_date'];
	$get_user_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$user_from_ID'");
	$get_name=mysqli_fetch_array($get_user_name);
	$user_from=array();
	$user_from[0]=$get_name['firstname'] ;
	$user_from[1]=$get_name['lastname'] ;
	$get_user_from_username = $mysqli->query("SELECT username FROM Login WHERE userID='$user_from_ID'");
	$user_from_username_row = mysqli_fetch_array($get_user_from_username);
 	$user_from_username = $user_from_username_row['username'];
	
	$get_user_to_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$user_to_ID'");
	$get_to_name=mysqli_fetch_array($get_user_to_name);
	$user_to=array();
	$user_to[0]=$get_to_name['firstname'] ;
	$user_to[1]=$get_to_name['lastname'] ;
	$get_user_to_username = $mysqli->query("SELECT username FROM Login WHERE userID='$user_to_ID'");
	$user_to_username_row = mysqli_fetch_array($get_user_to_username);
 	$user_to_username = $user_to_username_row['username'];
 }
 
 ?>
        <div class="container">
        <h3><a href="inbox.php"><b class="glyphicon glyphicon-chevron-left"></b> Back to Messages</a></h3>
        <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo '<a href="profile.php?u='.$user_from_username.'">'; echo $user_from[0].' '.$user_from[1].'</a>'; 
	echo ' to ';
	echo '<a href="profile.php?u='.$user_to_username.'">';
	 echo $user_to[0].' '.$user_to[1].'</a>';
	 echo ' on '.$date;?></h3>
  </div>
  <div class="panel-body">
    <?php echo $msg_content;?>
  </div>
</div>
            <p><?php 
			if($user_from_ID == $userID){
				echo '<a href="sendmsg.php?id='.$user_to_ID.'">Reply</a>';
			}else{
			echo '<a href="sendmsg.php?id='.$user_from_ID.'">Reply</a>';
			} ?></p>
            </div>
        <?php require('includes/footer.php');?>
    