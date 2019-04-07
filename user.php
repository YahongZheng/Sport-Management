<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--User Page-->

<html>
	<head>
		<title>User Page</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	
	<body>
		<h1>View User Records</h1></br>
		<p><a href="admin.php">Back To Admin Page</a></p>
	</body>
</html>

<?php
	require_once("User.class.php");
	
	$user = new User();
	$string = $user->getAllRecordsAsTable();
	echo $string;
?>