
<?php
require_once (__DIR__.'/../swift/lib/swift_required.php');


//Sends email to the different guests
function sendMails($listmail, $meeting) {

//Connects to the SMTP server
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
  ->setUsername('meetingplannerseven@gmail.com')
  ->setPassword('ROCOCOSTEINITZ');


$mailer = Swift_Mailer::newInstance($transport);
//listedesinvite + objet meeting.
$message = Swift_Message::newInstance('Invitation to a university event.')
  ->setFrom(array('meetingplannerseven@gmail.com' => 'INVITATION'))
  ->setTo($listmail)
  ->setBody("Dear Student, <br> you have been invited to the event..<br><br><br><br>".$meeting->getTitle()."<br><br>Date:".$meeting->getStartDate()."<br><br><br>Place: ".$meeting->getPlace()."<br><br><br>Duration:".$meeting->getPlace() );


//send the e-mails
$result = $mailer->send($message);




if($result) {
echo "Message Sent";
}

}
?>

