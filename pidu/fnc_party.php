<?php 
	require_once("../../../config.php");
	$database = "if21_kevin_ros";

	function save_registration($firstname, $lastname, $studentcode) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO vp_party (firstname, lastname, studentcode) values(?,?,?)");
		echo $conn->error;
		$stmt->bind_param("ssi", $firstname, $lastname, $studentcode);
		$notice = null;
		if($stmt->execute()) {
			$notice = "Salvestamine õnnestus";
		}
		else {
			$notice = "Salvestamisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $notice;
	}
	
	function read_all_people() {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT id, firstname, lastname, studentcode, payment, cancelled FROM vp_party");
		echo $conn->error;
		$stmt->bind_result($id_from_db, $firstname_from_db, $lastname_from_db, $studentcode_from_db, $payment_from_db, $cancelled_from_db);
		$stmt->execute();
		$people_html = null;
		while($stmt->fetch()) {
			$people_html .= "<p>Eesnimi: " .$firstname_from_db ."</p> \n";
			$people_html .= "<p>Perenimi: " .$lastname_from_db ."</p> \n";
			$people_html .= "<p>Õpilaskood: " .$studentcode_from_db ."</p> \n";
			$people_html .= '<form method="POST">';
			$people_html .= '<label for="payment_input">Makstud: </label>';
			$people_html .= '<input type="text" name="payment_input' .$id_from_db .'" value="' .$payment_from_db .'">';
			$people_html .= "</form> \n";
			$people_html .= "<p>Tühistatud: " .$cancelled_from_db ."</p> \n";
			$people_html .= "<hr>";
		}
		$stmt->close();
		$conn->close();
		return $people_html;
	}
	
	function count_people() {
		$person_count = 0;
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT COUNT(id) FROM vp_party WHERE cancelled IS NULL");
		echo $conn->error;
		$stmt->bind_result($count);
		$stmt->execute();
		if($stmt->fetch()) {
			$person_count = $count;
		}
		$stmt->close();
		$conn->close();
		return $person_count;
	}
	
	function count_payments() {
		$person_count = 0;
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT COUNT(id) FROM vp_party WHERE payment IS NOT NULL");
		echo $conn->error;
		$stmt->bind_result($count);
		$stmt->execute();
		if($stmt->fetch()) {
			$person_count = $count;
		}
		$stmt->close();
		$conn->close();
		return $person_count;
	}
	
	function check_code($studentcode) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT studentcode FROM vp_party WHERE studentcode = ?");
		echo $conn->error;
		$stmt->bind_param("i", $studentcode);
		$stmt->execute();
		$login_notice = null;
		if($stmt->fetch()) {
			$login_notice = "1";
		}
		else {
			$login_notice = "Sisselogimisel tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $login_notice;
	}
	
	//function save_payment() {
		//
	//}