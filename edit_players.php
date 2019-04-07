<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Edit Player Page-->
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
		
		$fields = array("firstname"=>$firstname, "lastname"=>$lastname, 
						"dateofbirth"=>$dateofbirth, "jerseynumber"=>$jerseynumber, 
						"team"=>$team, "id"=>$id);
		$string = $players->updatePlayers($fields);
		echo $string;
		
		header("Location: players.php");
	}
?>

<html>
	<head>
		<title>Edit League Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<form method="post">	
			<label>id:</label>
			<input type="number" name="id"></br></br>
				
			<label>first name:</label>
			<input type="text" name="firstname"></br></br>
			
			<label>last name:</label>
			<input type="text" name="lastname"></br></br>
			
			<label>date of birth:</label>
			<input type="date" name="dateofbirth"></br></br>
			
			<label>jersey number:</label>
			<input type="text" name="jerseynumber"></br></br>
			
			<label>team:</label>
			<input type="number" name="team"></br></br>
				
			<input type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>