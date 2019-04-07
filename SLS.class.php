<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--SLS Class Page-->
<?php
class SLS{
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
		
		if( $stmt = $this->db->prepare("select * from server_slseason") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($sport, $league, $season);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('sport'=>$sport, 'league'=>$league,
									'season'=>$season);
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
						<th>Sport</th><th>League</th>
						<th>Season</th>
						</tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['sport']}</td><td>{$row['league']}</td>
								<td>{$row['season']}</td>
								</tr>\n";
			}
			
			$bigString .= "</table>\n
							<h1>Add new Sport/League/Season Steps:</h1>\n
							<p>Step 1: <a href='add_sport.php'>Add New Sport</a></p>
							<p>Step 2: <a href='add_league.php'>Add New League</a></p>
							<p>Step 3: <a href='add_season.php'>Add New Season</a></p>
							<h1>To Delete Sport/League/Season Steps:</h1>\n
							<p>Step 1: <a href='sport.php'>Delete the Sport from Sport Page</a></p>
							<p>Step 2: <a href='league.php'>Delete the League from League Page</a></p>
							<p>Step 3: <a href='season.php'>Delete the Season from Season Page</a></p>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addSLS($sport, $league,$season){
		$query = "insert into server_slseason (sport, league, season)
					value (?, ?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("iii", $sport, $league, $season);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//addSLS
	
	function deleteSLS($sport){
		$query = "delete from server_slseason where sport = ?";
		
		$numRows = 0;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("i", $sport);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->affected_rows;
		}
		
		return $numRows;
	}//deleteSLS
	
	function updateSLS($fields){
        $queryString = "update server_slseason set ";
        $insertId = 0;
        $numRows = 0;
        $items = array();
        $types = "";

        foreach($fields as $k=>$v){
            switch($k){
                case "league" :
                    $queryString .= "league = ?,";
                    $items[] = &$field[$k];
                    $types .= "i";
                    break;
                case "season" :
                    $queryString .= "season = ?,";
                    $items[] = &$field[$k];
                    $types .= "i";
                    break;
                case "sport" :
                    $insertId = intval($v);
                    break;
            }//switch
        }//foreach

        $queryString = trim($queryString, ",");
        $queryString .= " where sport = ?";
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
    }//updateSLS
}//class
?>