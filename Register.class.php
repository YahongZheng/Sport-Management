<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Register Class Page-->
<?php
class Register{
	private $db;

    function __construct(){
        $this->db = new mysqli($_SERVER['DB_SERVER'], $_SERVER['DB_USER'],
                            $_SERVER['DB_PASSWORD'], $_SERVER['DB']);
        if($this->db->connect_error){
            //normally don't want to display connection error as is
            echo "Connection Failure: ".mysqli_conect_error();
            die();
        }
    }//construct
	
	function getRegister($username, $role, $password, $team, $league){
		$query = "insert into server_user (username, role, password, team, league)
					value (?, ?, ?, ?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("sisii", $username, $role, $password, $team, $league);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//getRegister
}//class
?>