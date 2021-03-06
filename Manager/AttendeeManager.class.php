<?php
 /**     Group Project : Team 7, Meeting Organizer
  *   Author : Jean-Francois Rococo
  *   Date : 31/04/2014
  *   Manager for attendees
  *
 */
require_once(__DIR__."/../Model/Meeting.class.php");   

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
		        echo 'Erreur : ',  $e->getMesBsage();
		}
	}

	//Edit a list of attendees for a meeting
	public function edit($meetingId, $attendees){
		delete($meetingId);
		add($meetingId, $attendees);	
	}
    //Set the attendee answer in the database
	public function setAnswer($meetingId, $user_email, $answer){
		$q = $this->_db->prepare('UPDATE jnct_users_meetings SET invitation_answer = :invitation_answer WHERE meeting_id = :meeting_id && user_email = :user_email');
  		$q->bindValue(':invitation_answer', $answer, PDO::PARAM_INT);
	  	$q->bindValue(':meeting_id', $meetingId, PDO::PARAM_INT);  
    	$q->bindValue(':user_email', $user_email, PDO::PARAM_STR);
    	$q->execute();
    	
	    echo $q->errorInfo()[2];
	}
     //return the response of the attendee from the database
	public function getAnswer($meetingId, $user_email){
		$q = $this->getDb()->prepare("SELECT invitation_answer FROM jnct_users_meetings WHERE meeting_id=? && user_email=? ");
		$q->execute(array($meetingId, $user_email));
		$result = $q->fetchAll(PDO::FETCH_COLUMN, 0);  
		return $result;
	}




	//Delete all attendees from a meeting
	public function delete($meetingId){
		$this->_db->exec('DELETE FROM jnct_users_meetings WHERE id = '.$meetingId);
	}


//**VERSIONRAPHAEL**
	public function getMeetingsIdByEmailA($emailAttendee){ 
		$q = $this->getDb()->prepare("SELECT meeting_id FROM jnct_users_meetings WHERE user_email=?");
		$q->execute(array($emailAttendee));
		$result = $q->fetchAll(PDO::FETCH_COLUMN, 0); 
		if(count($result)!=0){
		return $result;
		}else{
		$result = "";
		return $result;
		}
	}
		
//function to get an email list by meeting ID provided as parameter
	public function getEmailsByMeetingId($meetingId){
		$q = $this->_db->prepare("SELECT user_email FROM jnct_users_meetings WHERE meeting_id =?");
		$q->execute(array($meetingId));
		echo $q->errorInfo()[2];
		$result = $q->fetchAll(PDO::FETCH_COLUMN, 0);
		return $result;
	}
}

?>