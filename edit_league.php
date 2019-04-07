<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Edit League Page-->
<?php
	require_once("League.class.php");
	$league = new League();
	
	if( isset($_POST['submit']) ){
		$id = $_POST['id'];
		$name = $_POST['name'];
		
		$fields = array("name"=>$name, "id"=>$id);
		$string = $league->updateLeague($fields);
		echo $string;
		
		header("Location: league.php");
	}
?>

<html>
	<head>
		<title>Edit League</title>
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