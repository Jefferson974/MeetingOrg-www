<?php

require_once(__DIR__.'/../Connexion/classes/Login.php');
require_once(__DIR__.'/config.php');
$db = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
$login = new Login(); 

?>