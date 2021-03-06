<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
 <?php
/**     Group Project : Team 7, Meeting Organizer
  *   Authors : Raphael Steinitz, Jean-Francois Rococo
  *   Date : 31/04/2014
  *   This Page displays the calendar with both PHP and JS.
  *
 */
 ?>
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
          border-radius: 5px;
      }
  </style>

  <?php 
 
  require_once('config/required.php');
  require_once('Manager/MeetingManager.class.php');
  require_once('Manager/AttendeeManager.class.php');

  //echo "string";
  if(isset($_SESSION['user_email'])) {
      $userMail = $_SESSION['user_email']; 

      $meetingManager = new MeetingManager($db);
      $attendeeManager = new AttendeeManager($db);
      $listMeetingsId= $attendeeManager->getMeetingsIdByEmailA($userMail);
      $listMeetings = $meetingManager->getListByAttendee($listMeetingsId);
      if ($_SESSION['user_credential']) {
        $userId = $_SESSION['user_id'];
        $listMeetingsByOrg = $meetingManager->getListByOrg($userId);
        $listMeetings = array_merge((array)$listMeetings, (array)$listMeetingsByOrg);
      }
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

          foreach($listMeetings as $value){
            if($value->getOrganizerId()==$_SESSION['user_id']){
              $edit = "FALSE";
              $answer = "";
            }else{
              $edit = "TRUE";
              $answerResult = $attendeeManager->getAnswer($value->getId(), $_SESSION['user_email']);
              if ($answerResult[0]==0) { 
                $answer = "FALSE";
              }elseif ($answerResult[0]==1){
                $answer = "TRUE";
              }else $answer = "";
           } 
            $time = preg_split("/[:]+/", $value->getStartTime(), -1, PREG_SPLIT_NO_EMPTY); 

            $startDate = new DateTime($value->getStartDate());    
            
            if($time!=null){
            $startDate->setTime((int)$time[0], (int)$time[1]);             
             }
              if ($value->getAllDay()==0) { 
                $allDay = "false";
              }elseif ($value->getAllDay()==1){
                $allDay = "true";
              }else $allDay = "";

            echo 
                "
              {
                   id :         '" .$value->getId()          ."',
                   title :      '" .$value->getTitle()      ."',
                   start :      '" .$startDate->format('c')."',
                   end :        '" .$value->getFinishDate()  ."',
                   allDay :     " .$allDay      .",
                   description :'" .$value->getDescription() ."',
                   place :      '" .$value->getPlace()       ."',
                   organizerId: '" .$value->getOrganizerId() ."',
                   duration :   '" .$value->getDuration()    ."',
                   repeated :   '" .$value->getRepeatM()     ."',
                   color    :   '" .$value->getColorM()      ."',
                   edit     :   '" .$edit."',
                   answer   :   '" .$answer."',
                  
          
                   textColor: 'black',
                   backgroundColor    :   '" .'#'.$value->getColorM()      ."',
              },
                ";
             //  $test = $startTime->format('d-m-Y G:i');
          }
           
        ?>
         
        ]
        }],
 
      //Management of the click events.
      eventClick: function(calEvent, jsEvent, view) {

        document.getElementById('light').style.display='block';
        document.getElementById('fade').style.display='block';
        document.getElementById('light').style.borderColor="#"+calEvent.color;
        var inText= ""; 
        inText += "<div>Name of the event : "+calEvent.title+"</div>";
        inText += "<div>Day of the event : "+calEvent.start.format('MMMM Do YYYY, h:mm:ss a')+"</div>";
        inText += "<div>Day when event ends : "+calEvent.end.format('MMMM Do YYYY, h:mm:ss a');+"</div>";
        inText += "<div>All day : "+calEvent.allDay+"</div>";
        inText += "<div>Description : "+calEvent.description+"</div>";
        inText += "<div>Place : "+calEvent.place+"</div>"; 
        inText += "<div>Duration : "+calEvent.duration+"</div>";
        inText += "<div>Repeated : "+calEvent.repeated+"</div>"; 
    
        if (calEvent.edit=='FALSE') {
        inText += "<div><a href=Meetings/edit.php?id="+calEvent.id+"> Edit meeting <a/></div>";
        inText += "<div><a href=Meetings/delete.php?id="+calEvent.id+"> Delete meeting <a/></div>";
        inText += "<div><h1><a href='admintable.php?id="+calEvent.id+"'>Guest list</a> </h1></div>";  

        }else if(calEvent.edit=='TRUE'){
            if(calEvent.answer=='FALSE'){ 
            inText += "<div>Going ?<a href=\'Meetings/inviteProcess.php?answer=1&id="+calEvent.id+"\'>Yes &nbsp</a>";
            inText += "|&nbsp No</div>";
            }else if(calEvent.answer=='TRUE'){
             inText += "<div>Going ?Yes &nbsp" ;
             inText += "|&nbsp<a href=\'Meetings/inviteProcess.php?answer=0&id="+calEvent.id+"\'>No</a></div>";
            }

         }


        //inText += "|&nbsp<a href=\'Meetings/inviteProcess.php?answer=0&id="+calEvent.id+"\'>No<a/></div>";

      
         
        document.getElementById('light').innerHTML=inText;

        document.getElementById('light').onclick = function() {
          document.getElementById('light').style.display='none';
          document.getElementById('fade').style.display='none';

        }
        document.getElementById('fade').onclick = function() {
          document.getElementById('light').style.display='none';
          document.getElementById('fade').style.display='none';
        }

        // change the border color
        $(this).css('border-color', '#'+calEvent.color);
             
      }
      //end  of Calendar initializer
    })
  //end  of page initialized event
  }
  );
  </script>



</head>
<body>
	<section class="top">
		<div id="logo">		
		<a href="index.php"><img class ="logoLogin" src="images/logoTransparent.png" height="120px"></a>
		</div>
		<div id="loggedIn">
			<img src="images/personIcon.png" height="20px;" >
			<p><?php echo $_SESSION['user_name'];?> | <a href="index.php?logout">Logout</a> </p>
		</div>
		
	</section>
	<section class="main">
	<div id="createMeeting">
      <?php
      if (isset($_SESSION['user_credential'])){
        if($_SESSION['user_credential'] == 1){
          echo "<h1><a href='Meetings/create.php'>Create Meeting</a> </h1>";
        }
      }
	    ?>
  	</div>
		<div id="calendar">
			<h1><a href="">Calendar</a> </h1>
		</div>
		 
	</section>
  <section class="container">
     <div id="calendarFields">
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


