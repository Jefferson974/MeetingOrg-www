<?php
class Meeting{
//Creation of the different variables
private $_id;
private $_title;
private $_startDate;
private $_finishDate;
private $_startTime;
private $_finishTime;
private $_place;
private $_organizerId;
private $_duration;
private $_description;
private $_repeat;


//GETTERS ( 7 VARIABLES )
public function getId(){ return $this->_id ;}
public function getTitle(){ return $this->_title ;}
public function getStartDate(){ return $this->_startDate ;}
public function getFinishDate(){ return $this->_finishDate ;}
public function getStartTime(){ return $this->_startTime ;}
public function getFinishTime(){ return $this->_finishTime ;}
public function getPlace(){ return $this->_place ;}
public function getOrganizerId(){ return $this->_organizerId ;}
public function getDuration(){ return $this->_duration ;}
public function getDescription(){ return $this->_description ;}
public function getRepeat(){ return $this->_repeat ;}

//SETTERS WITH CONTENT VERIFYER (8 VARIABLES)
public function setId($id){ $this->_id = (int)$id;}
public function setTitle($title){ if (is_string($title)) $this->_title = $title;}
public function setStartDate($startDate){ if (is_string($startDate)) $this->_startDate = $startDate; }
public function setFinishDate($finishDate){ if (is_string($finishDate)) $this->_finishDate = $finishDate; }
public function setStartTime($startTime){ if (is_string($startTime)) $this->_startTime = $startTime; }
public function setFinishTime($finishTime){ if (is_string($finishTime)) $this->_finishTime = $finishTime; }
public function setPlace($place){  if (is_string($place)) $this->_place = $place;  }
public function setOrganizerId($organizer){  $this->_organizerId = (int) $organizer;  }
public function setDuration($duration){   if ($duration <0){trigger_error('Duration needs to be a positive number.', E_USER_WARNING); return;} $this->_duration = (int)$duration;  }
public function setDescription($description){ if (is_string($description))  $this->_description = $description;  }
public function getRepeat($repeat){ if (is_string($repeat)) $this->_repeat = $repeat; }


//CONSTRUCTOR METHOD
public function __construct($data)
{
$this->hydrate($data);
//For the case of the attendee list we do not hydrate the attendee data but create an instance of the class Attendee which will contain the attendee list
//$this->_attendees = new Attendees($data['attendees']);
}



// FUNCTION TO HYDRATE THE OBJECT MEETING
public function hydrate(array $data)
{
  foreach ($data as $key => $value)
  { 
    $method = 'set'.ucfirst($key);
    if (method_exists($this, $method))
    {
      $this->$method($value);
    }
  }
}


/*
//function to display the DATA about the meeting
public function displayMeetingInfo(){
echo "<br><br>";
echo "ID: ".$this->id() ;
echo "<br>Title: ".$this->title() ;
echo "<br>Start Date of Meeting: ".$this->getStartDate() ;

echo "<br>Place: ".$this->place() ;
echo "<br>Organizer: ".$this->organizer() ;
echo "<br>Duration: ".$this->duration() ;
echo "<br>Description: ".$this->description() ;
echo " <br> NEED TO FIND A WAY TO PARSE THE EMAILS BACK TO A USABLE FORM..";
$displayTable= unserialize($this->_attendees->listAttendees() );

echo "<br>Attendees: ".$displayTable;
}


//function to send emails to atendees
function sendEmail()
{
echo "mail envoyé!";
}

*/
}

?>