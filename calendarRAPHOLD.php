<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
<?php require_once("Manager/MeetingManager.class.php");
  require_once("config/config.php"); 
   require_once("config/required.php"); 
  require_once("Manager/AttendeesMeetingManager.class.php"); ?>
<?php 

$db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);



//NEED TO IMPORT THE SESSION HERE<=== PROBLEM
// SO I CREATE ARTIFICIALLY THE SESSION FROM HERE
$_SESSION['user_mail'] = "j-f.luciano@hotmail.com";
$managerObject = new MeetingManager($db);
if(isset($_SESSION['user_mail'])) {
$userMail = $_SESSION['user_mail'];
echo "Calendar display of user name==>".$userMail."<==|";
$attendeeList = new AttendeesMeetingManager($db);
$listMeetingsId= $attendeeList->getMeetingsIdByEmailA($userMail);
 $listMeetings = $managerObject->getListByAttendees($listMeetingsId);
 $mm = $listMeetings;
 echo $mm[0];
    }  
    $db = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $q = $db->prepare('SELECT meeting_id FROM jnct_users_meetings WHERE user_email ="j-f.luciano@hotmail.com"');
    $q->execute();
    $result = $q->fetchAll(PDO::FETCH_COLUMN, 0);
    echo " result ->" . $result[2]." <-fin de result .";
     
?>
<!-- This script loads the calendar -->


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Meeting Organizer</title>
  <link rel="stylesheet" href="css/style.css">
  

  <!--CALENDAR HEAD TAG ELEMENTS -->
 <link rel='stylesheet' href='fullcalendar/fullcalendar.css' />
<script src='lib/jquery.min.js'></script>
<script src='lib/moment.min.js'></script>
<script src='fullcalendar/fullcalendar.js'></script>
<script>
$(document).ready(function() {



    // page is now ready, initialize the calendar...
    $('#calendarFields').fullCalendar({
        // put your options and callbacks here



 	
 aspectRatio:1.2,
  


	header:
	{
	    left:   'title',
	    center: 'agendaDay agendaWeek month',
	    right:  'today prev,next'
	},

// PART OF THE CODE THAT DISPLAY THE EVENTS

 eventSources: [{

    events: [ 
        {
            title  : 'event1',
            start  : '2010-01-01'
        }
         <?php 
if(isset($listMeetings)) {
foreach($listMeetings as $throughMeetings) {
echo ",{
  title:". $throughMeetings->getTitle()."
  start :". $throughMeetings->getStartDate().",
  end:". $throughMeetings->getFinishDate().",
  color:". $throughMeetings->getColorM()."}";
}
} else {
  echo "{
  title : 'BUG THE VAR DOES NOT COME HRE',
  start : '2014-03-22',
  end : '2014-03-22' 
  } ";
   }
   
  ?>
       , {
            title  : 'event2',
            start  : '2014-03-20',
            end    : '2014-03-22'
        },
        {
            title  : 'event3',
            start  : '2014-03-01 12:30:00',
            allDay : false // will make the time show
        }
    ],   color: 'black',     // an option!
            textColor: 'yellow'

}]


    //end  of Calendar initializer
    })
//end  of page initialized event
});

</script>



</head>
<body>
	<section class="top">
		<div id="logo">		
			<img class ="logoLogin" src="images/logo transparent.png" height="120px">
		</div>
		<div id="loggedIn">
			<img src="images/personIcon.png" height="20px;" >
			<p>firstName | <a href="">Logout</a> </p>
		</div>
		
	</section>
	<section class="main">
	<div id="createMeeting">
			<h1><a href="">Create Meeting</a> </h1>
		</div>
		<div id="calendar">
			<h1><a href="">Calendar</a> </h1>
		</div>
		<div id="meetings">
			<h1><a href="">Meetings </a></h1>
			<ul>
				<li><a href="">Sample Meeting 1</a></li>
				<li><a href="">Sample Meeting 2</a></li>
				<li><a href="">Sample Meeting 3</a></li>
				<li><a href="">Sample Meeting 4</a></li>			
			</ul>
		</div>
	</section>
  <section class="container">

 <div id="calendarFields">

<?php 
if (isset($listMeetings)) 
{
echo "First meeting==> ".$listMeetings[0];
}
else {
  echo "fuck";
}


 ?>


  </div>
  <div style="text-align:center;">
  <p>
  &nbsp;</br>
  &nbsp;</br>2014 Meeting Organizer ©</p>
  </div>

  </section>
<div id='calendar'></div>
</body>
</html>