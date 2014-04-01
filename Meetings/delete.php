<?php
require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php");    


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