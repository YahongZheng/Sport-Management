<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Player Page-->

<html>
	<head>
		<title>Players Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<h1>View Players Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("Players.class.php");
	
	$players = new Players();
	$string = $players->getAllRecordsAsTable();
	echo $string;
?>