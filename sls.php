<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--SLS Page-->

<html>
	<head>
		<title>Sport/League/Season Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<h1>View Sport/League/Season Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("SLS.class.php");
	
	$sls = new SLS();
	$string = $sls->getAllRecordsAsTable();
	echo $string;
?>