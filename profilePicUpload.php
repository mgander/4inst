<?php 
 $pageTitle = "Profile Picture Upload";
 require('includes/header.php');
$profileInfo = $mysqli->query("SELECT firstname, lastname FROM Profile WHERE userID='$userID'");
		$getProfileInfo = mysqli_fetch_array($profileInfo);
		$firstname = $getProfileInfo['firstname'];
		$lastname = $getProfileInfo['lastname'];
$picquery = $mysqli->query("SELECT profile_Picture FROM ProfilePicture WHERE userID=$userID");
$row= $picquery->fetch_object();?>

	<script src="js/Profile_Pic_Func.js"></script>
    
<div class="container template">
            <p>Upload profile picture for <? echo $firstname.' '.$lastname;?>'s page!</p>
<br />
<form  enctype="multipart/form-data" method="post" action=""><img src="userdata/profile_pics/<?php echo $row->profile_Picture;?>" id="preview" height="150px" width="150px" alt="" /><input class="btn-default" type="file" name="profilepic" id="File" onchange="fileSelected();"/><input class="btn-default" name="uploadpic" type="submit" value="Upload"  /></form>


<?php
//profile upload script
 if(isset($_FILES['profilepic']))
 {
	 if(((@$_FILES["profilepic"]["type"]=="image/jpeg")||(@$_FILES["profilepic"]["type"]=="image/png")||(@$_FILES["profilepic"]["type"]=="image/gif"))&&(@$_FILES["profilepic"]["size"]<2097152))
	 
	 {
		 $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		 $rand_dir_name=substr(str_shuffle($chars), 0, 15);
		 mkdir("userdata/profile_pics/$rand_dir_name");
		 
		 if (file_exists("userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"]))
		 {
			 echo @$_FILES["profilepic"]["name"]."Already exists";
		 }
		 else{
			 move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
			 
			 $profile_pic_name=@$_FILES["profilepic"]["name"];
			 $query = "UPDATE ProfilePicture SET profile_Picture='$rand_dir_name/$profile_pic_name' WHERE userID='$userID'";
			 $stmt = $mysqli->prepare($query);
			 $stmt -> execute();
			echo "Profile Picture Updated!";
		 }
	 }
	 
	 else 
	 {
		 echo "Invalid File";
	 }
 }
?>
<?php
echo '<a href="/profile.php?u='.$user.'">Return to profile page.</a>';
?>


</div>
<?php require('includes/footer.php');?>  