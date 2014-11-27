<?php 
 $pageTitle = "Search";
 require('includes/header.php');?>
 
 <div class="container">
 
 <h3>Search 4inst</h3>
 <ul class="nav nav-tabs">
  <li class="active"><a href="search.php">By Name</a></li>
  <li><a href="searchEmail.php">By Email</a></li>
</ul>
          <br/>
            <form  method="post" action="search.php?go"  id="searchform">
      <input  type="text" name="name">
     <button type="submit" name="submit" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-search"></span> Search</button>
    </form><br/>
        
          
 
<?php
  if(isset($_POST['submit'])){
  if(isset($_GET['go'])){
  if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){
  $name=$_POST['name'];
  $get_names=$mysqli->query("SELECT userID, firstname, lastname FROM Profile WHERE firstname LIKE '%".$name."%' OR lastname LIKE '%".$name."%'");
  
 while($row=mysqli_fetch_array($get_names)){
          $FirstName =$row['firstname'];
          $LastName=$row['lastname'];
          $ID=$row['userID'];
		  $get_search_username = $mysqli->query("SELECT username FROM Login WHERE userID='$ID'");
		  $search_username_row = mysqli_fetch_array($get_search_username);
 		  $search_username = $search_username_row['username'];
		  $picquery = $mysqli->query("SELECT profile_Picture FROM ProfilePicture WHERE userID='$ID'");
		$row= mysqli_fetch_array($picquery);
		$pic= $row['profile_Picture'];
  //-display the result of the array
  echo '
  <ul class="media-list">
  <li class="media" style="background-color: rgba(204,204,204,0.2);">
    <a class="pull-left" href="profile.php?u='.$search_username.'">
      <img class="media-object" style="height:64px; width:64px;" src="userdata/profile_pics/'.$pic.'" alt="">
    </a>
    <div class="media-body">
      <h4 class="media-heading" ><a class="pull-left" href="profile.php?u='.$search_username.'">'.$FirstName.' '.$LastName.'</a></h4>
    </div>
  </li>
</ul>';
  }
  }
  else{
  echo  "<p>Please enter a search query</p>";
  }
  }
  }
?>
          </div>
        <?php require('includes/footer.php');?>
    
