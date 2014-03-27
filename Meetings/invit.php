<?php
require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeeManager.class.php");   
 
//check the form input and user credential
if($_SESSION['user_credential']==1 && !empty($_POST)){
	 
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

	// foreach ($result  as $value) {
	// 	echo "<br/>".$value;
	// }
	//check if the form is sent
	if($result != null) { 	   
	    $nbrErreurs = 0;	

	    //check if the required inputs are empties
	    if (empty($_POST["title"])) {
	    	echo "Missing title";$nbrErreurs++;

	    // case 1: allDay option checked: 	
	    }elseif(!empty($_POST["allDay"])){
	    	// the others time inputs except for startDate should be disabled
	    	if( empty($_POST['startDate']) || !empty($_POST['finishDate']) || !empty($_POST['startTime']) || !empty($_POST['finishTime']) ){
				echo "Conflicting date : all day option and date can't be chosen together."; 
	   			$nbrErreurs++;
			}else{
				$duration = "1 day";
			}
		
		// case 2 : no allDay option
	   	}elseif(empty($_POST['allDay'])){
	   		// if all day option is not checked, a meeting should have a start/end date and start/end time
	   		if(empty($_POST['startDate']) || empty($_POST['finishDate']) || empty($_POST['startTime']) || empty($_POST['finishTime'])){
	   			echo "Missing Start or End date / start or end time";
	   			$nbrErreurs++;
	   		// Normal condition : Date and Time Check
	   		}else{
	   			$startTime = preg_split("/[:]+/", $result['startTime'], -1, PREG_SPLIT_NO_EMPTY);
	   			$finishTime = preg_split("/[:]+/", $result['finishTime'], -1, PREG_SPLIT_NO_EMPTY);
	   			$startDate = new DateTime($result['startDate']);
	   			$finishDate = new DateTime($result['finishDate']);
	   			$startDate->setTime((int)$startTime[0], (int)$startTime[1]);
	   			$finishDate->setTime((int)$finishTime[0], (int)$finishTime[1]);
	   			echo "Start Date : ".$startDate->format('F j, Y, H:i ')."----<br/>";
	   			echo "finish Date : ".$finishDate->format('F j, Y, H:i ')."----<br/>";
	   			if($startDate > $finishDate){
	   				echo "Start of the meeting is greater than the finish date";
					$nbrErreurs++;	   			
	   			}else{
	   				//Compute duration 
	   				$dateDiff = $startDate->diff($finishDate);
	   				$duration = $dateDiff->format('%d day(s), %h hour(s), %i minute(s)');
	   				echo $duration;
	   			}
	   			
	   		}
	   	
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
			'duration' => $duration,
			'organizerId' => $userId
			);

			// add new meeting and retrieve the id meeting for invit form.
			$meetingManager = new MeetingManager($db);
			// foreach ($dataMeeting as $value) {
			// 	echo "---".$value."------<br/>";
			// }
			
			$meeting = new Meeting($dataMeeting);
			// echo "before";
			// echo $meeting->getTitle();
			$meetingManager->add($meeting);
			// echo "apres";
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
  <link rel="stylesheet" href="../css/style.css">
  <title>Invite attendees</title>
  
</head>
<body>
	<section class="container">
	<div id="invitePeopleForm">
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



