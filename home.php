<?php 
	//alustame sessiooni
	session_start();
	
	if(!isset($_SESSION["user_id"])) {
		header("Location: page.php");
	}
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: page.php");
	}
	require_once("page_header.php");
?>
		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<a href="user_profile.php">Kasutajaprofiil</a><br>
		<a href="add_films.php">Lisa filme</a><br>
		<a href="list_films.php">Uuri filme</a>
		<hr>
		<ul>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
	</body>
</html>