<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
<?php 
echo "----------user_name :". $_SESSION['user_name']."<br/>";
echo "----------user_email :". $_SESSION['user_email']."<br/>" ;
echo "----------user_credential:". $_SESSION['user_credential']."<br/>" ;  
include('config/required.php');
include('Manager/MeetingManager.class.php');
include('Manager/AttendeesMeetingManager.class.php');

$managerObject = new MeetingManager($db);
$_SESSION['user_mail'] = 'test@test.com';
if(isset($_SESSION['user_mail'])) {
$userMail = $_SESSION['user_mail'];
echo "Calendar display of user name==>".$userMail."<==|";
$attendeeList = new AttendeesMeetingManager($db);
$listMeetingsId= $attendeeList->getMeetingsIdByEmailA($userMail);
echo "\n <br>List meeting item :".$listMeetingsId." ";
/* $listMeetings = $managerObject->getListByAttendees($listMeetingsId);
 $mm = $listMeetings;
 echo $mm[0];*/
    }  
     
$db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "<br> <br> TESTING PURPOSES";
     echo "\n";
     $q = $db->prepare('SELECT meeting_id FROM jnct_users_meetings WHERE user_email ="test@test.com"');
     $q->execute();
     $result = $q->fetchAll();
     echo $result[0][0];
?>


<!-- This script loads the calendar -->


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Meeting Organizer</title>
  <link rel="stylesheet" href="css/style.css">
  

  <!--CALENDAR HEAD TAG ELEMENTS -->
 <link rel='stylesheet' href='Calendar/fullcalendar.css' />
<script src='lib/jquery.min.js'></script>
<script src='lib/moment.min.js'></script>
<script src='Calendar/fullcalendar.js'></script>
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
        },
       
        {
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
			<img class ="logoLogin" src="images/logoTransparent.png" height="120px">
		</div>
		<div id="loggedIn">
			<img src="images/personIcon.png" height="20px;" >
			<p><?php echo $_SESSION['user_name'];?> | <a href="index.php?logout">Logout</a> </p>
		</div>
		
	</section>
	<section class="main">
	<div id="createMeeting">
			<h1><a href="Meetings/create.php">Create Meeting</a> </h1>
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


