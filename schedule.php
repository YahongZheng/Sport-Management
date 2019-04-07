<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Schedule Page-->

<html>
	<head>
		<title>Schedule Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<nav>
			<a href="admin.php">Admin</a> |
			<a href="team.php">Team</a> |
			<a class="current" href="schedule.php">Schedule</a> |
			<a href="logout.php">Logout</a>
		</nav>
		
		<h1>View Game Schedule Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("Schedule.class.php");
	
	$schedule = new Schedule();
	$string = $schedule->getAllRecordsAsTable();
	echo $string;
?>