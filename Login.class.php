<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Login Class Page-->
<?php
class Login{

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
	
	function getLogin($username, $password){		
		if( $stmt = $this->db->prepare("select username from server_user where username = ? and password = ?") ){
			$stmt->bind_param("ss", $_POST['username'], $_POST['password']);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($username);
			
			if( $stmt->num_rows === 1 ){
				$_SESSION['username'] = $username;
				return true;

			}//if num_rows
			
			return false;
		}//if stmt
	}//getLogin

	//sanitize data
	function sanitize($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	//validation data
	function validation(){
		include("validation.php");
		if(isset($_POST['username'])){
			$vali_username = $_POST['username'];
			alphabeticSpace($vali_username);
		}
	}
}//class
?>