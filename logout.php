<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Logout Page-->

<?php
	session_start();
	
	if( session_destroy() ){
		header("Location: index.php");
	}
?>

<html>
	<head>
		<title>Lagout Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<div class="top_nav">
			<a href="admin.php">Admin</a>
			<a href="team.php">Team</a>
			<a href="schedule.php">Schedule</a>
			<a class="current" href="logout.php">Logout</a>
		</div>
	</body>
</html>