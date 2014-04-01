<?php

require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeeManager.class.php");  
require_once(__DIR__.'/mailsender.php');

//check the form input and user credential 
if(isset($_SESSION['user_credential']) && !empty($_POST['invite_submit']) && $_SESSION['user_credential']==1){
	$attendeeManager = new AttendeeManager($db);
	$meetingManager  = new MeetingManager($db);

	// Clean user input 
	$result = filter_input(INPUT_POST, 'attendees' , FILTER_SANITIZE_STRING);
	if ($result == null) {
		// redirect to index without inviting people
		 $newURL="../index.php"; 
		 header('Location: '.$newURL);
	}elseif($result !== false){
		// Extract email from the input
		$arrayEmails = preg_split("/[\r\n,;]+/", $result, -1, PREG_SPLIT_NO_EMPTY);

		$nb_errors=0; $cleanedEmails = array();
		// Valide extracted inputs 
		foreach ($arrayEmails as $value) { 
			if (trim($value)!=null)	{  
				if(filter_var(trim($value), FILTER_VALIDATE_EMAIL) === false){
					echo "The format of this email ".trim($value)." is not valid. ";
					$nb_errors++;
				}else $cleanedEmails[]=trim($value);	
			}
		} 

		if ($nb_errors == 0 && $_SESSION['user_credential']==1) {
			$meetingId =  $_SESSION['lastInsertM'];

			foreach($meetingId as $value) { 
				$attendeeManager->add((int)$value, $cleanedEmails);	
			} 
			$firstMeeting = $meetingManager->get($meetingId[0]);
			sendMails($cleanedEmails, $firstMeeting);

			// redirect to index
			$newURL="../index.php"; 
			header('Location: '.$newURL);
		} 
	}else echo "The format of the input is not valid."; //	include("invit.php");

}elseif(isset($_SESSION['user_name']) && isset($_GET['answer']) && !empty($_GET['id'])){
	$attendeeManager = new AttendeeManager($db);
	$answer = filter_input(INPUT_GET, 'answer' , FILTER_SANITIZE_NUMBER_INT);
	$id =  filter_input(INPUT_GET, 'id' , FILTER_SANITIZE_NUMBER_INT);
	$attendeeManager->setAnswer($id, $_SESSION['user_email'], $answer); 
	$newURL="../index.php"; 
	 header('Location: '.$newURL);
}else{
	 echo "arguments missing or wrong form<br/>"; 
	 echo $_SESSION['user_credential']."cred<br/>";
	 echo $_GET['answer']."answer<br/>";
	 echo $_GET['id']."id<br/>";

}
?>
<html>
<body>
	
</body>
</html>

