<?php
$pageTitle = "Outbox";
require('includes/header.php');

$getmsg=$mysqli->query("SELECT * FROM Messages WHERE senderID=$userID ORDER BY msg_date DESC");

?>
<div class="container">
<h4>Direct Messages</h4>

<ul class="nav nav-tabs">
  <li><a href="inbox.php">Inbox</a></li>
  <li class="active"><a href="">Sent Messages</a></li>
</ul>

<form action=" . " method="post">

<table class="table">
  <tr >
    <th scope="col">To</th>
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
	$user_to_ID=$get_msg['receiverID'];
	$date=$get_msg['msg_date'];
	$read=$get_msg['opened'];
	$get_user_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$user_to_ID'");
	$get_name=mysqli_fetch_array($get_user_name);
	$user_to=array();
	$user_to[0]=$get_name['firstname'] ;
	$user_to[1]=$get_name['lastname'] ;
	
	$get_user_to_username = $mysqli->query("SELECT username FROM Login WHERE userID='$user_to_ID'");
	$user_to_username_row = mysqli_fetch_array($get_user_to_username);
 	$user_to_username = $user_to_username_row['username'];
	
	if( strlen($msg_content)>16){
	$msg_content=substr($msg_content, 0, 16 )."...";}
	else{ 
	
	}
	  echo '<tr>
    <td><a href="profile.php?u='.$user_to_username.'">'.$user_to[0].' '.$user_to[1].'</a></td>
    <td><a href="message.php?id='.$id.'">'.$msg_content.'</a></td>
    <td>'.$date.'</td>
	<td><a href="sendmsg.php?id='.$user_to_ID.'">reply</a></td>
</tr>';
}


?>

  </tr>
  

</table>

</form>
</div>

 <?php require('includes/footer.php');?>