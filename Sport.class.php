<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Sport Class Page-->
<?php
class Sport{
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
		
		if( $stmt = $this->db->prepare("select * from server_sport") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $name);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('id'=>$id, 'name'=>$name);
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
						<th>Edit Sport</th><th>Delete Sport</th>
						</tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['id']}</td><td>{$row['name']}</td>
								<td><a href='edit_sport.php?id=".$row['id']."'>Edit</a></td>
								<td><a href='delete_sport.php?id=".$row['id']."'>Delete</a></td>
								</tr>\n";
			}
			
			$bigString .= "</table>\n
							<a href='add_sport.php'>Add new Sport</a>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addSport($id, $name){
		$query = "insert into server_sport (id, name)
					value (?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("is", $id, $name);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//addSport
	
	function deleteSport($id){
		$query = "delete from server_sport where id = ?";
		
		$numRows = 0;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->affected_rows;
		}
		
		return $numRows;
	}//deleteSport
	
	function updateSport($field){
        $queryString = "update server_sport set ";
        $insertId = 0;
        $numRows = 0;
        $items = array();
        $types = "";

        foreach($field as $k=>$v){
            switch($k){
                case "name" :
                    $queryString .= "name = ?,";
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
    }//updateSport
}//class
?>