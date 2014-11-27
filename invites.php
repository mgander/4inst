<?php 
$pageTitle = "Invites";
require('includes/header.php');?>
 <div class="container">
 <?
//Find Friend Requests





if ($friendRequests = $mysqli->query("SELECT * FROM Invites WHERE receiverID='$userID'")){
 $numrows = $friendRequests->num_rows;
 //$friendRequests->close();
}
if ($numrows == 0) {
 echo "You have no friend requests at this time.";
 $senderID = "";
}
else
{

 while ($row = mysqli_fetch_array($friendRequests)) {
  $id = $row['inviteID']; 
  $receiverID = $row['receiverID'];
  $senderID = $row['senderID'];
  $get_sender_info = $mysqli->query("SELECT firstname, lastname FROM Profile WHERE userID='$senderID'");
  $get_sender_info_row = mysqli_fetch_array($get_sender_info);
  $sender_fname = $get_sender_info_row['firstname'];
  $sender_lname = $get_sender_info_row['lastname'];
  $get_sender_u = $mysqli->query("SELECT username FROM Login WHERE userID='$senderID'");
  $get_sender_u_row = mysqli_fetch_array($get_sender_u);
  $sender_username = $get_sender_u_row['username'];
  echo '<a href="profile.php?u='.$sender_username.'">'.$sender_fname.' '.$sender_lname.'</a> wants to be friends'.'<br />';

?>
<?
if (isset($_POST['acceptrequest'.$senderID])) {
  //Get friend array for logged in user
  $get_friend_check = $mysqli->query("SELECT friendArray FROM profile WHERE userID='$userID'");
  $get_friend_row = mysqli_fetch_array($get_friend_check);
  $friend_array = $get_friend_row['friendArray'];
  $friendArray_explode = explode(",",$friend_array);
  $friendArray_count = count($friendArray_explode);

  //Get friend array for person who sent request
  $get_friend_check_friend = $mysqli->query("SELECT friendArray FROM profile WHERE userID='$senderID'");
  $get_friend_row_friend = mysqli_fetch_array($get_friend_check_friend);
  $friend_array_friend = $get_friend_row_friend['friendArray'];
  $friendArray_explode_friend = explode(",",$friend_array_friend);
  $friendArray_count_friend = count($friendArray_explode_friend);

  if ($friend_array == "") {
     $friendArray_count = count(NULL);
  }
  if ($friend_array_friend == "") {
     $friendArray_count_friend = count(NULL);
  }
  if ($friendArray_count == NULL) {
   $add_friend_query = $mysqli->query("UPDATE profile SET friendArray=CONCAT(friendArray,'$senderID') WHERE userID='$userID'");
  }
  if ($friendArray_count_friend == NULL) {
   $add_friend_query_2 = $mysqli->query("UPDATE profile SET friendArray=CONCAT(friendArray,'$receiverID') WHERE userID='$senderID'");
   
  }
  if ($friendArray_count >= 1) {
   $add_friend_query = $mysqli->query("UPDATE profile SET friendArray=CONCAT(friendArray,',$senderID') WHERE userID='$userID'");
  }
  if ($friendArray_count_friend >= 1) {
   $add_friend_query_2 = $mysqli->query("UPDATE profile SET friendArray=CONCAT(friendArray,',$receiverID') WHERE userID='$senderID'");
  }
  $friendActivityQuery = $mysqli->query("INSERT INTO friendActivity (user1ID, user2ID) VALUES ('$senderID','$receiverID')");
  $delete_request = $mysqli->query("DELETE FROM invites WHERE receiverID='$receiverID'&&senderID='$senderID'");
  echo "You are now friends!";
  header("Location: invites.php");

}
if (isset($_POST['ignorerequest'.$senderID])) {
$ignore_request = $mysqli->query("DELETE FROM invites WHERE receiverID='$receiverID'&&senderID='$senderID'");
  echo "Request Ignored!";
  header("Location: invites.php");
}
?>
<form action="invites.php" method="POST">
<input type="submit" name="acceptrequest<? echo $senderID; ?>" value="Accept Request">
<input type="submit" name="ignorerequest<? echo $senderID; ?>" value="Ignore Request">
</form>
<?
  }
  }
?>
 </div>
<?php require('includes/footer.php');?>