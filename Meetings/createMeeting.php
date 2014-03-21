<!DOCTYPE html>
<form action="invitation.php" method="POST">

<b>Create Event</b>



Title: <input type="text" id=title name="Title"> Private:<input type="checkbox"> 

<div>
Time:<input type="date" id=startDate>  <input type="time" id=startTime>
    <input type="date" id=finishDate>  <input type="time" id=finsihTime>

All day:<input type="checkbox" id=allDay>
</div>


<div>
Repeats: <select id=repeats>
          <option value=“none”> none</option>
          <option value=“daily”> daily</option>
          <option value=“weekly”> weekly</option>
          <option value=“monthly”> monthly</option>
          </select>
</div>
 

<div>
Event Color: <input type="radio" value=FF0000>
             <input type="radio" value=00FF00>
             <input type="radio" value=0000FF>
             <input type="radio" value=FFFF00>
             <input type="radio" value=00FFFF>
             <input type="radio" value=FF00FF>
             <input type="radio" value=C0C0C0>
</div>


Location:  <input type="text" name=“Location” id=location>


<div>
Description: 
<textarea name=“description” cols="25" rows="5">
</textarea>
</div>
</form>