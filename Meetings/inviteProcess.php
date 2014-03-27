<?php

require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeeManager.class.php");  

//check the form input and user credential
 
if(isset($_SESSION['user_credential']) && !empty($_POST) && $_SESSION['user_credential']==1){
	$attendeeManager = new AttendeeManager($db);
	// Clean user input
	$result = filter_input(INPUT_POST, 'attendees' , FILTER_SANITIZE_STRING);
	if ($result == null) {
		// redirect to index without inviting people
		 $newURL="../index.php"; 
		 header('Location: '.$newURL);
	}elseif($result !== false){
		// Extract email from the input
		echo "extract<br/>";
		$arrayEmails = preg_split("/[\r\n,;]+/", $result, -1, PREG_SPLIT_NO_EMPTY);

		$nb_errors=0; $cleanedEmails = array();
		// Valide extracted inputs
		foreach ($arrayEmails as $value) {
			 
			$cleanedEmails[]=trim($value);
				 
			
			if(filter_var(trim($value), FILTER_VALIDATE_EMAIL) === false){
				echo "The format of this email ".trim($value)." is not valid. ";
				$nb_errors++;
			}
		}
 
		// Add attendees to the meeting
		if ($nb_errors == 0 && $_SESSION['user_credential']==1) {
			$meetingId =  $_SESSION['lastInsertM'];
			foreach ($meetingId as $value) {
				$attendeeManager->add((int)$value, $cleanedEmails);	
			} 
			// redirect to index
			$newURL="../index.php"; 
			header('Location: '.$newURL);
		}else include("invit.php"); // display invit.php and error messages.
	}else echo "The format of the input is not valid."; include("invit.php");
}?>