<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete Player Page-->
<?php
	require_once("Players.class.php");
	$players = new Players();
	
	if( isset($_GET['id']) ){
		$id = $_GET['id'];
		$string = $players->deletePlayers($id);
		
		header("Location: players.php");
		exit();
	}
?>