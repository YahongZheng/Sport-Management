<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete League Page-->
<?php
	require_once("League.class.php");
	$league = new League();
	
	if( isset($_GET['id']) ){
		$id = $_GET['id'];
		$string = $league->deleteLeague($id);
		
		header("Location: league.php");
		exit();
	}
?>