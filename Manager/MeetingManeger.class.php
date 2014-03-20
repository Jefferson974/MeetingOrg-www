<?php

function loadClass($classe){ require $classe . '.class.php'; }
spl_autoload_register('loadClass');

class MeetingManager{

	private $_db;

	public function __construct($db){
		$this->_db($_db);
	}

	public function add(Meeting $m){
		try {
	    $q = $this->_db->prepare('INSERT INTO meetings SET title = :title, startDate = :startDate, finishDate = :finishDate, -startTime = :startTime, finishTime = :finishTime, place = :place, organizer_id= :organizerId, duration = :duration, description= :description');

	    $q->bindValue(':title', $rdv->title(), PDO::PARAM_STR);
	    $q->bindValue(':startDate', $rdv->getStartDate(), PDO::PARAM_STR);
	    $q->bindValue(':finishDate', $rdv->getFinishDate(), PDO::PARAM_STR);
	    $q->bindValue(':startTime', $rdv->getStartTime(), PDO::PARAM_STR);
	    $q->bindValue(':finishTime', $rdv->getFinishTime(), PDO::PARAM_STR);
	    $q->bindValue(':place', $rdv->getPlace(), PDO::PARAM_STR);
	    $q->bindValue(':organizerId', $rdv->getOrganizerId(), PDO::PARAM_INT);
	    $q->bindValue(':duration', $rdv->getDuration(), PDO::PARAM_STR);
	    $q->bindValue(':description', $rdv->getDescription(), PDO::PARAM_STR);

	    $q->execute();
		}catch (Exception $e){
		echo 'Erreur : ',  $e->getMessage();
		}
	}

	public function addAttendees($meetingId, $attendees){
		try {
		    foreach ($attendees as $key => $value) {
		    	$q = $this->_db->prepare('INSERT INTO  SET title = :title, startDate = :startDate, finishDate = :finishDate, -startTime = :startTime, finishTime = :finishTime, place = :place, organizer_id= :organizerId, duration = :duration, description= :description');

			    $q->bindValue(':meetingsId', $meetingId, PDO::PARAM_INT);
			    $q->bindValue(':usersEmail', $value, PDO::PARAM_STR);

			    $q->execute();
		    }	    
		}catch (Exception $e){
		        echo 'Erreur : ',  $e->getMessage();
		}
	}

	public function delete($id){
		$this->_db->exec('DELETE FROM meetings WHERE id = '.$id);
	}

	public function edit(Meeting $m){
		$q = $this->_db->prepare('UPDATE meetings SET title = :title, startDate = :startDate, finishDate = :finishDate, startTime = :startTime, finishTime = :finishTime, place = :place, organizer_id= :organizerId, duration = :duration, description= :description, attendees= :attendees WHERE id = :id');
  		$q->bindValue(':title', $rdv->title(), PDO::PARAM_STR);
	    $q->bindValue(':startDate', $rdv->getStartDate(), PDO::PARAM_STR);
	    $q->bindValue(':finishDate', $rdv->getFinishDate(), PDO::PARAM_STR);
	    $q->bindValue(':startTime', $rdv->getStartTime(), PDO::PARAM_STR);
	    $q->bindValue(':finishTime', $rdv->getFinishTime(), PDO::PARAM_STR);
	    $q->bindValue(':place', $rdv->getPlace(), PDO::PARAM_STR);
	    $q->bindValue(':organizerId', $rdv->getOrganizerId(), PDO::PARAM_INT);
	    $q->bindValue(':duration', $rdv->getDuration(), PDO::PARAM_STR);
	    $q->bindValue(':description', $rdv->getDescription(), PDO::PARAM_STR);
    	$q->bindValue(':id', $rv->getId(), PDO::PARAM_INT);
    	$q->execute();
	}


	public function get($id){
		$id = (int) $id;
		$q = $this->_db->query('SELECT * FROM meetings WHERE id ='.$id);
		$result = $q->fetch(PDO::FETCH_ASSOC);
		return new Meeting($result);
	}

	public function getList(){
		$list_meetings = array();
	    $q = $this->_db->query('SELECT * FROM meetings ORDER BY id');
	    while ($data = $q->fetch(PDO::FETCH_ASSOC))
	    {
	      $list_meetings[] = new Meeting($data);
	    }
	    return $list_meetings;
	}








}