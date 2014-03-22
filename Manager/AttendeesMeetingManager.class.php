<?php

function loadClass($classe){ require $classe . '.class.php'; }
spl_autoload_register('loadClass');

class AttendeesMeetingManager{

	private $_db;

	public function __construct($db){
		$this->_db($_db);
	}

	public function add($meetingId, $attendees){
			try {
			    foreach ($attendees as $key => $value) {
			    	$q = $this->_db->prepare('INSERT INTO jnct_users_meetings SET meeting_id = :meetingId, user_email = :userEmail');

				    $q->bindValue(':meetingId', $meetingId, PDO::PARAM_INT);
				    $q->bindValue(':userEmail', $value, PDO::PARAM_STR);

				    $q->execute();
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


	public function getMeettingsIdByEmailA($emailAttendee){
		$meetingsId = array();
		$q = $this->_db->query('SELECT meeting_id FROM jnct_users_meetings WHERE user_email ='.$emailAttendee);
		$result = $q->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

?>