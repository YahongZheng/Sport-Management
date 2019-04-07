<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Season Page-->

<html>
	<head>
		<title>Season Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<h1>View Season Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("Season.class.php");
	
	$season = new Season();
	$string = $season->getAllRecordsAsTable();
	echo $string;
?>