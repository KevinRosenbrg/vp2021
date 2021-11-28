<?php
	//alustame sessiooni
	require_once("classes/SessionManager.classes.php");
	SessionManager::sessionStart("vp", 0, "/~kevros/vp2021/", "greeny.cs.tlu.ee");
	
	//kas on sisselogitud
	if(!isset($_SESSION["user_id"])) {
		header("Location: page.php");
	}
	
	//väljalogimine
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: page.php");
	}
	