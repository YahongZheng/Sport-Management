<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Add SLS Page-->
<?php
	require_once("SLS.class.php");
	$sls = new SLS();

	
	if( isset($_POST['submit']) ){
		$sport = $_POST['sport'];
		$league = $_POST['league'];
		$season = $_POST['season'];
		
		$string = $sls->addSLS($sport, $league, $season);
		
		header("Location: sls.php");
		exit();
	}
?>

<html>
	<head>
		<title>Add New Sport/League/Season</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div>
			<form method="post">	
				<label>sport:</label>
				<input type="number" name="sport"></br></br>
				
				<label>league:</label>
				<input type="number" name="league"></br></br>
				
				<label>season:</label>
				<input type="number" name="season"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>