<?php
	function save_image ($image, $file_type, $target) {
		$notice = null;
		if ($file_type == "jpg") {
			if (imagejpeg($image, $target, 90)){
				$notice = "Vähendatud pildi salvestamine õnnestus.";
			}
			else {
				$notice = "Vähendatud pildi salvestamisel tekkis tõrge!";
			}
		}
		if ($file_type == "png") {
			if (imagepng($image, $target, 6)){
				$notice = "Vähendatud pildi salvestamine õnnestus.";
			}
			else {
				$notice = "Vähendatud pildi salvestamisel tekkis tõrge!";
			}
		}
		if ($file_type == "gif") {
			if (imagegif($image, $target)){
				$notice = "Vähendatud pildi salvestamine õnnestus.";
			}
			else {
				$notice = "Vähendatud pildi salvestamisel tekkis tõrge!";
			}
		}
		return $notice;
	}
	
	function photo_resizer ($my_temp_image, $new_width, $new_height) {
		$notice = null;
		
		//loome uue pikslikogumi
		$my_new_temp_image = imagecreatetruecolor($new_width, $new_height);		
		//kopeerime vajalikud pikslid uude objekti
		$notice = imagecopyresampled($my_new_temp_image, $my_temp_image, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height);
		
		return $notice;
		
	}
?>