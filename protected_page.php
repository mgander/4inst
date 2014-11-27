<?php 
 $pageTitle = "Page TEST";
 require('includes/header.php');?>
        <div class="container template">
            <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <p>
                This is an example protected page.  To access this page, users
                must be logged in.  At some stage, we'll also check the role of
                the user, so pages will be able to determine the type of user
                authorised to access the page.
            </p>
            <p>Click here to <a href="includes/logout.php">LOGOUT!</a></p>
            <p>Click here to <a href="uploadPhoto.php">UPLOAD PHOTO!</a></p>
            </div>
        <?php require('includes/footer.php');?>
    