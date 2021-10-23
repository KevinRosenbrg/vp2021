<?php	
	$database = "if21_kevin_ros";
		
	function minutes_into_hours($duration_from_db) {
		$hours = round($duration_from_db / 60);
		$minutes = $duration_from_db % 60;
		
		$time = $hours ."h" .$minutes ."min";
		
		return $time;
	}
	
	function wrong_into_correct_time($birth_date_from_db) {
		$got_birth_date = new DateTime($birth_date_from_db);
		$formated_date = $got_birth_date->format("d-m-Y");
		
		return $formated_date;
	}
?>