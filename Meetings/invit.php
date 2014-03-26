<?php
require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeeManager.class.php");   
echo"2<br/>";
//check the form input and user credential
if($_SESSION['user_credential']==1 && !empty($_POST)){
	echo"3<br/>";
	//echo $_POST['title']."<br/>";
	//Validate user input
	$options = array(
		'title' => FILTER_SANITIZE_STRING,
		'startDate' => FILTER_SANITIZE_STRING,
		'finishDate' => FILTER_SANITIZE_STRING,
		'startTime' => FILTER_SANITIZE_STRING,
		'finishTime' => FILTER_SANITIZE_STRING,
		'allDay' => FILTER_SANITIZE_STRING,
		'repeatM' => FILTER_SANITIZE_STRING,
		'colorM' => FILTER_SANITIZE_STRING,
		'place' => FILTER_SANITIZE_STRING,
		'description' => FILTER_SANITIZE_STRING,
	);
	$result = filter_input_array(INPUT_POST, $options);

	foreach ($result  as $value) {
		echo "<br/>".$value;
	}
	//check if the form is sent
	if($result != null) { 	   
	    $nbrErreurs = 0;	

	    //check if the required inputs are empties
	    if (empty($_POST["title"])) {
	    	echo "Missing title";$nbrErreurs++;
	    }elseif( (!empty($_POST["startDate"]) || !empty($_POST["finishDate"]) ) && !empty($_POST["allDay"])){
	   		echo "Conflicting date : all day option and date can't be chosen together."; 
	   		$nbrErreurs++;
	    }

	    //check invalid inputs
	    foreach($options as $cle => $valeur) {
	        if($result[$cle] === false) { // not valid input
	        echo "The ".$cle . "format is not valid";
	        $nbrErreurs++;
	        }
	    }

	    // array of data to create a meeting's object
	   	$userId = $_SESSION['user_id'];
	    if($nbrErreurs == 0){
		     $dataMeeting = array(
			'title' => $result['title'],
			'startDate' => $result['startDate'],
			'finishDate' => $result['finishDate'],
			'startTime' => $result['startTime'],
			'finishTime' => $result['finishTime'],
			'allDay' => $result['allDay'],
			'repeatM' => $result['repeatM'],
			'colorM' => $result['colorM'],
			'place' => $result['place'],
			'description' => $result['description'],
			'organizerId' => $userId
			);

		// add new meeting and retrieve the id meeting for invit form.
		$meetingManager = new MeetingManager($db);
		foreach ($dataMeeting as $value) {
			echo "---".$value."------<br/>";
		}
		
		$meeting = new Meeting($dataMeeting);
		echo "before";
		echo $meeting->getTitle();
		$meetingManager->add($meeting);
		echo "apres";
		$lastInsertM = $db->lastInsertId();
		$_SESSION['lastInsertM'] = $lastInsertM;
		}
	}else{echo "The form is empty. You must fill the form to create a meeting.";}
}?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Invite attendees</title>
</head>
<body>
	<form action="inviteProcess.php" method="POST" name="invite">
		<h2>Invite people: </h2>
		<div>
			List of attendees
			<textarea name="attendees" cols="25" rows="5">
			</textarea>
			<br/>
			Email have to be written followed by semicolon.
		</div>
		<input type="submit" value = "Finish">
	</form>
</body>
</html>



