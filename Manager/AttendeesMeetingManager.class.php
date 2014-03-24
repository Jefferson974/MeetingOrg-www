<?php

function loadClass($classe){ require $classe . '.class.php'; }
spl_autoload_register('loadClass');

class AttendeesMeetingManager{

	private $_db;

	public function __construct($db){
		$this->_db=$db;
		echo "Class instnaciated !";
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


	public function getMeetingsIdByEmailA($emailAttendee){
		echo "inside the getMeetingIdbyEmail step 1";
		$meetingsId = array();
		$q = $this->_db->prepare('SELECT meeting_id FROM jnct_users_meetings WHERE user_email ='.$emailAttendee);
		$q->execute();
			//echo "\n inside the getMeetingIdbyEmail step 2;";
		$result = $q->fetchAll(PDO::FETCH_COLUMN,1);
		return $result;
	}

	public function getEmailsByMeetingId($meetingId){
		$q = $this->_db->prepare('SELECT user_email FROM jnct_users_meetings WHERE meeting_id ='.$meetingId);
		$q->execute();
		 echo $q->errorInfo()[2];
		$result = $q->fetchAll();
		return $result;
	}
}
?>