<?php	
	$database = "if21_kevin_ros";
	
	function save_news($title, $news_text, $expiration_date, $photo) {
		$conn = new mysqli ($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO vp_news (userid, title, content, expire, photoid) values(?,?,?,?,?)");
		echo $conn->error;
		$stmt->bind_param("isssi", $_SESSION["user_id"], $title, $content, $expiration, $photo_id);
		$success = null;
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
	
	function store_news_photo($filename){
		$notice = null;
		$conn = new mysqli($GLOBALS["server_host"], $GLOBALS["server_user_name"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO vp_newsphotos (filename, userid) VALUES (?, ?)");
		echo $conn->error;
		$stmt->bind_param("si", $photo_filename, $_SESSION["user_id"]);
		if($stmt->execute()){
		  $notice = "Foto lisati andmebaasi!";
		} else {
		  $notice = "Foto lisamisel andmebaasi tekkis tõrge: " .$stmt->error;
		}
		
		$stmt->close();
		$conn->close();
		return $notice;
	}

?>