<!DOCTYPE html>
<form action="invit.php" method="POST" name="MeetingCreation">

<h2>Create Event</h2>



<label for="title">Title:</label> <input type="text" id=title name="title" required> 
<div>
<label for="startDate">Start of meeting :</label><input type="date" id="startDate" name="startDate">  <input type="time" name="startTime" id="startTime">
<label for="finishDate">End of meeting :</label><input type="date" id="finishDate" name="finishDate">  <input type="time" name="finishTime" id="finishTime">
<label for="allDay">All day:</label> <input type="checkbox" name="allDay" id="allDay">
</div>
  

<div>
<label for="repeatM" >Repeat :</label> <select id="repeatM" name="repeatM">
          <option value=“none”> none</option>
          <option value=“daily”> daily</option>
          <option value=“weekly”> weekly</option>
          <option value=“monthly”> monthly</option>
          </select>
</div>
 

<div>
Event Color: <input type="radio" name="color" value="none">
             <input type="radio" name="color" value="00FF00">
             <input type="radio" name="color" value="0000FF">
             <input type="radio" name="color" value="FFFF00">
             <input type="radio" name="color" value="00FFFF">
             <input type="radio" name="color" value="FF00FF">
             <input type="radio" name="color" value="C0C0C0">
</div>


<label for="location">Location :</label> <input type="text" name=“location” id="location">


<div>
<label for="description">Description :</label> 
<textarea id="description" name="description" cols="25" rows="5">
</textarea>
</div>
<input type="submit" value = "Next">
</form>