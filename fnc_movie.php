<?php	
	$database = "if21_kevin_ros";
	
	function read_all_person($selected) {
		$html = null;
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		//<option value="x" selected>Eesnimi Perekonnanimi</option>
		$stmt = $conn->prepare("SELECT id, first_name, last_name, birth_date FROM person");
		$stmt->bind_result($id_from_db, $first_name_from_db, $last_name_from_db, $birth_date_from_db);
		$stmt->execute();
		while($stmt->fetch()) {
			$html .= '<option value="' .$id_from_db .'"';
			if($selected == $id_from_db) {
				$html .= " selected";
			}
			$html .= ">" .$first_name_from_db ." " .$last_name_from_db ." (" .$birth_date_from_db .")" ."</option> \n";
		}
		
		echo $conn->error;
		
		$stmt->close();
		$conn->close();
		return $html;
	}
	
	function read_all_movie($selected) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT id, title, production_year FROM movie");
		$stmt->bind_result($id_from_db, $title_from_db, $production_year_from_db);
		$stmt->execute();
		while($stmt->fetch()) {
			$html .= '<option value="' .$id_from_db .'"';
			if($selected == $id_from_db) {
				$html .= " selected";
			}
			$html .= ">" .$title_from_db ." " ." (" .$production_year_from_db .")" ."</option> \n";
		}
		
		echo $conn->error;
		
		$stmt->close();
		$conn->close();
		return $html;
		
	}
	
	function read_all_position($selected) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT id, position_name FROM position");
		$stmt->bind_result($id_from_db, $position_from_db);
		$stmt->execute();
		while($stmt->fetch()) {
			$html .= '<option value="' .$id_from_db .'"';
			if($selected == $id_from_db) {
				$html .= " selected";
			}
			$html .= ">" .$position_from_db ."</option> \n";
		}
		
		echo $conn->error;
		
		$stmt->close();
		$conn->close();
		return $html;
	}
	
	function store_movie_info($selected_person, $selected_movie, $selected_position, $role_input) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO person_in_movie (person_id, movie_id, position_id, role) values(?,?,?,?)");
		echo $conn->error;
		$stmt->bind_param("iiis", $selected_person, $selected_movie, $selected_position, $role_input);
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
	
	function store_picture() {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO person (picture_file_name, person_id) values(?,?)");
		$stmt->bind_param("si", $file_name, $person_id);
		if ($stmt->execute()) {
			$notice = "Pilt salvestatud."
		}
		else {
			$notice = "Salvestamisel tekkis viga."
		}
		
		echo $conn->error;
		
		$stmt->close();
		$conn->close();
		return $notice;
	}
	
?>