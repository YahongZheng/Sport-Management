<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Sport Page-->

<html>
	<head>
		<title>Sport Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>		
		<h1>View Sport Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("Sport.class.php");
	
	$sport = new Sport();
	$string = $sport->getAllRecordsAsTable();
	echo $string;
?>