<?php
require_once("config/config.php"); 
require_once("Manager/MeetingManager.class.php"); 
require_once("Manager/AttendeesMeetingManager.class.php"); 
$db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

?>