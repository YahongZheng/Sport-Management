<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete Schedule Page-->
<?php
	require_once("Schedule.class.php");
	$schedule = new Schedule();
	
	if( isset($_GET['hometeam']) ){
		$hometeam = $_GET['hometeam'];
		$string = $schedule->deleteSchedule($hometeam);
		
		header("Location: schedule.php");
		exit();
	}
?>