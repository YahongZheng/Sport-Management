<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--League Page-->
<html>
	<head>
		<title>League Page</title>
		<link rel="stylesheet" href="css/styles.css">
	</head>
	
	<body>		
		<h1>View League Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("League.class.php");
	
	$league = new League();
	$string = $league->getAllRecordsAsTable();
	echo $string;
?>