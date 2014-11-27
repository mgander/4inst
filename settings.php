<?php
$pageTitle = "Settings";
require('includes/header.php');

?>

<div class="container">
<?php if (isset($_POST['submit'])){
	$fname = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
	$lname = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
	$about = filter_input(INPUT_POST, 'about', FILTER_SANITIZE_STRING);
	$location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
if ($userID == ''){
		$errors[]='No user defined.';
		}elseif (strlen($fname) < 1) {
             echo "Your first name is empty!";
            }else
			{
			$create_request = $mysqli->query("UPDATE Profile SET firstname='$fname', lastname='$lname', about='$about', location='$location' WHERE userID='$userID'");
			echo "Your profile has been saved.";
		}
}?>

<section>
<div class="row">
     	        

 <?php          
     $data =$mysqli->query("SELECT * FROM Profile WHERE userID='$userID'"); 
 $row1=mysqli_fetch_array($data);
 ?>
         
<form action="<?php echo 'settings.php'; ?>" method="POST">
      <div class="fullwidth left">
                <h4>First Name</h4>
                <input name="firstName" type="text" class="form-control" id="firstName" value="<?php echo $row1['firstname'];?>">
      </div>
    
        
      <div class="fullwidth left">
                <h4>Last Name</h4>
                <input name="lastName" type="text" class="form-control" id="lastName" value="<?php echo $row1['lastname'];?>">
      </div>
                
         
      <div class="fullwidth left">
     <h4>About me</h4>
                <input name="about" type="text" class="form-control" id="about" value="<?php echo $row1['about'];?>">
      </div>
      <div class="fullwidth left">
      <h4>Location</h4>
                <input name="location" type="text" class="form-control" id="location" value="<?php echo $row1['location'];?>">
      </div>


<div class="fullwidth left">
        <h4><a href="changePassword.php">Change Password</a></h4>
</div>



      <div class="fullwidth left">
                <h3>  </h3>
                <button name="submit" type="submit" id="submit" class="btn btn-lg btn-primary btn-embossed fullwidth">Save</button>    
          </div>
     
</form>    
        
          </ul>
           
       
         
      
     
       
     </div>    
<?php require('includes/footer.php');?>