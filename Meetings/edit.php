<?php
/**     Group Project : Team 7, Meeting Organizer
  *   Author : Jean-Francois Rococo
  *   Date : 31/04/2014
  *   Form to edit a meeting
  *
 */
require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeeManager.class.php");  
//Verify that the user is logged on and has the right credentials
if (isset($_SESSION['user_name'])) {
   if(isset($_GET['id']) && $_SESSION['user_credential']==1){
      $id =  $_GET[ 'id'];
      $meetingManager = new MeetingManager($db);
      $meeting = $meetingManager->get($id);
      $_SESSION['idEditedMeeting'] = $id;
   }else{
      echo "Meeting non-specified or missing";
   }
}else{
  $newURL="../index.php"; 
  header('Location: '.$newURL);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" href="../css/style.css">
    <title>Edit a meeting</title>
  </head>
  <body>
    <section class="top">
        <div id="logo">   
         <a href="../index.php"><img class ="logoLogin" src="../images/logoTransparent.png" height="120px"></a>
        </div>
        <div id="loggedIn">
          <img src="../images/personIcon.png" height="20px;" >
          <p><?php echo $_SESSION['user_name'];?> | <a href="../index.php?logout">Logout</a> </p>
        </div>        
    </section>
    <section class="main">
      <div id="createMeeting">
        <h1>Edit a meeting</h1> <?php echo $meeting->getTitle(); ?>
      </div>
    </section>
    <section class="container">
      <div id="createMeetingForm"> 
        <form action="editInvit.php" method="POST" name="MeetingEditing">
          <h2>Edit Event</h2>

          <div><label for="title">Title of the meeting:</label> <input class="marginInput" type="text" id="title" name="title" value="<?php echo $meeting->getTitle(); ?>" required></div> 
          <div><label for="startDate">Start of the meeting :</label><input class="marginInput" type="date" id="startDate" name="startDate" value="<?php echo $meeting->getStartDate(); ?>"  required></div>
          <div><label for="StartTime">Time of the meeting :</label> <input type="time" name="startTime" id="startTime" value="<?php echo $meeting->getStartTime(); ?>"></div>
          <div><label for="duration">Duration of the meeting :</label> <input type="time" name="duration" id="duration" value="<?php echo $meeting->getDuration(); ?>"></div>
          <div><label for="allDay">All day:</label> <input class="marginInput" type="checkbox" name="allDay" id="allDay" value="1" <?php if($meeting->getallDay()==1)echo "checked=checked" ; ?>></div>  
          <script>
             
                  document.getElementById("allDay").onclick = function() {                      
                    if(document.getElementById("allDay").checked ) {
                       document.getElementById("startTime").disabled = true;
                       document.getElementById("duration").disabled = true;
                       document.getElementById("startTime").title = "You have disabled it, to activate it, uncheck the 'all day box'.";
                       document.getElementById("duration").title = "You have disabled it, to activate it, uncheck the 'all day box'.";                         
                    }else  if(!document.getElementById("allDay").checked) {
                       document.getElementById("startTime").disabled = false;
                       document.getElementById("duration").disabled = false;
                       document.getElementById("startTime").title = "";
                       document.getElementById("duration").title = "";
                    }
                  }

          </script>
          <div>
                <label for="repeatM" >Repeat :</label> <select class="marginInput" id="repeatM" name="repeatM">
                          <option <?php if ($meeting->getRepeatM()=="None") echo "selected=\"selected\"";?> value="None"> None</option>
                          <option <?php if ($meeting->getRepeatM()=="Daily") echo "selected=\"selected\"";?>value="Daily"> Daily</option>
                          <option <?php if ($meeting->getRepeatM()=="Weekly") echo "selected=\"selected\"";?>value="Weekly"> Weekly</option>
                          <option <?php if ($meeting->getRepeatM()=="Monthly") echo "selected=\"selected\"";?>value="Monthly"> Monthly</option>
                          </select>
                <label for="times"> times :</label><input type="number" name="repeatMTimes" value=<?php echo $meeting->getTitle(); ?> id="times" min="0">
          </div>       
          <div>
                Event Color:
                <select name="colorM">

                            <option name="colorM"   style="background:white" <?php if ($meeting->getColorM()=="None")echo "selected=\"selected\"";?> value="None">None</option>
                            <option name="colorM"   style="background:#00FF13" <?php if ($meeting->getColorM()=="00FF13")echo "selected=\"selected\"";?> value="00FF13">Green</option>
                            <option name="colorM"   style="background:#CE7EED" <?php if ($meeting->getColorM()=="CE7EED")echo "selected=\"selected\"";?> value="CE7EED">Violet</option>
                            <option name="colorM"   style="background:#F73B7A" <?php if ($meeting->getColorM()=="F73B7A")echo "selected=\"selected\"";?> value="F73B7A">Pink</option>
                            <option name="colorM"   style="background:#FFA700" <?php if ($meeting->getColorM()=="FFA700")echo "selected=\"selected\"";?> value="FFA700">Orange</option>
                            <option name="colorM"   style="background:#FFFF8A" <?php if ($meeting->getColorM()=="FFFF8A")echo "selected=\"selected\"";?> value="FFFF8A">Yellow</option>
                            <option name="colorM"   style="background:#B5B5B5" <?php if ($meeting->getColorM()=="B5B5B5")echo "selected=\"selected\"";?> value="B5B5B5">Grey</option>
                </select>
          </div>
        
          <label for="place">Location :</label> <input type="text" name="place" id="place" value="<?php echo $meeting->getPlace(); ?>"  required>

          <div>
            <label for="description">Description :</label> 
            <textarea id="description" name="description" cols="25" rows="5" >
            <?php echo $meeting->getDescription(); ?> 
            </textarea>
          </div>

          <input type="submit" value ="Next" name="edit_submit">

        </form>
      <div/>
    <section/>
  </body>
</html>