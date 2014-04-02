<?php
/**     Group Project : Team 7, Meeting Organizer
  *   Author : Raphael Steinitz
  *   Date : 31/04/2014
  *   This module allows to send e-mail through SMTP.
  *
 */
require_once (__DIR__.'/../swift/lib/swift_required.php');



function sendMails($listmail, $meeting) {


$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
  ->setUsername('meetingplannerseven@gmail.com')
  ->setPassword('ROCOCOSTEINITZ');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Invitation to a university event.')
  ->setFrom(array('meetingplannerseven@gmail.com' => 'INVITATION'))
  ->setTo($listmail)
  ->setBody("Dear Student, <br> <br>you have been invited to an event through the Meeting Organizer Portal<br><br><br><br>
  	Title :<b>".$meeting->getTitle()."</b><br><font color=\"red\">
  	Date:<b>".$meeting->getStartDate()."</font></b><br>Place: ".$meeting->getPlace()."<br>
  	Duration:<b>".$meeting->getDuration()."</b><br> 
  	<br><i>Please login to the Meeting Organizer Portal in order to confirm weather you are coming or not.<br> Click here to log on to the portal : 
  	<a href=\"http://localhost/MeetingOrg-www/ \">Click here</a> or copy the following link to your internet browser : \"http://localhost/MeetingOrg-www/\"</i> 
  	<br><br><br><br><br><h4>Please do not answer to this e-mail.</h4><br><br><h7>Group Seven, Meeting Organizer Community</h7>", 'text/html' );



$result = $mailer->send($message);


}
?>

