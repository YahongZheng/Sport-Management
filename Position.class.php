<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Position Class Page-->
<?php
class Position{
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
		
		if( $stmt = $this->db->prepare("select * from server_position") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($name, $id);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('name'=>$name, 'id'=>$id);
				}//while
			}//if num_rows
		}//if stmt
		return $data;
	}//getAllRecords
	
	function getAllRecordsAsTable(){
		$data = $this->getAllRecords();
		
		if( count($data) > 0 ){
			$bigString = "<table border='1'\n
						<tr><th>Name</th><th>ID</th></tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['name']}</td><td>{$row['id']}</td></tr>\n";
			}
			
			$bigString .= "</table>\n
							<a href='add_position.php'>Add new Position</a>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addPosition($name, $id){
		$query = "insert into server_position (name, id)
					value (?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("si", $name, $id);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//addPosition
}//class
?>