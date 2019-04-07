<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Add League Page-->
<?php
	require_once("League.class.php");
	$league = new League();
	
	if( isset($_POST['submit']) ){
		$id = $_POST['id'];
		$name = $_POST['name'];
		
		$string = $league->addLeague($id, $name);
		
		header("Location: league.php");
		exit();
	}
?>

<html>
	<head>
		<title>Add New League</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div>
			<form method="post">	
				<label>id:</label>
				<input type="number" name="id"></br></br>
				
				<label>name:</label>
				<input type="text" name="name"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>