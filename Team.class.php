<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Team Class Page-->
<?php
class Team{
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
		
		if( $stmt = $this->db->prepare("select * from server_team") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name, $mascot, $sport, $league, $season, $picture, $homecolor, $awaycolor, $maxplayers);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('id'=>$id, 'name'=>$name,
									'mascot'=>$mascot, 'sport'=>$sport,
									'league'=>$league, 'season'=>$season,
									'picture'=>$picture, 'homecolor'=>$homecolor,
									'awaycolor'=>$awaycolor, 'maxplayers'=>$maxplayers);
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
						<th>ID</th><th>Name</th>
						<th>Mascot</th><th>Sport</th>
						<th>League</th><th>Season</th>
						<th>Picture</th><th>Homecolor</th>
						<th>Awaycolor</th><th>Max Players</th>
						<th>Edit Team</th><th>Delete Team</th>
						</tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['id']}</td><td>{$row['name']}</td>
								<td>{$row['mascot']}</td><td>{$row['sport']}</td>
								<td>{$row['league']}</td><td>{$row['season']}</td>
								<td>{$row['picture']}</td><td>{$row['homecolor']}</td>
								<td>{$row['awaycolor']}</td><td>{$row['maxplayers']}</td>
								<td><a href='edit_team.php?id=".$row['id']."'>Edit</a></td>
								<td><a href='delete_team.php?id=".$row['id']."'>Delete</a></td>
								</tr>\n";
			}
			
			$bigString .= "</table>\n
							<a href='add_team.php'>Add new team</a>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addTeam($id, $name, $mascot, $sport, $league, $season, $picture, $homecolor, $awaycolor, $maxplayers){
		$query = "insert into server_team (id, name, mascot, sport, league, season, picture, homecolor, awaycolor, maxplayers)
					value (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("issiiissss", $id, $name, $mascot, $sport, $league, $season, $picture, $homecolor, $awaycolor, $maxplayers);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//addTeam
	
	function deleteTeam($id){
		$query = "delete from server_team where id = ?";
		
		$numRows = 0;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->affected_rows;
		}
		
		return $numRows;
	}//deleteTeam
	
	function updateTeam($field){
		$query = "update server_team set ";
		$insertId = 0;	
		$numRows = 0;
		$items = array();
		$types = "";
		
		foreach( $field as $k=>$v ){
			switch($k){
				case "name":
					$query .= "name = ?,";
					$items[] = &$field[$k];
					$types .= "s";
					break;
				case "mascot":
					$query .= "mascot = ?,";
					$items[] = &$field[$k];
					$types .= "s";
					break;
				case "sport":
					$query .= "sport = ?,";
					$items[] = &$field[$k];
					$types .= "i";
					break;
				case "league":
					$query .= "league = ?,";
					$items[] = &$field[$k];
					$types .= "i";
					break;
				case "season":
					$query .= "season = ?,";
					$items[] = &$field[$k];
					$types .= "i";
					break;
				case "picture":
					$query .= "picture = ?,";
					$items[] = &$field[$k];
					$types .= "s";
					break;
				case "homecolor":
					$query .= "homecolor = ?,";
					$items[] = &$field[$k];
					$types .= "s";
					break;
				case "awaycolor":
					$query .= "awaycolor = ?,";
					$items[] = &$field[$k];
					$types .= "s";
					break;
				case "maxplayers":
					$query .= "maxplayers = ?,";
					$items[] = &$field[$k];
					$types .= "s";
					break;
				case "id":
					$insertId = intval($v);
					break;
			}//switch
		}//foreach
		
		$query = trim($query, ",");
		$query .= " where id = ?";
		$types .= "i";
		$items[] = $insertId;
		
		if( $stmt = $this->db->prepare($query) ){
			$refArr = array_merge(array($types), $items);
			$ref = new ReflectionClass("mysqli_stmt");
			$method = $ref->getMethod("bind_param");
			$method->invokeArgs($stmt, $refArr);
			
			$stmt->execute();
			$stmt->store_result();
			$stmt = $stmt->affected_rows;
		}
		
		return $numRows;
	}//updateTeam
}//class
?>