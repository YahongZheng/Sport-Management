<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Edit User Page-->
<?php
	require_once("Season.class.php");
	$season = new Season();
	
	if( isset($_POST['submit']) ){
		$id = $_POST['id'];
		$year = $_POST['year'];
		$description = $_POST['description'];
		
		$fields = array("year"=>$year, "description"=>$description, "id"=>$id);
		$string = $season->updateSeason($fields);
		echo $string;
		
		header("Location: season.php");
	}
?>

<html>
	<head>
		<title>Edit Season</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div>
			<form method="post">	
				<label>id:</label>
				<input type="number" name="id"></br></br>
				
				<label>year:</label>
				<input type="text" name="year"></br></br>
				
				<label>description:</label>
				<input type="text" name="description"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>