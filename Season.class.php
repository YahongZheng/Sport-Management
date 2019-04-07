<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Season Class Page-->
<?php
class Season{
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
		
		if( $stmt = $this->db->prepare("select * from server_season") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $year, $description);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('id'=>$id, 'year'=>$year,
									'description'=>$description);
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
						<th>ID</th><th>Year</th>
						<th>Description</th>
						<th>Edit Season</th><th>Delete Season</th>
						</tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['id']}</td><td>{$row['year']}</td>
								<td>{$row['description']}</td>
								<td><a href='edit_season.php?id=".$row['id']."'>Edit</a></td>
								<td><a href='delete_season.php?id=".$row['id']."'>Delete</a></td>
								</tr>\n";
			}
			
			$bigString .= "</table>\n
							<a href='add_season.php'>Add new Season</a>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addSeason($id, $year, $description){
		$query = "insert into server_season (id, year, description)
					value (?, ?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("iss", $id, $year, $description);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//addSeason
	
	function deleteSeason($id){
		$query = "delete from server_season where id = ?";
		
		$numRows = 0;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->affected_rows;
		}
		
		return $numRows;
	}//deleteSeason
	
	function updateSeason($field){
        $queryString = "update server_season set ";
        $insertId = 0;
        $numRows = 0;
        $items = array();
        $types = "";

        foreach($field as $k=>$v){
            switch($k){
                case "year" :
                    $queryString .= "year = ?,";
                    $items[] = &$field[$k];
                    $types .= "s";
                    break;
                case "description" :
                    $queryString .= "description = ?,";
                    $items[] = &$field[$k];
                    $types .= "s";
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
    }//updateSeason
}//class
?>