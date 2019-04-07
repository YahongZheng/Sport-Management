<!--Yahong Zheng-->
<!--ISTE341-->
<!--Project 1-->
<!--Schedule Class Page-->
<?php
class Schedule{
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
		
		if( $stmt = $this->db->prepare("select * from server_schedule") ){
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($sport, $league, $season, $hometeam, $awayteam, $homescore, $awayscore, $scheduled, $completed);
			
			if( $stmt->num_rows > 0 ){
				while( $stmt->fetch() ){
					$data[] = array('sport'=>$sport, 'league'=>$league, 
									'season'=>$season, 'hometeam'=>$hometeam,
									'awayteam'=>$awayteam, 'homescore'=>$homescore,
									'awayscore'=>$awayscore, 'scheduled'=>$scheduled,
									'completed'=>$completed);
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
						<th>Season</th><th>Home Team</th>
						<th>Away Team</th><th>Home Score</th>
						<th>Away Scroe</th><th>Scheduled</th>
						<th>Completed</th><th>Delete Schedule</th>
						</tr>\n";
			
			foreach( $data as $row ){
				$bigString .= "<tr>
								<td>{$row['sport']}</td><td>{$row['league']}</td>
								<td>{$row['season']}</td><td>{$row['hometeam']}</td>
								<td>{$row['awayteam']}</td><td>{$row['homescore']}</td>
								<td>{$row['awayscore']}</td><td>{$row['scheduled']}</td>
								<td>{$row['completed']}</td>
								<td><a href='delete_schedule.php?hometeam=".$row['hometeam']."'>Delete</a></td>
								</tr>\n";
			}
			
			$bigString .= "</table>\n
							<a href='add_schedule.php'>Add new Schedule</a>";
		}
		return $bigString;
	}//getAllRecordsAsTable
	
	function addSchedule($sport, $league, $season, $hometeam, $awayteam, $homescore, $awayscore, $scheduled, $completed){
		$query = "insert into server_schedule (sport, league, season, hometeam, awayteam, homescore, awayscore, scheduled, completed)
					value (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		
		$insertId = -1;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("iiiiiiisi", $sport, $league, $season, $hometeam, $awayteam, $homescore, $awayscore, $scheduled, $completed);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->insert_id;
		}
		return $insertId;
	}//addTeam
	
	function deleteSchedule($hometeam){
		$query = "delete from server_schedule where hometeam = ?";
		
		$numRows = 0;
		
		if( $stmt = $this->db->prepare($query) ){
			$stmt->bind_param("i", $hometeam);
			$stmt->execute();
			$stmt->store_result();
			$insertId = $stmt->affected_rows;
		}
		
		return $numRows;
	}//deleteTeam
}//class
?>