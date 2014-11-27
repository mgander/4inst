<?php
$pageTitle = "Inbox";
require('includes/header.php');

$getmsg=$mysqli->query("SELECT * FROM Messages WHERE receiverID=$userID ORDER BY msg_date DESC");

?>

<div class="container">
<h4>Direct Messages</h4>
<ul class="nav nav-tabs">
  <li class="active"><a href="">Inbox</a></li>
  <li><a href="outbox.php">Sent Messages</a></li>
</ul>

<form action=" . " method="post">

<table class="table">
  <tr >
    <th scope="col">From</th>
    <th scope="col">Message</th>
    <th scope="col">date</th>
<th scope="col"></th>
  </tr>
  <?php
  $user_from='';
  $msg_content='';
  $date='';
    while ($get_msg=mysqli_fetch_array($getmsg)){
	$id=$get_msg['msgID'];
	$user_from_ID=$get_msg['senderID'];
	$msg_content=$get_msg['msg_text'];
	$user_to=$get_msg['receiverID'];
	$date=$get_msg['msg_date'];
	$read=$get_msg['opened'];
	$get_user_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$user_from_ID'");
	$get_name=mysqli_fetch_array($get_user_name);
	$user_from=array();
	$user_from[0]=$get_name['firstname'] ;
	$user_from[1]=$get_name['lastname'] ;
	
	$get_user_from_username = $mysqli->query("SELECT username FROM Login WHERE userID='$user_from_ID'");
	$user_from_username_row = mysqli_fetch_array($get_user_from_username);
 	$user_from_username = $user_from_username_row['username'];
	
	if( strlen($msg_content)>10){
		$msg_content=substr($msg_content, 0, 10 )."...";
		
		
		
		}
		else 
		$msg_content=$msg_content;
	  echo '<tr>
    <td><a href="profile.php?u='.$user_from_username.'">'.$user_from[0].' '.$user_from[1].'</a></td>
    <td><a href="message.php?id='.$id.'">'.$msg_content.'</a></td>
    <td>'.$date.'</td>
	<td><a href="sendmsg.php?id='.$user_from_ID.'">Reply</a></td>
</tr>'
;
	
		//echo "$user_from" .  $msg_content. "$date" ."<hr />";
}
$_SESSION['user_to']=$user_from_ID;

?>

  </tr>
  

</table>

</form>
</div>
 <?php require('includes/footer.php');?>