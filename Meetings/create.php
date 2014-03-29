<?php
require_once(__DIR__.'/../config/required.php');
if(isset($_SESSION['user_name'])){
  if($_SESSION['user_credential'] != 1){
      $newURL="../index.php"; 
      header('Location: '.$newURL);
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
    <title>Create a meeting</title>
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
        <h1>Create a meeting</h1>
      </div>
    </section>
    <section class="container">
      <div id="createMeetingForm"> 
            <form action="invit.php" method="POST" name="create">

              <div><label for="title">Title of the meeting:</label> <input  type="text" id="title" name="title" required></div>
              
              <div><label for="startDate">Start of the meeting :</label><input  type="date" id="startDate" name="startDate" required></div>
              <div><label for="StartTime">Time of the meeting :</label> <input type="time" name="startTime" id="startTime"></div>
              <div><label for="duration">Duration of the meeting :</label> <input type="time" name="duration" id="duration"></div>
              <div><label for="allDay">All day:</label> <input  type="checkbox" name="allDay" id="allDay" value="1"></div>
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
                <label for="repeatM" >Repeat :</label> <select  id="repeatM" name="repeatM">
                          <option selected="selected" value="None"> none</option>
                          <option value="Daily"> daily</option>
                          <option value="Weekly"> weekly</option>
                          <option value="Monthly"> monthly</option>
                          </select>
                <label for="times"> times :</label><input type="number" name="repeatMTimes" id="times" min="0">
              </div>
               

              <div>
                Event Color: <select name="colorM">

                            <option name="colorM"   style="background:white" selected="selected" value="None">None</option>
                            <option name="colorM"   style="background:#00FF13" value="00FF13">Green</option>
                            <option name="colorM"   style="background:#CE7EED" value="CE7EED">Violet</option>
                            <option name="colorM"   style="background:#F73B7A" value="F73B7A">Pink</option>
                            <option name="colorM"   style="background:#59474D" value="59474D">Dark Violet</option>
                            <option name="colorM"   style="background:#FFB01C" value="FFB01C">Orange</option>
                            <option name="colorM"   style="background:#000000" value="000000">Black</option>
             </select>

              </div>


              <div><label for="location">Location :</label> <input  type="text" name="place" id="location" required></div>


              <div>
                <label for="description">Description :</label> 
                <textarea  id="description" name="description" cols="25" rows="5">
                </textarea>
              </div>
              <div><input type="submit" value="Next" name="create_submit"></div>
            </form>
      </div>
    </section>	
  </body>
</html>