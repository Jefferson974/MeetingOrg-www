<?php
$startTime = preg_split("/[:]+/", $result['startTime'], -1, PREG_SPLIT_NO_EMPTY);
$finishTime = preg_split("/[:]+/", value, -1, PREG_SPLIT_NO_EMPTY);
	   			$startDate = new DateTime($result['startDate']);
	   		//	$finishDate = new DateTime($result['finishDate']);
	   			$startDate->setTime((int)$startTime[0], (int)$startTime[1]);
	   			//$finishDate->setTime((int)$finishTime[0], (int)$finishTime[1]);
	   			echo "Start Date : ".$startDate->format('F j, Y, H:i ')."----<br/>";

?>