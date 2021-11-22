<?php
	//alustame sessiooni
	require_once("use_session.php");
	
	$author_name = "Kevin Rosenberg";
	require_once("../../config.php");
	//echo $server_host;
	require_once("fnc_film.php");
	require_once("fnc_user.php");
	
	$notice = null;
	$description = null;
	
	if(isset($_POST["profile_submit"])) {
		$description = $_POST["description_input"];
		$bg_color = $_POST["bg_color_input"];
		$text_color = $_POST["text_color_input"];
		$notice = store_profile($description, $bg_color, $text_color);
	}
	
	require_once("page_header.php");
?>

		<h1><?php echo $_SESSION["first_name"] ." " .$_SESSION["last_name"]; ?>, veebiprogrammeerimine</h1>
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<hr>
		<ul>
			<li><a href="home.php">Avaleht</a></li>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
		<hr>
		<h2>Profiili konfigureerimine</h2>
		<form method ="POST">
			<label for="description_input">Minu lühikirjeldus</label>
			<br>
			<textarea name="description_input" id="description_input" rows="10" cols="80" placeholder="Minu lühikirjeldus..."><?php echo $description; ?></textarea>
			<br>
			<label for="bg_color_input">Tasutavärv</label>
			<br>
			<input type="color" name="bg_color_input" id="bg_color_input" value="<?php echo $_SESSION["bg_color"]; ?>">
			<br>
			<label for="text_color_input">Tekstivärv</label>
			<br>
			<input type="color" name="text_color_input" id="text_color_input" value="<?php echo $_SESSION["text_color"]; ?>">
			<br>
			<input type="submit" name="profile_submit" value="Salvesta">
		</form>
		<span><?php echo $notice; ?></span>
		<hr>
		<ul>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
	</body>
</html>