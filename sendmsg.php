<?php 
require('includes/header.php');

if (isset($_GET['id'])) {
	$user_to_ID = $mysqli->real_escape_string($_GET['id']);
	$get_user_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$user_to_ID'");
	$get_name=mysqli_fetch_array($get_user_name);
	$user_to=array();
	$user_to[0]=$get_name['firstname'] ;
	$user_to[1]=$get_name['lastname'] ;
}
 	
?>
<div class="container">
<h4><a href="inbox.php"><b class="glyphicon glyphicon-chevron-left"></b> Back to Messages</a></h4>
<?php if (isset($_POST['msg_content'])){
	
	$msg_text = filter_input(INPUT_POST, 'msg_content', FILTER_SANITIZE_STRING);
if ($user_to_ID == ''){
		$errors[]='No receipient defined.';
		}elseif (strlen($msg_text) < 1) {
             echo "Your message is empty!";
            }else
			{
			$senderID = $userID;
			$receiverID = $user_to_ID;
			$create_request = $mysqli->query("INSERT INTO Messages (senderID, receiverID, msg_text) VALUES ('$senderID','$receiverID','$msg_text')");
			echo "Your message has been sent";
		}
}?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Message to <?php echo $user_to[0].' '.$user_to[1];?></h3></div>
 <div class="panel-body">   
<h4>Your Message</h4>
<form method="POST" action="<?php echo 'sendmsg.php?id='.$user_to_ID; ?>">
<textarea name="msg_content" cols="60" rows="10" id="msg_content"></textarea>
<button class="btn btn-primary btn-sm" type="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Send</button>
</form>
  </div>
</div>
</div>
 <?php require('includes/footer.php');?>