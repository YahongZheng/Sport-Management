<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Add User Page-->
<?php
	require_once("Players.class.php");
	$players = new Players();

	
	if( isset($_POST['submit']) ){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$dateofbirth = $_POST['dateofbirth'];
		$jerseynumber = $_POST['jerseynumber'];
		$team = $_POST['team'];
		
		$string = $players->addPlayers($id, $firstname, $lastname, $dateofbirth, $jerseynumber, $team);
		
		header("Location: players.php");
		exit();
	}
?>

<html>
	<head>
		<title>Add New Player</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div>
			<form method="post">	
				<label>id:</label>
				<input type="number" name="id"></br></br>
				
				<label>firstname:</label>
				<input type="text" name="firstname"></br></br>
				
				<label>lastname:</label>
				<input type="text" name="lastname"></br></br>
				
				<label>dateofbirth:</label>
				<input type="date" name="dateofbirth"></br></br>
				
				<label>jerseynumber:</label>
				<input type="text" name="jerseynumber"></br></br>
				
				<label>team:</label>
				<input type="number" name="team"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>