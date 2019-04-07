<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Add Schedule Page-->

<?php
	require_once("Schedule.class.php");
	$schedule = new Schedule();
	
	if( isset($_POST['submit']) ){
		$sport = $_POST['sport'];
		$league = $_POST['league'];
		$season = $_POST['season'];
		$hometeam = $_POST['hometeam'];
		$awayteam = $_POST['awayteam'];
		$homescore = $_POST['homescore'];
		$awayscore = $_POST['awayscore'];
		$scheduled = $_POST['scheduled'];
		$completed = $_POST['completed'];
		
		$string = $schedule->addSchedule($sport, $league, $season, $hometeam, $awayteam, $homescore, $awayscore, $scheduled, $completed);
		
		header("Location: schedule.php");
		exit();
	}
?>

<html>
	<head>
		<title>Add New Schedule</title>
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
				
				<label>hometeam:</label>
				<input type="number" name="hometeam"></br></br>
				
				<label>awayteam:</label>
				<input type="number" name="awayteam"></br></br>
				
				<label>homescore:</label>
				<input type="number" name="homescore" value="0"></br></br>
				
				<label>awayscore:</label>
				<input type="number" name="awayscore" value="0"></br></br>
				
				<label>scheduled:</label>
				<input type="datetime-local" name="scheduled" placeholder="yyyy-mm-dd hh:mm:ss"></br></br>
				
				<label>completed:</label>
				<input type="number" name="completed" value="0"></br></br>
				
				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
	</body>
</html>