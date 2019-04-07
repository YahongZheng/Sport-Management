<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Edit Team Page-->

<?php
	require_once("Team.class.php");
	$team = new Team();
	
	if( isset($_POST['submit']) ){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$mascot = $_POST['mascot'];
		$sport = $_POST['sport'];
		$league = $_POST['league'];
		$season = $_POST['season'];
		$picture = $_POST['picture'];
		$homecolor = $_POST['homecolor'];
		$awaycolor = $_POST['awaycolor'];
		$maxplayers = $_POST['maxplayers'];
		
		$fields = array("name"=>$name, "mascot"=>$mascot, 
						"sport"=>$sport, "league"=>$league, 
						"season"=>$season, "picture"=>$picture, 
						"homecolor"=>$homecolor, "awaycolor"=>$awaycolor, 
						"maxplayers"=>$maxplayers, "id"=>$id);
		
		$string = $team->updateTeam($fields);
		echo $string;
		
		header("Location: team.php");
		exit();
	}
?>

<html>
	<head>
		<title>Edit Team</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div>
			<form method="post">	
				<label>id:</label>
				<input type="number" name="id"></br></br>
				
				<label>name:</label>
				<input type="text" name="name"></br></br>
				
				<label>mascot:</label>
				<input type="text" name="mascot" value=""></br></br>
				
				<label>sport:</label>
				<input type="number" name="sport"></br></br>
				
				<label>league:</label>
				<input type="number" name="league"></br></br>
				
				<label>season:</label>
				<input type="number" name="season"></br></br>
				
				<label>picture:</label>
				<input type="text" name="picture" value=""></br></br>
				
				<label>homecolor:</label>
				<input type="text" name="homecolor" value="white"></br></br>
				
				<label>awaycolor:</label>
				<input type="text" name="awaycolor"></br></br>
				
				<label>maxplayers:</label>
				<input type="number" name="maxplayers" value="15"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>