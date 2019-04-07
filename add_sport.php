<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Add Sport Page-->
<?php
	require_once("Sport.class.php");
	$sport = new Sport();
	
	if( isset($_POST['submit']) ){
		$id = $_POST['id'];
		$name = $_POST['name'];
		
		$string = $sport->addSport($id, $name);
		
		header("Location: sport.php");
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
				<label>id:</label>
				<input type="number" name="id"></br></br>
				
				<label>name:</label>
				<input type="text" name="name"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>