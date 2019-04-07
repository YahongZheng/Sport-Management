<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete Sport Page-->
<?php
	require_once("Sport.class.php");
	$sport = new Sport();
	
	if( isset($_GET['id']) ){
		$id = $_GET['id'];
		$string = $sport->deleteSport($id);
		
		header("Location: sport.php");
		exit();
	}
?>