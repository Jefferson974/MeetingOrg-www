<?php
 require_once("Manager/required.php"); 
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
    }elseif ( (!empty(startDate) || !empty(finishDate)) && !empty(allDay))  {
   		echo "Conflicting date : all day option and date can't be chosen together."; 
   		$nbrErreurs++;
    }

    foreach($options as $cle => $valeur) {
        f($resultat[$cle] === false) { // not valid input
        echo "The ".$cle . "format is not valid";
        $nbrErreurs++;
        }
    }

    if($nbrErreurs == 0) {
	     $dataMeeting = new array(
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
		);
    }
}
else {
    echo "Empty form";
}






?>

<!DOCTYPE html>
<form action="invitation.php" method="POST" name="MeetingCreation">

<h2>Invite people: </h2>

<div>
List of attendees
<textarea name=“description” cols="25" rows="5">
</textarea>
Email have to be written followed by semicolon.
</div>
<input type="submit" value = "Finish">
</form>






