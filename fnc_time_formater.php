<?php	
	$database = "if21_kevin_ros";
		
	function minutes_into_hours($duration_from_db) {
		$hours = floor($duration_from_db / 60);
		$minutes = $duration_from_db % 60;
		
		$time = $hours ."h" .$minutes ."min";
		
		return $time;
	}
	
	function wrong_into_correct_time($unformated_date) {
		$formate_date = new DateTime($unformated_date);
		$formated_date = $formate_date->format("d.m.Y");
		
		return $formated_date;
	}
?>