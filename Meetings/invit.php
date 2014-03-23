<?php
require_once("../config/config.php"); 
require_once("../Manager/MeetingManager.class.php"); 
require_once("../Manager/AttendeesMeetingManager.class.php"); 

$options = array(
	'title' => FILTER_SANITIZE_STRING,
	'startDate' => FILTER_SANITIZE_STRING,
	'finishDate' => FILTER_SANITIZE_STRING,
	'startTime' => FILTER_SANITIZE_STRING,
	'finishTime' => FILTER_SANITIZE_STRING,
	'allDay' => FILTER_SANITIZE_STRING,
	'repeatM' => FILTER_SANITIZE_STRING,
	'colorM' => FILTER_SANITIZE_STRING,
	'location' => FILTER_SANITIZE_STRING,
	'description' => FILTER_SANITIZE_STRING,
);

$result = filter_input_array(INPUT_POST, $options);

if($result != null) { //check if the form is sent
   
    $nbrErreurs = 0;	

    if (empty($_POST["title"])) {
    	echo" Missing title";$nbrErreurs++;
    }elseif( (!empty($_POST["startDate"]) || !empty($_POST["finishDate"]) ) && !empty($_POST["allDay"])){
   		echo "Conflicting date : all day option and date can't be chosen together."; 
   		$nbrErreurs++;
    }

    foreach($options as $cle => $valeur) {
        if($result[$cle] === false) { // not valid input
        echo "The ".$cle . "format is not valid";
        $nbrErreurs++;
        }
    }
    $_SESSION['India'] = "India likes hot stuff";
    echo $_SESSION['India'];
    echo $_SESSION['user_id'];
    echo $_SESSION['user_name'];
    echo $_SESSION['user_email'];


   	$userId = $_SESSION['user_id'];
    if($nbrErreurs == 0 && $_SESSION['user_credential']==1) {
	     $dataMeeting = array(
		'title' => $result['title'],
		'startDate' => $result['startDate'],
		'finishDate' => $result['finishDate'],
		'startTime' => $result['startTime'],
		'finishTime' => $result['finishTime'],
		'allDay' => $result['AllDay'],
		'repeatM' => $result['repeatM'],
		'colorM' => $result['colorM'],
		'location' => $result['location'],
		'description' => $result['description'],
		'organizerId' => $userId
		);
    }
}
else {
    echo "Empty form";
}


$meetingManager = new MeetingManager($db);
$meeting = new Meeting($dataMeeting);
$meetingManager->add($meeting);
$lastInsertM = $db->lastInsertId();
$_SESSION['lastInsertM'] = $lastInsertM;


?>

<!DOCTYPE html>
<form action="inviteProcess.php" method="POST" name="MeetingCreation">

<h2>Invite people: </h2>

<div>
List of attendees
<textarea name="attendees" cols="25" rows="5">
</textarea>
Email have to be written followed by semicolon.
</div>
<input type="submit" value = "Finish">
</form>






