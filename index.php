<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>4inst</title>
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
          <ul class="nav navbar-nav navbar-right">
          <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
          </ul>
        </div>
      </div>
    </div>
   

<div class="jumbotron">
<div class="container">
  <h1>Welcome to 4inst!</h1>
  <p>The photo sharing network for all your needs.</p>
  </div>
</div>
    
     <?php require('includes/footer.php');?>