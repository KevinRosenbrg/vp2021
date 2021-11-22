<?php
	//alustame sessiooni
	require_once("classes/SessionManager.classes.php");
	SessionManager::sessionStart("vp", 0, "/~kevros/vp2021/", "greeny.cs.tlu.ee");
	
	require_once("../../config.php");
	
	$database = "if21_kevin_ros";
	
	$id = $_GET["photo"];
    $rating = $_GET["rating"];
	
	if ($id != null and $rating != null) {
		$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("INSERT INTO vp_photoratings (photoid, userid, rating) VALUES(?, ?, ?)");
		echo $conn->error;
		$stmt->bind_param("iii", $id, $_SESSION["user_id"], $rating);
		$stmt->execute();
		$stmt->close();
		
		//loeme keskmise hinde
		$stmt = $conn->prepare("SELECT AVG(rating) as avgValue FROM vp_photoratings WHERE photoid = ?");
		echo $conn->error;
		$stmt->bind_param("i", $id);
		$stmt->bind_result($score);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		$conn->close();
		echo round($score, 2);
	} elseif ($id == null or $id == null and $rating == null) {
		echo "Hinne teadmata!";
	} elseif ($rating = null) {
		// tagasta vastava id-ga foto keskmine hinne
		$conn = new mysqli($server_host, $server_user_name, $server_password, $database);
		$conn->set_charset("utf8");
		$stmt = $conn->prepare("SELECT AVG(rating) as avgValue FROM vp_photoratings WHERE photoid = ?");
		echo $conn->error;
		$stmt->bind_param("i", $id);
		$stmt->bind_result($score);
		$stmt->execute();
		$stmt->fetch();
		$stmt->close();
		$conn->close();
		echo round($score, 2);
	}
