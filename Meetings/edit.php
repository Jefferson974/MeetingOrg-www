<?php

require_once(__DIR__.'/../config/required.php');
require_once(__DIR__."/../Manager/MeetingManager.class.php"); 
require_once(__DIR__."/../Manager/AttendeesMeetingManager.class.php");  

if(isset($_GET['id'])){
  $id =  $_GET[ 'id'];
  $meetingManager = new MeetingManager($db);
  $meeting = $meetingManager->get($id);
}else{
  echo "Meeting non-specified or missing";
}
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Edit a meeting</title>
</head>
<form action="editInvit.php" method="POST" name="MeetingEditing">

<h2>Edit Event</h2>



<label for="title">Title:</label> <input type="text" id="title" name="title" value=<?php echo $meeting->getTitle(); ?> required> 
<div>
<label for="startDate">Start of meeting :</label><input type="date" id="startDate" name="startDate" value=<?php echo $meeting->getStartDate(); ?> required>  <input type="time" name="startTime" id="startTime" value=<?php echo $meeting->getStartTime(); ?> required>
<label for="finishDate">End of meeting :</label><input type="date" id="finishDate" name="finishDate" value=<?php echo $meeting->getFinishDate(); ?> required>  <input type="time" name="finishTime" id="finishTime" value=<?php echo $meeting->getFinishTime(); ?> required>
<label for="allDay">All day:</label> <input type="checkbox" name="allDay" id="allDay" value="TRUE" <?php if($meeting->getAllDay()){ echo "checked=\"checked\"";}?> >
</div>
  

<div>
<label for="repeatM" >Repeat :</label> <select id="repeatM" name="repeatM">
<?php 
switch ($meeting->getRepeatM()) {
            case 'None':
            ?> <option <?php echo "selected=\"selected\"";?> value="None"> None</option>
               <option value="daily"> daily</option>
               <option value="weekly"> weekly</option>
               <option value="monthly"> monthly</option>
        <?php break;

            case 'daily': ?>
               <option value="None"> None</option>
               <option <?php echo "selected=\"selected\"";?> value="daily"> daily</option>
               <option value="weekly"> weekly</option>
               <option value="monthly"> monthly</option>
        <?php break;

            case 'weekly': ?>
               <option value="None"> None</option>
               <option <?php echo "selected=\"selected\"";?>  value="weekly"> weekly</option>
               <option value="weekly"> weekly</option>
               <option value="monthly"> monthly</option>
        <?php break;

             case 'monthly': ?>
               <option value="None"> None</option>
               <option value="daily"> daily</option>
               <option value="weekly"> weekly</option>
               <option <?php echo "selected=\"selected\"";?> value="monthly"> monthly</option>
        <?php break;
            
            default: ?>
              <option selected="selected" value="None"> none</option>
              <option value="daily"> daily</option>
              <option value="weekly"> weekly</option>
              <option value="monthly"> monthly</option>
        <?php
              break;
} ?>          
          
          </select>
</div>
 

<div>
Event Color:
<?php 
switch ($meeting->getColorM()) {
            case 'None': ?>           
             <input type="radio" name="colorM" <?php echo "checked=\"checked\"";?> value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" value="0000FF">
             <input type="radio" name="colorM" value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
             <?php break;

            case '00FF00': ?>
             <input type="radio" name="colorM" value="None">
             <input type="radio" name="colorM" <?php echo "checked=\"checked\"";?> value="00FF00">
             <input type="radio" name="colorM" value="0000FF">
             <input type="radio" name="colorM" value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
             <?php break;

            case '0000FF': ?>
              <input type="radio" name="colorM" value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" <?php echo "checked=\"checked\"";?> value="0000FF">
             <input type="radio" name="colorM" value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
             <?php break;

            case 'FFFF00': ?>
              <input type="radio" name="colorM" value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" value="0000FF"> 
             <input type="radio" name="colorM" <?php echo "checked=\"checked\"";?> value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
             <?php break;

            case '00FFFF': ?>
             <input type="radio" name="colorM" value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" value="0000FF">
             <input type="radio" name="colorM" value="FFFF00"> 
             <input type="radio" name="colorM" <?php echo "checked=\"checked\"";?> value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
             <?php break;

            case 'FF00FF': ?>
             <input type="radio" name="colorM" value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" value="0000FF">
             <input type="radio" name="colorM" value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF"> 
             <input type="radio" name="colorM" <?php echo "checked=\"checked\"";?> value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
             <?php break;

            case 'C0C0C0': ?>
            <input type="radio" name="colorM" value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" value="0000FF">
             <input type="radio" name="colorM" value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF"> 
             <input type="radio" name="colorM" <?php echo "checked=\"checked\"";?> value="C0C0C0">
            <?php break;
            
            default: ?>
            <input type="radio" name="colorM"  checked="checked"  value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" value="0000FF">
             <input type="radio" name="colorM" value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
       <?php       break;
} ?>          
</div>


<label for="place">Location :</label> <input type="text" name="place" id="place" value=<?php echo $meeting->getPlace(); ?>  required>


<div>
<label for="description">Description :</label> 
<textarea id="description" name="description" cols="25" rows="5" >
<?php echo $meeting->getDescription(); ?> 
</textarea>
</div>
<input type="submit" value = "Next">
</form>