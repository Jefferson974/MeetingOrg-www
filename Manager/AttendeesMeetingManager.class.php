<?php

function loadClass($classe){ require $classe . '.class.php'; }
spl_autoload_register('loadClass');

class AttendeesMeetingManager{

	private $_db;

	public function __construct($db){
		$this->_db=$db;
		echo "Class instanciated !";
	}

	public function add($meetingId, $attendees){
			try {
			    foreach ($attendees as $value) {
			    	$q = $this->_db->prepare('INSERT INTO jnct_users_meetings SET meeting_id = :meetingId, user_email = :userEmail');

				    $q->bindValue(':meetingId', $meetingId, PDO::PARAM_INT);
				    $q->bindValue(':userEmail', $value, PDO::PARAM_STR);

				    $q->execute();
echo "dadadad";
	   				echo $q->errorInfo()[2];
			    }	    
			}catch (Exception $e){
			        echo 'Erreur : ',  $e->getMessage();
			}
	}

	public function edit($meetingId, $attendees){
		delete($meetingId);
		add($meetingId, $attendees);	
	}

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
		$meetingsId = array();
		$q = $this->_db->prepare('SELECT meeting_id FROM jnct_users_meetings WHERE user_email ='.$emailAttendee);
		$q->execute();
		$result = $q->fetchAll();

		if(count($result)!=0){
		return $result[0][0];
	}
	else {
		return "You have no meeting scheduled!";
	}
	}
		

	public function getEmailsByMeetingId($meetingId){
		$q = $this->_db->prepare('SELECT user_email FROM jnct_users_meetings WHERE meeting_id ='.$meetingId);
		$q->execute();
		 echo $q->errorInfo();
		$result = $q->fetchAll();
		return $result;
	}
}

?>