<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Position Page-->

<html>
	<head>
		<title>Position Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<h1>View Position Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("Position.class.php");
	
	$position = new Position();
	$string = $position->getAllRecordsAsTable();
	echo $string;
?>