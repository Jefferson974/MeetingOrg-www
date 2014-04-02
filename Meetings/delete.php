<?php
/**     Group Project : Team 7, Meeting Organizer
  *   Author : Jean-Francois Rococo
  *   Date : 31/04/2014
  *   This page allows to delete a meeting if having the right credentials
  *
 */
require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php");    

//verify that the user is logged in and has the right credentials and that the id was provided in the adress bar.
if(isset($_SESSION['user_name']) && $_SESSION['user_credential']==1 && !empty($_GET['id'])){
	$meetingManager = new MeetingManager($db);
	$id = (int) $_GET['id'];
	$meetingManager->delete($id);
	$newURL="../index.php"; 
	 header('Location: '.$newURL);
}else{
	 echo "arguments missing or wrong form<br/>"; 
	 echo $_SESSION['user_credential']."cred<br/>";
	 echo $_GET['answer']."answer<br/>";
	 echo $_GET['id']."id<br/>";
}
?>