<?php 
$pageTitle = "Friend Activity";
require('includes/header.php');



$getFriendArray=$mysqli->query("SELECT friendArray FROM profile WHERE userID=$userID");
$friendArray_row = mysqli_fetch_array($getFriendArray);
$friendArray = $friendArray_row['friendArray'];
//echo $friendArray;
$friendArrayPHP = array($friendArray);
//echo $friendArrayPHP;
$getactivityID=$mysqli->query("SELECT user1ID,user2ID FROM friendactivity");

?>
<div class="container">
<h4>Friend Activity</h4>

<table class="table">
<?php
$foundRows=array();
foreach($friendArrayPHP as $id){

$getName=$mysqli->query("SELECT * FROM friendActivity WHERE user1ID ='$id' OR user2ID='$id' ORDER BY msg_date DESC");
while($row=mysqli_fetch_assoc($getName)){
//array_push($foundRows,$row);	
$user1ID=$row['user1ID'];
$user2ID=$row['user2ID'];

$get_user_name1=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$user1ID'");
$get_user_name2=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$user2ID'");
$get_username1=$mysqli->query("SELECT username FROM login WHERE userID='$user1ID' ");
$get_username2=$mysqli->query("SELECT username FROM login WHERE userID='$user2ID'");
$get_username1_row=mysqli_fetch_array($get_username1);
$get_username2_row=mysqli_fetch_array($get_username2);
//try to get the username of friends which could link to friends' profile page
$get_username1=$get_username1_row['username'];
$get_username2=$get_username2_row['username'];
$activityid = $row['activityID'];
$time_=$mysqli->query("SELECT msg_date FROM friendactivity Where activityID='$activityid'");
$time=mysqli_fetch_array($time_);
$get_user_name1=mysqli_fetch_array($get_user_name1);
$get_user_name2=mysqli_fetch_array($get_user_name2);




echo '<tr>
<td><span class="glyphicon glyphicon-plus"></span>    
<a href="profile.php?u='.$get_username1.'"> '.$get_user_name1[0].' '.$get_user_name1[1].' '.

 '</a>is now friends with'.' '.

'<a href="profile.php?u='.$get_username2.'">'. $get_user_name2[0].' '.$get_user_name2[1].'</a>                                            </td>

<td><small>'.$time[0].'</small></td>
</tr>

                ';

$activityid = $row['activityID'];

}
}

?>
</table>
</div>








<?php require('includes/footer.php');?>