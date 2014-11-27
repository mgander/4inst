<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';
 
$error_msg = "";
 
if (isset($_POST['userID'], $_POST['op'], $_POST['p'])) {
    
 	 	$password = $_POST['op']; // The hashed password.
		$userID = $_POST['userID'];
	
	if (checkPass($userID, $password, $mysqli) == true)
	
    $newpassword = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
 
    if (empty($error_msg)) {
        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Create salted password 
        $newpassword = hash('sha512', $newpassword . $random_salt);
 
        // Insert the new user into the database 
        $insert_stmt = $mysqli->query("UPDATE Login SET password='$newpassword', salt='$random_salt' WHERE userID='$userID'");
		
echo 'Password changed!';
header('Location: settings.php');
		
		
    }
}