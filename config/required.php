<?php
/**     Group Project : Team 7, Meeting Organizer
  *   Author : Jean-Francois Rococo
  *   Date : 31/04/2014
  *   require classes to stay logged in the website.
  *   Require configuration for database
  *
 */
require_once(__DIR__.'/../Connexion/classes/Login.php');
require_once(__DIR__.'/config.php');
$db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
if(!isset($login)){
	$login = new Login(); 
}

?>