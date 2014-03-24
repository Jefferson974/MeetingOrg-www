<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
<style>
    .black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 25%;
        left: 25%;
        width: 50%;
        height: 50%;
        padding: 16px;
        border: 16px solid #0CA3D2;
        background-color: white;
        z-index:1002;
        overflow: auto;
    }

</style>
<?php 
/*echo "----------user_name :". $_SESSION['user_name']."<br/>";
echo "----------user_email :". $_SESSION['user_email']."<br/>" ;
echo "----------user_credential:". $_SESSION['user_credential']."<br/>" ;  */
include('config/required.php');
include('Manager/MeetingManager.class.php');
include('Manager/AttendeesMeetingManager.class.php');

$managerObject = new MeetingManager($db);
$_SESSION['user_mail'] = "test@test.com";
if(isset($_SESSION['user_mail'])) {
$userMail = $_SESSION['user_mail'];
$attendeeList = new AttendeesMeetingManager($db);
$listMeetingsId= $attendeeList->getMeetingsIdByEmailA($userMail);
$listMeetings = $managerObject->getListByAttendees($listMeetingsId);
    }  
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



$( window ).load(function() {



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
   <?php  
foreach($listMeetings as $throughMeetings) 
{
  echo 
  "
{
     id :         '" .$throughMeetings->getId()          ."',
     title :      '" .$throughMeetings->getTitle()       ."',
     start :      '" .$throughMeetings->getStartDate()   ." ".$throughMeetings->getStartTime() ."',
     end   :      '" .$throughMeetings->getFinishDate()  ." ".$throughMeetings->getFinishTime()."',
     allDay :     '" .$throughMeetings->getAllDay()      ."',
     description :'" .$throughMeetings->getDescription() ."',
     place :      '" .$throughMeetings->getPlace()       ."',
     organizerId: '" .$throughMeetings->getOrganizerId() ."',
     duration :   '" .$throughMeetings->getDuration()       ."',
     repeated :   '" .$throughMeetings->getRepeatM()     ."',
     color    :   '" .$throughMeetings->getColorM()      ."'

},
  ";

}


?>
     
    ],   color: 'black',     // an option!
            textColor: 'yellow'
}],

//Management of the click events.
 eventClick: function(calEvent, jsEvent, view) {

document.getElementById('light').style.display='block';
document.getElementById('fade').style.display='block';
var inText= "";
 inText += "<div>ID of the event : "+calEvent.id+"</div>";
 inText += "<div>Name of the event : "+calEvent.title+"</div>";
 inText += "<div>Day of the event : "+calEvent.start+"</div>";
 inText += "<div>Day when event ends : "+calEvent.end+"</div>";
 inText += "<div>All day : "+calEvent.allDay+"</div>";
 inText += "<div>Description : "+calEvent.description+"</div>";
 inText += "<div>Place : "+calEvent.place+"</div>";
 inText += "<div>Organizer ID : "+calEvent.organizerId+"</div>";
 inText += "<div>Duration : "+calEvent.duration+"</div>";
 inText += "<div>Repeated : "+calEvent.getRepeatM+"</div>";

document.getElementById('light').innerHTML=inText;


  document.getElementById('light').onclick = function() {
  document.getElementById('light').style.display='none';
  document.getElementById('fade').style.display='none';
}
 document.getElementById('fade').onclick = function() {
  document.getElementById('light').style.display='none';
  document.getElementById('fade').style.display='none';
}

        // change the border color just for fun
        $(this).css('border-color', '#B1A0BA');
        
    }



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






//Attempt to put a layer on each click with this:

    <p>This is the main content. To display a lightbox click <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">here</a></p>
    <div id="light" class="white_content">This is the lightbox content. <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
    <div id="fade" class="black_overlay"></div>





  </div>
  <div style="text-align:center;">
  <p>
  &nbsp;</br>
  &nbsp;</br>2014 Meeting Organizer ©</p>
  </div>

  </section>
<div id='calendar'></div>

<script>

function close(){
document.getElementById('fade').onmouse
document.getElementById('light').style.display='block';
document.getElementById('fade').style.display='block';
}

</script>

</body>
</html>


