<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Players Class Page-->
<?php
class Players{
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
		
		if( $stmt = $this->db->prepare("select * from server_player") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $firstname, $lastname, $dateofbirth, $jerseynumber, $team);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('id'=>$id, 'firstname'=>$firstname,
									'lastname'=>$lastname, 'dateofbirth'=>$dateofbirth,
									'jerseynumber'=>$jerseynumber, 'team'=>$team);
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
						<th>ID</th><th>First Name</th>
						<th>Last Name</th><th>Date Of Birth</th>
						<th>Jersey Number</th><th>Team</th>
						<th>Edit Players</th><th>Delete Players</th>
						</tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['id']}</td><td>{$row['firstname']}</td>
								<td>{$row['lastname']}</td><td>{$row['dateofbirth']}</td>
								<td>{$row['jerseynumber']}</td><td>{$row['team']}</td>
								<td><a href='edit_players.php?id=".$row['id']."'>Edit</a></td>
								<td><a href='delete_players.php?id=".$row['id']."'>Delete</a></td>
								</tr>\n";
			}
			
			$bigString .= "</table>\n
							<a href='add_players.php'>Add new Player</a>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addPlayers($id, $firstname, $lastname, $dateofbirth, $jerseynumber, $team){
		$query = "insert into server_player (id, firstname, lastname, dateofbirth, jerseynumber, team)
					value (?, ?, ?, ?, ?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("issssi", $id, $firstname, $lastname, $dateofbirth, $jerseynumber, $team);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//addPlayers
	
	function deletePlayers($id){
		$query = "delete from server_player where id = ?";
		
		$numRows = 0;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->affected_rows;
		}
		
		return $numRows;
	}//deletePlayers
	
	function updatePlayers($field){
        $queryString = "update server_player set ";
        $insertId = 0;
        $numRows = 0;
        $items = array();
        $types = "";

        foreach($field as $k=>$v){
            switch($k){
                case "firstname" :
                    $queryString .= "firstname = ?,";
                    $items[] = &$field[$k];
                    $types .= "s";
                    break;
                case "lastname" :
                    $queryString .= "lastname = ?,";
                    $items[] = &$field[$k];
                    $types .= "s";
                    break;
                case "dateofbirth" :
                    $queryString .= "dateofbirth = ?,";
                    $items[] = &$field[$k];
                    $types .= "s";
                    break;
				case "jerseynumber" :
                    $queryString .= "jerseynumber = ?,";
                    $items[] = &$field[$k];
                    $types .= "s";
                    break;
				case "tea," :
                    $queryString .= "team = ?,";
                    $items[] = &$field[$k];
                    $types .= "i";
                    break;
                case "id" :
                    $insertId = intval($v);
                    break;
            }//switch
        }//foreach

        $queryString = trim($queryString, ",");
        $queryString .= " where id = ?";
        $types .= "i";
        $items[] = &$insertId;

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
    }//updatePlayers
}//class
?>