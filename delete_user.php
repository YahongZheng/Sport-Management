<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete User Page-->
<?php
	require_once("User.class.php");
	$user = new User();
	
	if( isset($_GET['username']) ){
		$username = $_GET['username'];
		$string = $user->deleteUser($username);
		
		header("Location: user.php");
		exit();
	}
?>