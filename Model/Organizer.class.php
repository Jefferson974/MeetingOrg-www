<?php

function loadClass($classe){ require $classe . '.class.php'; }
spl_autoload_register('loadClass');

class Organizer{


//Variable storing the PDO variable
private $_db;

//CONSTRUCTOR
public function __construct($db)
{
$this->setDb($db);
}

//Setter for the PDO
public function setDb(PDO $db){ $this->_db = $db; }

//this function allows to add a meeting, require an OBJECT Meeting as attribute
public function addMeeting(Meeting $rdv)
  {
  	try {
    $q = $this->_db->prepare('INSERT INTO meetings SET title = :title, datemeeting = :datemeeting, place = :place, organizer= :organizer, duration = :duration, description= :description, attendees= :attendees');

    $q->bindValue(':title', $rdv->title(), PDO::PARAM_STR);
    $q->bindValue(':datemeeting', $rdv->datemeeting(), PDO::PARAM_STR);
    $q->bindValue(':place', $rdv->place(), PDO::PARAM_STR);
    $q->bindValue(':organizer', $rdv->organizer(), PDO::PARAM_STR);
    $q->bindValue(':duration', $rdv->duration(), PDO::PARAM_STR);
    $q->bindValue(':description', $rdv->description(), PDO::PARAM_STR);
    $q->bindValue(':attendees', $rdv->attendees->ListAttendees(), PDO::PARAM_STR);

    $q->execute();
}
catch (Exception $e)
{
        echo 'Erreur : ',  $e->getMessage();
}
    echo "Meeting enregistr&eacute;!";
  }


//Function to access all meetings
 //to access a meeting property do: NAMEOFTHEORGANIZER->getAllMeetings()[INDICEOFTHEMEETING]->GETTER();
public function getAllMeetings()
  {
    $list_meetings = array();

    $q = $this->_db->query('SELECT id,title,datemeeting,place,organizer,duration,description,attendees FROM meetings ORDER BY id');

    while ($data = $q->fetch(PDO::FETCH_ASSOC))
    {
      $list_meetings[] = new Meeting($data);
    }

    return $list_meetings;
}

//Delete a meeting with its ID as argument
public function removeMeeting($idToDelete){
$this->_db->exec('DELETE FROM meetings WHERE id = '.$idToDelete);
}

//update a meeting
public function updateAttendees(Meeting $rv) {

    $q = $this->_db->prepare('UPDATE meetings SET attendees =:attendees WHERE id = :id');
    $q->bindValue(':attendees', $rv->_attendees->ListAttendees(), PDO::PARAM_STR);
    $q->bindValue(':id', $rv->id(), PDO::PARAM_INT);
    $q->execute();
    echo "Meeting attendee list updated!";
}


//END OF CLASS ORrganizer
}


//DEBUT OF MAIN ACTIVITIES , TESTING PURPOSES ETC..
$db = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  //Exemple of Creation of a Meeting
  $rdv = new Meeting(
  array(
   'title' => "Dentiste",
   'datemeeting' => "13 janvier",
   'place' => "Wheatley",
   'organizer' => "bouh ",
   'duration' => "30 minutes",
   'description' => "Une carrie a retirer",
   'attendees' => "Jean francois himself"
   ));


  $organizer = new Organizer($db);
  // to implement the modify function, one needs to 
  // to modify the list of invited , just INPUT data in the ATTENDY ARRAY underneath HERE
  // Dont forget to use mysql_real_escape_string() on the string serialized! 
  $modify = new Meeting(
     array(
     	'id' => 2, //ID OF MEETING TO UPDATE
     	'attendees' => array("13103897@brookes.ac.uk","minu@gmaul.com","testpurpose@purposegmail.com","jeanfrancoisROCOCO@gmail.com") // NEW LIST OF ATTENDEES
     	));
   $organizer->updateAttendees($modify);
   



   echo "<br><br><br><br><br>affichons l'ensemble des meetings: ";
   echo $modify->id()."<br>";
   echo "fucktarace";

	for($i=0;$i<7;++$i)
echo $organizer->getAllMeetings()[$i]->displayMeetingInfo()."<br>";

  
?>