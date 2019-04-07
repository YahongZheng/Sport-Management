<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Add Position Page-->
<?php
	require_once("Position.class.php");
	$position = new Position();

	
	if( isset($_POST['id']) ){
		$name = $_POST['name'];
		$id = $_POST['id'];
		
		$string = $position->addPosition($name, $id);
		
		header("Location: position.php");
		exit();
	}
?>

<html>
	<head>
		<title>Add New Position</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div>
			<form method="post">	
				<label>name:</label>
				<input type="text" name="name"></br></br>
				
				<label>id:</label>
				<input type="number" name="id"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>