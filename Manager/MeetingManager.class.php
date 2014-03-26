<?php
 
/*function loadClass($classe){ require_once __DIR__.'/../Model/'.$classe . '.class.php'; }
function loadClass2($classe){ require_once __DIR__.'/../Manager/'.$classe . '.class.php'; }
spl_autoload_register('loadClass', 'loadClass2');*/
require_once(__DIR__."/../Model/Meeting.class.php"); 

class MeetingManager{

	private $_db;


	public function __construct($db){
		$this->_db=$db;
	}

	// Add a meeting to the database
	public function add(Meeting $m){
		try {
	    $q = $this->_db->prepare('INSERT INTO meetings SET title = :title, startDate = :startDate, finishDate = :finishDate, startTime = :startTime, finishTime = :finishTime, place = :place, organizer_id= :organizerId, duration = :duration, description= :description, repeatM = :repeatM, colorM = :colorM');
	   
	    $q->bindValue(':title', $m->getTitle(), PDO::PARAM_STR);
	    $q->bindValue(':startDate', $m->getStartDate(), PDO::PARAM_STR);
	    $q->bindValue(':finishDate', $m->getFinishDate(), PDO::PARAM_STR);
	    $q->bindValue(':startTime', $m->getStartTime(), PDO::PARAM_STR);
	    $q->bindValue(':finishTime', $m->getFinishTime(), PDO::PARAM_STR);
	 //  $q->bindValue(':allDay', $m->getAllDay(), PDO::PARAM_BOOL);
	    $q->bindValue(':place', $m->getPlace(), PDO::PARAM_STR);
	    $q->bindValue(':organizerId', $m->getOrganizerId(), PDO::PARAM_INT);
	    $q->bindValue(':duration', $m->getDuration(), PDO::PARAM_STR);
	    $q->bindValue(':description', $m->getDescription(), PDO::PARAM_STR);
	    $q->bindValue(':repeatM', $m->getRepeatM(), PDO::PARAM_STR);
	    $q->bindValue(':colorM', $m->getColorM(), PDO::PARAM_STR);
	    echo "execute";
	    $q->execute();
		}catch (PDOException $e){
       echo 'Erreur : ',  $e->getMessage();
		}
	}

	
	// Delete a meeting using its ID
	public function delete($id){
		$this->_db->exec('DELETE FROM meetings WHERE id = '.$id);
	}

	//Edit a meeting using its ID
	public function edit(Meeting $m){
		$q = $this->_db->prepare('UPDATE meetings SET title = :title, startDate = :startDate, finishDate = :finishDate, startTime = :startTime, finishTime = :finishTime, allDay = : allDay, place = :place, organizer_id= :organizerId, duration = :duration, description= :description, repeatM = :repeatM, colorM = :colorM WHERE id = :id');
  		$q->bindValue(':title', $m->title(), PDO::PARAM_STR);
	    $q->bindValue(':startDate', $m->getStartDate(), PDO::PARAM_STR);
	    $q->bindValue(':finishDate', $m->getFinishDate(), PDO::PARAM_STR);
	    $q->bindValue(':startTime', $m->getStartTime(), PDO::PARAM_STR);
	    $q->bindValue(':finishTime', $m->getFinishTime(), PDO::PARAM_STR);
	    $q->bindValue(':allDay', $m->getAllDay(), PDO::PARAM_BOOL);
	    $q->bindValue(':place', $m->getPlace(), PDO::PARAM_STR);
	    $q->bindValue(':organizerId', $m->getOrganizerId(), PDO::PARAM_INT);
	    $q->bindValue(':duration', $m->getDuration(), PDO::PARAM_STR);
	    $q->bindValue(':description', $m->getDescription(), PDO::PARAM_STR);
	    $q->bindValue(':repeat', $m->getRepeat(), PDO::PARAM_STR);
	    $q->bindValue(':colorM', $m->getColorM(), PDO::PARAM_STR);
    	$q->bindValue(':id', $m->getId(), PDO::PARAM_INT);
    	$q->execute();
    	
	    echo $q->errorInfo()[2];
	}

	//Retrieve meeting from its ID
	public function get($id){
		$id = (int) $id;
		$q = $this->_db->query('SELECT * FROM meetings WHERE id ='.$id);
		$result = $q->fetch(PDO::FETCH_ASSOC);
		return new Meeting($result);
	}

	/*public function getList(){
		$list_meetings = array();
	    $q = $this->_db->query('SELECT * FROM meetings ORDER BY id');
	    while ($data = $q->fetch(PDO::FETCH_ASSOC))
	    {
	      $list_meetings[] = new Meeting($data);
	    }
	    return $list_meetings;
	}
	*/

	// Get a list of meetings created by an organizer 
	public function getListByOrg($organizerId){
		$id = (int) $organizerId;
		$meetings = array();
		$q = $this->_db->query('SELECT * FROM meetings WHERE organizer_id ='.$id);
		while($result = $q->fetch(PDO::FETCH_ASSOC)){
			$meetings[] = new Meeting($result); 
		} 
		return $meetings;
	}


	// Get a list of meetings by attendee
	public function getListByAttendee($meetingIdList){
		if($meetingIdList!= "") {
			$meetings = array();
			// Retrieve meeting for each meeting ID
			foreach ($arrayIdMeetings as $value) {
				$meetings[] = $this->get($value); 				
			}
			return $meetings;
		}else{ $meetings = [] ; return $meetings;}
	}



}