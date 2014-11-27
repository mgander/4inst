<?php 
 $pageTitle = "Circles";
 require('includes/header.php');
 
	
	

 ?>
 
 <div class="container">
 
 <h3>Your Circles</h3> <form action="/create_circle.php"><button type="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-pencil"></span> Create a Circle</button></form>
 
 <table class="table">
 <tr >
    <th scope="col">Name</th>
    <th scope="col">Creator</th>
    </tr>
 <?php
 
 $getCircle = $mysqli->query("SELECT * FROM Circles");
 
	while($getCircleRow = mysqli_fetch_array($getCircle)){
		
		$circleUserArray = $getCircleRow['circleUserArray'];
	
	if ($circleUserArray != "") {
		
   		$circleUserArray = explode(",",$circleUserArray);
   
	if (in_array($userID,$circleUserArray)){
		$circleID = $getCircleRow['circleID'];
		$circleName = $getCircleRow['circleName'];
		$circleCreator = $getCircleRow['circleCreator'];
		
		$username=$mysqli->query("SELECT username FROM login WHERE userID='$circleCreator'");
		$get_username_row=mysqli_fetch_array($username);
		
		$user_name=$get_username_row['username'];
		
		$get_user_name=$mysqli->query("SELECT firstname,lastname FROM profile WHERE userID='$circleCreator'");
		$get_name=mysqli_fetch_array($get_user_name);
	
		$user_friend[0]=$get_name['firstname'] ;
		$user_friend[1]=$get_name['lastname'] ;
		
		echo '<tr><td><span class="glyphicon glyphicon-flag"></span><a href="viewCircle.php?id='.$circleID.'">  '.$circleName.'</a></td>
		<td><small><a href="profile.php?u='.$user_name.'">'.$user_friend[0].' '.$user_friend[1].'</a></small></td>
</tr>';
		
		}
	else
	{
		
		}
	}
	}
 ?>
</table>
 </div>
 
 <?php require('includes/footer.php');?>