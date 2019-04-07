<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Team Page-->

<html>
	<head>
		<title>Team Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<nav>
			<a href="admin.php">Admin</a> |
			<a class="current" href="team.php">Team</a> |
			<a href="schedule.php">Schedule</a> |
			<a href="logout.php">Logout</a>
		</nav>
		
		<h1>View Team Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("Team.class.php");

	$team = new Team();
	$string = $team->getAllRecordsAsTable();
	echo $string;
?>