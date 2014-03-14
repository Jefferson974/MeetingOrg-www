<?php
class Attendees {
private $_listeAttendees ;

public function __construct($filling) {
$this->_listeAttendees = $filling;
}

public function listAttendees()
{
	return serialize($this->_listeAttendees);
}

public function setListAttendees($liste)
{
$this->_listeAttendees= $liste;
}

}

?>