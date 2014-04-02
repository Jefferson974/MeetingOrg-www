<?php
/**     Group Project : Team 7, Meeting Organizer
  *   Author : Raphael Steinitz
  *   Date : 31/04/2014
  *   This page display a table with all the responses from the attendees.
  *
 */
?>
<html>
<head>
</head>
<body bgcolor="#0CA3D2">
This table display all the organizer planned meetings:<br><br>
<table border="1">

  <?php 
  // echo "----------user_name :". $_SESSION['user_name']."<br/>";
  // echo "----------user_email :". $_SESSION['user_email']."<br/>" ;
  // echo "----------user_credential:". $_SESSION['user_credential']."<br/>" ;  
  require_once('config/required.php');
  require_once('Manager/MeetingManager.class.php');
  require_once('Manager/AttendeeManager.class.php');

  //echo "string";
  if(isset($_SESSION['user_name']) && $_SESSION['user_credential']==1 && !empty($_GET['id'])) {
      $userMail = $_SESSION['user_email']; 
      $meetingId= $_GET['id'];
       
      $attendeeManager = new AttendeeManager($db);
      $listEmail = $attendeeManager->getEmailsByMeetingId($meetingId);



        //$listMeetings = array_merge((array)$listMeetings, (array)$listMeetingsByOrg);
echo "<tr><th width='25'>ID of Meeting</th> <th width='25'>Email</th><th>Answer</th></tr>";

       foreach( $listEmail as $value) 
        {
        	$answerResult = $attendeeManager->getAnswer($meetingId, $value);
              if ($answerResult[0]==0) { 
                $answer = "No";
              }elseif ($answerResult[0]==1){
                $answer = "Yes";
              }else $answer = "";

        	echo '<tr><td>ID: '.$meetingId.'</td>';
        	echo '<td>'.$value.'</td>' ;
        	echo '<td>'.$answer.'</td>';
        }

  
      
 } 
  ?>
</table>
<a href="javascript: history.go(-1)">Back</a>
</body>
</html>