<?php
$pageTitle = "Change Password";
require('includes/header.php');
include_once ('includes/changePassword.inc.php');
 
?>

        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        
<div class="container">
        <h4>Change Password</h4>

        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
        <ul class="list-unstyled">
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        
   <form class="form-horizontal" role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="password_form">
                <input type="hidden"
                             name="userID" 
                             id="userID" value="<?php echo $userID; ?>"/>

            Current password: 
                       <input type="password"
                             name="password" 
                             id="password"/><br>
            New Password: 
            <input type="password"
                             name="newpassword" 
                             id="newpassword"/><br>
                             
            Confirm password: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" />
   
            <button type="submit" class="btn btn-default"
                   onclick="return passformhash(this.form,
                   					this.form.userID,
                                   this.form.password,
                                   this.form.newpassword,
                                   this.form.confirmpwd);" />Change Password</button>
         
        </form>
        <p>Return to the <a href="settings.php">settings page</a>.</p>
   </div>

 <?php require('includes/footer.php');?>