<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Login Page-->
<?php
	require_once("Login.class.php");
	
	if( isset($_POST['login']) ){
		$logging = new Login();
		$logging->validation();
		$logging->sanitize($_POST['username']);
		$validLogin = $logging->getLogin($_POST['username'], $_POST['password']);

		if( $validLogin ){
			header("Location: admin.php");
			exit();
		}else{
			echo "Invalid Username or Password. Try Again!";
		}
	}//submit
?>

<html>
	<head>	
		<title>Login Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div id="login-container">
			<form method="post">
				<label>Username:</label>
				<input type="text" name="username" required></br></br>
				
				<label>Password:</label>
				<input type="password" name="password" required></br></br>
				
				<input type="submit" name="login" value="Login">
				
				<label><a href="register.php">Register</a></label>
			</form>
		</div>
	</body>
</html>