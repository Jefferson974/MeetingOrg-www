<?php

<?php
 require_once("Manager/required.php"); 
$attMeetManager = new AttendeesMeetingManager($db);
$result = filter_var($_POST['attendees']);
$arrayEmails = preg_split("/[\r\n,;]+/", $result, -1, PREG_SPLIT_NO_EMPTY);
$nb_errors=0;
foreach ($arrayEmails as $value) {
	if(filter_var($value, FILTER_VALIDATE_EMAIL)  !== false){
		echo "The format of this email ".$value." is not valid.";
		$nb_errors++;
	}
}
if ($nb_errors == 0 && $_SESSION['user_credential']==1) {
	$meetingId = (int) $_SESSION['lastInsertM'];
	$attMeetManager->add($meetingId, $arrayEmails);	
}
$newURL="calendar.php"; 
header('Location: '.$newURL);


?>