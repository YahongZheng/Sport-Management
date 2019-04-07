<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--validation.php-->
<?php
		//only accept letter no numbers for username
		function alphabeticSpace($value) {
			$reg = "/^[A-Za-z ]+$/";
			return preg_match($reg,$value);
		}
?>