
<html>
<head><title>Mail sender Module</title>
</head>
<body>
<?php
require_once 'swift/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
  ->setUsername('meetingplannerseven@gmail.com')
  ->setPassword('ROCOCOSTEINITZ');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Test Subject')
  ->setFrom(array('meetingplannerseven@gmail.com' => 'Ce message est un test'))
  ->setTo(array('13012556@brookes.ac.uk'))
  ->setBody("Bonjour Jean Francois je t'envoie ce mini mailbomb pour te signifier que ca marche!! <br>Tendresse, et chocolat!");


for($i=0;$i<=100;++$i) {
$result = $mailer->send($message);
}
if($result) {
echo "MESSAGE ENVOY&eacute;";
}
?>

</body>
</html>