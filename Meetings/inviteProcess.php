<?php

require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeeManager.class.php");  
echo "start" . $_SESSION['user_credential'];
echo "<br/> :  1";
//check the form input and user credential
  echo "----------user_name :". $_SESSION['user_name']."<br/>";
  echo "----------user_email :". $_SESSION['user_email']."<br/>" ;
  echo "----------user_credential:". $_SESSION['user_credential']."<br/>" ;  
if(isset($_POST['invite'], $_SESSION['user_credential']) && $_SESSION['user_credential']==1){
echo "<br/> :  2";
	$attendeeManager = new AttendeeManager($db);
	// Clean user input
	$result = filter_input(INPUT_POST, $_POST['attendees'], FILTER_SATINIZE_STRING);

	if ($result == null) {
		$newURL="../index.php"; 
		header('Location: '.$newURL);
	}elseif($result !== false){
		// Extract email from the input
		$arrayEmails = preg_split("/[\r\n,;]+/", $result, -1, PREG_SPLIT_NO_EMPTY);

		$nb_errors=0;
		// Valide extracted inputs
		foreach ($arrayEmails as $value) {
			$value=trim($value);
			if(filter_var($value, FILTER_VALIDATE_EMAIL) === false){
				echo "The format of this email ".$value." is not valid. ";
				$nb_errors++;
			}
		}
echo "<br/> : 51";
		// Add attendees to the meeting
		if ($nb_errors == 0 && $_SESSION['user_credential']==1) {
			$meetingId = (int) $_SESSION['lastInsertM'];
			$attendeeManager->add($meetingId, $arrayEmails);	
			// redirect to index
			$newURL="../index.php"; 
			header('Location: '.$newURL);
		}else include("invit.php"); // display invit.php and error messages.
	}else echo "The format of the input is not valid."; include("invit.php");
}?>