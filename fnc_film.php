<?php	
	$database = "if21_kevin_ros";
	
	function read_all_films() {
		//avan andmebaasi ühenduse - server, kasutaja, parool, andmebaas
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT * FROM film");
		echo $conn->error;
		//seome tulemused muutujatega
		$stmt->bind_result($title_from_db, $year_from_db, $duration_from_db, $genre_from_db, $studio_from_db, $director_from_db);
		//käsk täita
		$stmt->execute();
		$films_html = null;
		//while(tingimus) {
			//mida teha ...
		//}
		while($stmt->fetch()) {
			$films_html .= "<h3>" .$title_from_db ."</h3> \n";
			$films_html .= "</ul> \n";
			$films_html .= "<li>Valmimisaasta: " .$year_from_db ."</li> \n";
			$films_html .= "<li>Kestus: " .$time = minutes_into_hours($duration_from_db) ."</li> \n";
			$films_html .= "<li>Zanr: " .$genre_from_db ."</li> \n";
			$films_html .= "<li>Stuudio: " .$studio_from_db ."</li> \n";
			$films_html .= "<li>Režissöör: " .$director_from_db ."</li> \n";
			$films_html .= "</ul> \n";
		}
		//sulgeme SQL käsu
		$stmt->close();
		//sulgeme andmebaasi ühenduse
		$conn->close();
		return $films_html;
	}
	
	function store_film($title_input, $year_input, $duration_input, $genre_input, $studio_input, $director_input) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) values(?,?,?,?,?,?)");
		echo $conn->error;
		//seon SQL käsu päris andmetega, andmetüübid; i - integer, d - decimal, s - string
		$stmt->bind_param("siisss", $title_input, $year_input, $duration_input, $genre_input, $studio_input, $director_input);
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
	
	function join_movie_info() {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT person.first_name, person_in_movie.role from person JOIN person_in_movie on person.id = person_in_movie.person_id");
		echo $conn->error;
		
		$stmt->bind_result($first_name_from_db, $role_from_db);
		$stmt->execute();
		
		$relation_table_html = null;
		
		while($stmt->fetch()) {
			$relation_table_html .= "<h3>" .$first_name_from_db ."</h3> \n";
			$relation_table_html .= "<p>" .$role_from_db ."\n";
		}
		
		$stmt->close();
		$conn->close();
		return $relation_table_html;
	}
	
	function read_all_people() {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT first_name, last_name, birth_date FROM person");
		echo $conn->error;
		$stmt->bind_result($first_name_from_db, $last_name_from_db, $birth_date_from_db);
		$stmt->execute();
		$people_html = null;
		while($stmt->fetch()) {
			$people_html = "<p>" .$first_name_from_db ." " .$last_name_from_db ."/" .wrong_into_correct_time($birth_date_from_db) ."</p> \n";
		}
		$stmt->close();
		$conn->close();
		return $people_html;
	} 
?>