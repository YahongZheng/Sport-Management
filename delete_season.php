<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete Season Page-->
<?php
	require_once("Season.class.php");
	$season = new Season();
	
	if( isset($_GET['id']) ){
		$id = $_GET['id'];
		$string = $season->deleteSeason($id);
		
		header("Location: season.php");
		exit();
	}
?>