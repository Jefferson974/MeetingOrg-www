<?php

require_once(__DIR__.'/../config/required.php');

     
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="../css/style.css">
  <title>Create a meeting</title>
</head>
<body>
<form action="invit.php" method="POST" name="create">
<section class="container">
<div id="createMeetingForm"> 
<h2>Create Event</h2>



<label for="title">Title of the meeting:</label> <input class="marginInput" type="text" id="title" name="title" required> 
<div>
<div><label for="startDate">Start of the meeting :</label><input class="marginInput" type="date" id="startDate" name="startDate" required>  <input type="time" name="startTime" id="startTime" required></div>
<div><label for="finishDate">End of the meeting :</label><input class="marginInput" type="date" id="finishDate" name="finishDate" required>  <input type="time" name="finishTime" id="finishTime" required></div>
<label for="allDay">All day:</label> <input class="marginInput" type="checkbox" name="allDay" id="allDay" value="TRUE">
</div>
  

<div>
<label for="repeatM" >Repeat :</label> <select class="marginInput" id="repeatM" name="repeatM">
          <option selected="selected" value="None"> none</option>
          <option value="daily"> daily</option>
          <option value="weekly"> weekly</option>
          <option value="monthly"> monthly</option>
          </select>
</div>
 

<div>
Event Color: <input class="marginInput" type="radio" name="colorM"  checked="checked"  value="None">
             <input type="radio" name="colorM" value="00FF00">
             <input type="radio" name="colorM" value="0000FF">
             <input type="radio" name="colorM" value="FFFF00">
             <input type="radio" name="colorM" value="00FFFF">
             <input type="radio" name="colorM" value="FF00FF">
             <input type="radio" name="colorM" value="C0C0C0">
</div>


<label for="location">Location :</label> <input class="marginInput" type="text" name="place" id="location" required>


<div>
<label for="description">Description :</label> 
<textarea class="marginInput" id="description" name="description" cols="25" rows="5">
</textarea>
</div>
<input type="submit" value = "Next">
</form>
</div>
</section>	
</body>