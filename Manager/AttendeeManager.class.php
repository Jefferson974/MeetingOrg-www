<?php

function loadClass($classe){ require $classe . '.class.php'; }
spl_autoload_register('loadClass');

class AttendeeManager{

	private $_db;
    public function getDb() {return $this->_db;}

	public function __construct($db){
		$this->_db=$db;
    }

    // Add a list of attendees to a meeting
	public function add($meetingId, $attendees){
		try {
		    foreach ($attendees as $value) {
		    	$q = $this->_db->prepare('INSERT INTO jnct_users_meetings SET meeting_id = :meetingId, user_email = :userEmail');

			    $q->bindValue(':meetingId', $meetingId, PDO::PARAM_INT);
			    $q->bindValue(':userEmail', $value, PDO::PARAM_STR);

			    $q->execute();

					echo $q->errorInfo()[2];
		    }	    
		}catch (Exception $e){
		        echo 'Erreur : ',  $e->getMessage();
		}
	}

	//Edit a list of attendees for a meeting
	public function edit($meetingId, $attendees){
		delete($meetingId);
		add($meetingId, $attendees);	
	}

	//Delete all attendees from a meeting
	public function delete($meetingId){
		$this->_db->exec('DELETE FROM jnct_users_meetings WHERE id = '.$meetingId);
	}

/*    *VERSION JF ROCOCO*
	public function getMeetingsIdByEmailA($emailAttendee){
		$meetingsId = array();
		$q = $this->_db->prepare('SELECT meeting_id FROM jnct_users_meetings WHERE user_email ='.$emailAttendee);
		$q->execute();
		$result = $q->fetchAll();
		return $result;
	}*/

//**VERSIONRAPHAEL**
	public function getMeetingsIdByEmailA($emailAttendee){
		$q = $this->getDb()->prepare("SELECT meeting_id FROM jnct_users_meetings WHERE user_email = '$emailAttendee' ");
		$q->execute();
		$result = $q->fetchAll(PDO::FETCH_COLUMN, 0);

		if(count($result)!=0){
		return $result;
		}else{
		$result = "";
		//return "You have no meeting scheduled!";
		return $result;
		}
	}
		

	public function getEmailsByMeetingId($meetingId){
		$q = $this->_db->prepare('SELECT user_email FROM jnct_users_meetings WHERE meeting_id =$meetingId');
		$q->execute();
		echo $q->errorInfo();
		$result = $q->fetchAll(PDO::FETCH_COLUMN, 0);
		return $result;
	}
}

?>