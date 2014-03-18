<?php
class Meeting{
//Creation of the different variables
private $_id;
private $_title;
private $_datemeeting;
private $_place;
private $_organizer;
private $_duration;
private $_description;
public  $_attendees ;


//GETTERS ( 7 VARIABLES )
public function id(){ return $this->_id ;}
public function title(){ return $this->_title ;}
public function datemeeting(){ return $this->_datemeeting ;}
public function place(){ return $this->_place ;}
public function organizer(){ return $this->_organizer ;}
public function duration(){ return $this->_duration ;}
public function description(){ return $this->_description ;}
//public function attendees(){ return $this->_attendees;}

//SETTERS WITH CONTENT VERIFYER (8 VARIABLES)
public function setId($id){ $this->_id = (int)$id;}
public function setTitle($title){ if (is_string($title)) $this->_title = $title;}
public function setDatemeeting($datemeeting){ if (is_string($datemeeting)) $this->_datemeeting = $datemeeting;  }
public function setPlace($place){  if (is_string($place)) $this->_place = $place;  }
public function setOrganizer($organizer){ if (is_string($organizer)) $this->_organizer = $organizer;  }
public function setDuration($duration){   if ($duration <0){trigger_error('Duration needs to be a positive number.', E_USER_WARNING); return;} $this->_duration = (int)$duration;  }
public function setDescription($description){ if (is_string($description))  $this->_description = $description;  }
//public function setAttendees($attendees){  if (is_string($attendees)) $this->_attendees = $attendees;  }


//CONSTRUCTOR METHOD
public function __construct($data)
{
$this->hydrate($data);
//For the case of the attendee list we do not hydrate the attendee data but create an instance of the class Attendee which will contain the attendee list
$this->_attendees = new Attendees($data['attendees']);
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



//function to display the DATA about the meeting
public function displayMeetingInfo(){
echo "<br><br>";
echo "ID: ".$this->id() ;
echo "<br>Title: ".$this->title() ;
echo "<br>Date of Meeting: ".$this->datemeeting() ;
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


}

?>