<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--User Class Page-->
<?php
class User{
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
	
	function getAllRecords(){
		$data = array();
		
		if( $stmt = $this->db->prepare("select * from server_user") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($username, $role, $password, $team, $league);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('username'=>$username, 'role'=>$role,
									'password'=>$password, 'team'=>$team,
									'league'=>$league);
				}//while
			}//if num_rows
		}//if stmt
		return $data;
	}//getAllRecords
	
	function getAllRecordsAsTable(){
		$data = $this->getAllRecords();
		
		if( count($data) > 0 ){
			$bigString = "<table border='1'\n
						<tr>
						<th>Username</th><th>Role</th>
						<th>Password</th><th>team</th>
						<th>League</th>
						<th>Edit User</th><th>Delete User</th>
						</tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['username']}</td><td>{$row['role']}</td>
								<td>{$row['password']}</td><td>{$row['team']}</td>
								<td>{$row['league']}</td>
								<td><a href='edit_user.php?username=".$row['username']."'>Edit</a></td>
								<td><a href='delete_user.php?username=".$row['username']."'>Delete</a></td>
								</tr>\n";
			}
			
			$bigString .= "</table>\n
							<a href='add_user.php'>Add new User</a>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addUser($username, $role, $password, $team, $league){
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
	}//addUser
	
	function deleteUser($username){
		$query = "delete from server_user where username = ?";
		
		$numRows = 0;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->affected_rows;
		}
		
		return $numRows;
	}//deleteUser
	
	function updateUser($field){
        $queryString = "update server_user set ";
        $insertString = "";
        $numRows = 0;
        $items = array();
        $types = "";

        foreach($field as $k=>$v){
            switch($k){
                case "role" :
                    $queryString .= "role = ?,";
                    $items[] = &$field[$k];
                    $types .= "i";
                    break;
                case "password" :
                    $queryString .= "password = ?,";
                    $items[] = &$field[$k];
                    $types .= "s";
                    break;
                case "team" :
                    $queryString .= "team = ?,";
                    $items[] = &$field[$k];
                    $types .= "i";
                    break;
				case "league" :
                    $queryString .= "league = ?,";
                    $items[] = &$field[$k];
                    $types .= "i";
                    break;
                case "username" :
                    $insertString = strval($v);
                    break; 
            }//switch
        }//foreach

        $queryString = trim($queryString, ",");
        $queryString .= " where username = ?";
        $types .= "s";
        $items[] = &$insertString;

        if($stmt = $this->db->prepare($queryString)){
            $refArr = array_merge(array($types), $items);
            $ref = new ReflectionClass("mysqli_stmt");
            $method = $ref->getMethod("bind_param");
            $method->invokeArgs($stmt, $refArr);

            $stmt->execute();
            $stmt->store_result();
            $stmt = $stmt->affected_rows;
        }

        return $numRows;
    }//updateUser
}//class
?>