<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Delete SLS Page-->
<?php
	require_once("SLS.class.php");
	$sls = new SLS();
	
	if( isset($_GET['sport']) ){
		$username = $_GET['sport'];
		$string = $sls->deleteSLS($sport);
		
		header("Location: sls.php");
		exit();
	}
?>