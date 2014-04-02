<?php
/**     Group Project : Team 7, Meeting Organizer
  *   Author : Jean-Francois Rococo
  *   Date : 31/04/2014
  *   This page gathers the name of the invitees, verify that the form was previously well filled, and send the invitations
  *
 */
require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeeManager.class.php");   
 
//check the form input and user credential
if($_SESSION['user_credential']==1 && !empty($_POST['create_submit'])){
	 
	$options = array(
		'title' => FILTER_SANITIZE_STRING,
		'startDate' => FILTER_SANITIZE_STRING,
		'startTime' => FILTER_SANITIZE_STRING,
		'duration' => FILTER_SANITIZE_STRING,
		'allDay' => FILTER_SANITIZE_NUMBER_INT,
		'repeatM' => FILTER_SANITIZE_STRING,
		'repeatMTimes' => FILTER_SANITIZE_NUMBER_INT,
		'colorM' => FILTER_SANITIZE_STRING,
		'place' => FILTER_SANITIZE_STRING,
		'description' => FILTER_SANITIZE_STRING,
	);
	$result = filter_input_array(INPUT_POST, $options); 

	//check if the form is sent
	if($result != null) { 	   
	    $nbrErreurs = 0;	

	    //check if the required inputs are empties
	    if (empty($_POST["title"])) {
	    	echo "Missing title";$nbrErreurs++;

	    // case 1: allDay option checked: 	
	    }elseif(!empty($_POST["allDay"])){
	    	// the others time inputs except for startDate should be disabled
	    	if( empty($_POST['startDate']) || !empty($_POST['startTime']) || !empty($_POST['duration'])){
				echo "Conflicting date : all day option and date can't be chosen together."; 
	   			$nbrErreurs++;
			}else{
				$duration = "24:00" ; // All working day
			}
		
		// case 2 : no allDay option
	   	}elseif(empty($_POST['allDay'])){
	   		// if all day option is not checked, a meeting should have a start/end date and start/end time
	   		if(empty($_POST['startDate']) || empty($_POST['startTime']) || empty($_POST['duration'])){
	   			echo "Missing Start date/time";
	   			$nbrErreurs++;
	   		// Normal condition : Date and Time Check
	   		}else{
	   			$duration = $result['duration'];	   			
	   		}
	   	
	   	}elseif (empty($_POST['repeatM'])) {
	   		echo "Missing Repeat Option";
	    // Default setting for repeat option {10 times}		
	   	}elseif (empty($_POST['repeatMTimes'])){
	   		$result['repeatMTimes'] = 10;
	   	}

	    //check invalid inputs
	    foreach($options as $cle => $valeur) {
	        if($result[$cle] === false) { // not valid input
	       		 echo "The ".$cle . "format is not valid";
	       		 $nbrErreurs++;
	        }
	    }
	    //check negative number
	    if ($result['repeatMTimes']<0) {
	    	$result['repeatMTimes'] = 0;	
	    } 

		// array of data to create a meeting's object
	   	$userId = $_SESSION['user_id'];
	   	$description = trim($result['description']);
	    if($nbrErreurs == 0){
		     $dataMeeting = array(
			'title' => $result['title'],
			'startDate' => $result['startDate'],
			'startTime' => $result['startTime'],
			'allDay' => $result['allDay'],
			'repeatM' => $result['repeatM'],
			'repeatMTimes' => $result['repeatMTimes'],
			'colorM' => $result['colorM'],
			'place' => $result['place'],
			'description' => $description,
			'duration' => $duration,
			'organizerId' => $userId,
			); 

			// add new meeting and retrieve the id meeting for invit form.
			$meetingManager = new MeetingManager($db);			
			$meeting = new Meeting($dataMeeting);
			$lastInsertM = array();

			switch ($meeting->getRepeatM()) {
				case 'None':  
					if($result['allDay']!=1){
						//retrieve time variables 
						$time = preg_split("/[:]+/", $meeting->getStartTime(), -1, PREG_SPLIT_NO_EMPTY);
						$durationToAdd = preg_split("/[:]+/", $duration, -1, PREG_SPLIT_NO_EMPTY);
						//set DateTime
				 
						$finishDate = new DateTime($meeting->getStartDate());
						$finishDate->setTime((int)$time[0], (int)$time[1]);
						//add duration
						$finishDate->add(new DateInterval("PT".(int)$durationToAdd[0]."H".(int)$durationToAdd[1]."M"));
						 
						//Set finish date
						$meeting->setFinishDate($finishDate->format('Y-m-d G:i'));
					}else $meeting->setFinishDate($result['startDate']); 
					
					//add meeting  
					$meetingManager->add($meeting); 
					$lastInsertM[] = $db->lastInsertId();
					break;

				case 'Daily':  
					for( $i = 0; $i <= $result['repeatMTimes']; $i++){
						if($result['allDay']!=1){
							//-----set new finishDate------	
							//retrieve time variables
							$time = preg_split("/[:]+/", $meeting->getStartTime(), -1, PREG_SPLIT_NO_EMPTY);
							$durationToAdd = preg_split("/[:]+/", $duration, -1, PREG_SPLIT_NO_EMPTY);
							//set DateTime
							$finishDate = new DateTime($meeting->getStartDate());
							$finishDate->setTime((int)$time[0], (int)$time[1]);
							//add duration
							$finishDate->add(new DateInterval("PT".(int)$durationToAdd[0]."H".(int)$durationToAdd[1]."M"));
							$meeting->setFinishDate($finishDate->format('Y-m-d G:i'));
						}else $meeting->setFinishDate($meeting->getStartDate());

							//add meeting
							$meetingManager->add($meeting);
							$lastInsertM[] = $db->lastInsertId();

						//-----set new StartDate------						 
						$startDate = new DateTime($meeting->getStartDate());
						$startDate->add(new DateInterval('P1D'));
						$meeting->setStartDate($startDate->format('Y-m-d'));
					}
					break;

				case 'Weekly': 
					for( $i = 0; $i <= $result['repeatMTimes']; $i++){
						if($result['allDay']!=1){
							//-----set new finishDate------	
							//retrieve time variables
							$time = preg_split("/[:]+/", $meeting->getStartTime(), -1, PREG_SPLIT_NO_EMPTY);
							$durationToAdd = preg_split("/[:]+/", $duration, -1, PREG_SPLIT_NO_EMPTY);
							//set DateTime
							$finishDate = new DateTime($meeting->getStartDate());
							$finishDate->setTime((int)$time[0], (int)$time[1]);
							//add duration
							$finishDate->add(new DateInterval("PT".(int)$durationToAdd[0]."H".(int)$durationToAdd[1]."M"));
							$meeting->setFinishDate($finishDate->format('Y-m-d G:i'));
						}else $meeting->setFinishDate($meeting->getStartDate());

						//add meeting
						$meetingManager->add($meeting);
						$lastInsertM[] = $db->lastInsertId();


						//-----set new StartDate------						 
						$startDate = new DateTime($meeting->getStartDate());
						$startDate->add(new DateInterval('P1W'));
						$meeting->setStartDate($startDate->format('Y-m-d'));
					}
					break;
				
				case 'Monthly': 
					for( $i = 0; $i <= $result['repeatMTimes']; $i++){
						if($result['allDay']!=1){
							//-----set new finishDate------	
							//retrieve time variables
							$time = preg_split("/[:]+/", $meeting->getStartTime(), -1, PREG_SPLIT_NO_EMPTY);
							$durationToAdd = preg_split("/[:]+/", $duration, -1, PREG_SPLIT_NO_EMPTY);
							//set DateTime
							$finishDate = new DateTime($meeting->getStartDate());
							$finishDate->setTime((int)$time[0], (int)$time[1]);
							//add duration
							$finishDate->add(new DateInterval("PT".(int)$durationToAdd[0]."H".(int)$durationToAdd[1]."M"));
							$meeting->setFinishDate($finishDate->format('Y-m-d G:i'));
						}else $meeting->setFinishDate($meeting->getStartDate());

						//add meeting
						$meetingManager->add($meeting);
						$lastInsertM[] = $db->lastInsertId();


						//-----set new StartDate------						 
						$startDate = new DateTime($meeting->getStartDate());
						$startDate->add(new DateInterval('P1M'));
						$meeting->setStartDate($startDate->format('Y-m-d'));
					}
					break;
				
				
				default: 
					if($result['allDay']!=1){
						//retrieve time variables
						 
						$time = preg_split("/[:]+/", $meeting->getStartTime(), -1, PREG_SPLIT_NO_EMPTY);
						$durationToAdd = preg_split("/[:]+/", $duration, -1, PREG_SPLIT_NO_EMPTY);
						//set DateTime
					 
						$finishDate = new DateTime($meeting->getStartDate());
						$finishDate->setTime((int)$time[0], (int)$time[1]);
						//add duration
						$finishDate->add(new DateInterval("PT".(int)$durationToAdd[0]."H".(int)$durationToAdd[1]."M"));
						 
						//Set finish date
						$meeting->setFinishDate($finishDate->format('Y-m-d G:i'));
					}else $meeting->setFinishDate($result['startDate']);
					 
					//add meeting
					$meetingManager->add($meeting);
					$lastInsertM[] = $db->lastInsertId();
					break;
			}

			$_SESSION['lastInsertM'] = $lastInsertM; 
			$repeatIdList = $lastInsertM;
			foreach ($lastInsertM as $value) {				 	
				$firstMeeting = $meetingManager->get($value);
				array_shift($repeatIdList);  
				$arrayToString= base64_encode(serialize($repeatIdList)); 
				$firstMeeting->setRepeatIdList($arrayToString);
				$meetingManager->edit($firstMeeting);
			}

		} // need redirection in case of error and diplay it
	}
				
}else{
	echo "The form is empty. You must fill the form to create a meeting.";
	$newURL="../index.php"; 
	header('Location: '.$newURL);
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
	<section class="top">
    <div id="logo">   
     <a href="../index.php"><img class ="logoLogin" src="../images/logoTransparent.png" height="120px"></a>
    </div>
    <div id="loggedIn">
      <img src="../images/personIcon.png" height="20px;" >
      <p><?php echo $_SESSION['user_name'];?> | <a href="../index.php?logout">Logout</a> </p>
    </div>
    
	</section>
	<section class="main">
	    <h1>Invite to your meeting</h1>
	</section>
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
		<input type="submit" value = "Finish" name="invite_submit">
	</form>
</body>
</html>



