<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete Team Page-->
<?php
	require_once("Team.class.php");
	$team = new Team();
	
	if( isset($_GET['id']) ){
		$id = $_GET['id'];
		$string = $team->deleteTeam($id);
		
		header("Location: team.php");
		exit();
	}
?>