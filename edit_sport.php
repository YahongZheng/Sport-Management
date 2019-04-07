<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Edit Sport Page-->

<?php
	require_once("Sport.class.php");
	$sport = new Sport();
	
	if( isset($_POST['submit']) ){
		$id = $_POST['id'];
		$name = $_POST['name'];
		
		$fields = array("name"=>$name, "id"=>$id);
		$string = $sport->updateSport($fields);
		echo $string;
		
		header("Location: sport.php");
	}
?>

<html>
	<head>
		<title>Edit Sport</title>
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