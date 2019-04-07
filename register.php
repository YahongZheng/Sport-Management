<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Register Page-->
<?php
	require_once("Register.class.php");
	$reg = new Register();
	
	if( isset($_POST['register']) ){
		$username = $_POST['username'];
		$role = $_POST['role'];
		$password = $_POST['password'];
		$team = $_POST['team'];
		$league = $_POST['league'];
		
		$string = $reg->getRegister($username, $role, $password, $team, $league);
		
		echo "Registration successfully";
		echo "</br></br>";
		echo "<a href='index.php'>Go To Login</a>";
	}
?>

<html>
	<head>	
		<title>Register Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div>
			<form method="post">	
				<label>username:</label>
				<input type="text" name="username"></br></br>
				
				<label>role:</label>
				<input type="number" name="role"></br></br>
				
				<label>password:</label>
				<input type="text" name="password"></br></br>
				
				<label>team:</label>
				<input type="number" name="team"></br></br>
				
				<label>league:</label>
				<input type="number" name="league"></br></br>
				
				<input type="submit" name="register" value="Register">
			</form>
		</div>
	</body>
</html>