<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Add User Page-->
<?php
	require_once("User.class.php");
	$user = new User();

	
	if( isset($_POST['submit']) ){
		$username = $_POST['username'];
		$role = $_POST['role'];
		$password = $_POST['password'];
		$team = $_POST['team'];
		$league = $_POST['league'];
		
		$string = $user->addUser($username, $role, $password, $team, $league);
		
		header("Location: user.php");
		exit();
	}
?>

<html>
	<head>
		<title>Add New User</title>
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
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>