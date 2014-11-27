<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register</title>
<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
 <!-- Fixed navbar -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><b class="glyphicon glyphicon-camera"></b>  4Inst</a>
        </div>
        <div class="navbar-collapse collapse">
          
        </div>
      </div>
    </div>
    <!-- body -->
    <div class="container">
    
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <div class="jumbotron">
        	<div>
  				<h1>Register Successful!</h1>
			</div>
			<div>
  				<p>You can now go back to the <a href="index.php">login page</a> and log in</p>
  			</div>
        
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>

  		</div>
    <?php require('includes/footer.php');?>  