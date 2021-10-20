<?php	
	$database = "if21_kevin_ros";
	
	function save_movie($movie_input, $production_year_input, $duration_input, $description_input) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO movie (title, production_year, duration, description) values(?,?,?,?)");
		echo $conn->error;
		$stmt->bind_param("siis", $movie_input, $production_year_input, $duration_input, $description_input);
		$success = null;
		if($stmt->execute()) {
			$success = "Salvestamine õnnestus";
		}
		else {
			$success = "Salvestamisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $success;
	}
	
	function save_genre($genre_input, $genre_description_input) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO genre (genre_name, description) values(?,?)");
		echo $conn->error;
		$stmt->bind_param("ss", $genre_input, $genre_description_input);
		$success = null;
		if($stmt->execute()) {
			$success = "Salvestamine õnnestus";
		}
		else {
			$success = "Salvestamisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $success;
	}
	
	function save_position($position_input, $position_description_input) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO position (position_name, description) values(?,?)");
		echo $conn->error;
		$stmt->bind_param("ss", $position_input, $position_description_input);
		$success = null;
		if($stmt->execute()) {
			$success = "Salvestamine õnnestus";
		}
		else {
			$success = "Salvestamisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $success;
	}
?>