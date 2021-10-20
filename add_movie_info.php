<?php
	session_start();
	
	if(!isset($_SESSION["user_id"])) {
		header("Location: page.php");
	}
	
	if(isset($_GET["logout"])) {
		session_destroy();
		header("Location: page.php");
	}
	
	require_once("../../config.php");
	require_once("fnc_movie_info.php");
	
	$movie_save_notice = null;
	$genre_save_notice = null;
	$position_save_notice = null;
	
	if(isset($_POST["movie_submit"])) {
		if ((!empty($_POST["movie_input"])) and (!empty($_POST["production_year_input"])) and (!empty($_POST["duration_input"])) and (!empty($_POST["description_input"]))) {
			$movie_save_notice = save_movie($_POST["movie_input"], $_POST["production_year_input"], $_POST["duration_input"], $_POST["description_input"]);
		}
		else {
			$movie_save_notice = "Midagi läks viltu.";
		}
	}
	
	if(isset($_POST["genre_submit"])) {
		if ((!empty($_POST["genre_input"])) and (!empty($_POST["genre_description_input"]))) {
			$genre_save_notice = save_genre($_POST["genre_input"], $_POST["genre_description_input"]);
		}
		else {
			$genre_save_notice = "Midagi läks viltu.";
		}
	}
	
	if(isset($_POST["position_submit"])) {
		if ((!empty($_POST["position_input"])) and (!empty($_POST["position_description_input"]))) {
			$position_save_notice = save_position($_POST["position_input"], $_POST["position_description_input"]);
		}
		else {
			$position_save_notice = "Midagi läks viltu.";
		}
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
		<h2>Info lisamine andmebaasi</h2>
		<hr>
		<h3>Film</h3>
		<form method ="POST">
			<label for="movie_input">Filmi pealkiri:</label>
			<input type="text" name="movie_input" id="movie_input">
			<label for="production_year_input">Filmi valmimisaasta:</label>
			<input type="number" name="production_year_input" id="production_year_input" min="1912">
			<label for="duration_input">Filmi kestus:</label>
			<input type="number" name="duration_input" id="duration_input" min="1" value="60" max="600">
			<br>
			<label for="description_input">Filmi lühikirjeldus:</label>
			<br>
			<textarea name="description_input" id="description_input" rows="10" cols="80" placeholder="Filmi lühikirjeldus..."></textarea>
			<br>
			<input type="submit" name="movie_submit" value="Salvesta">
		</form>
		<span><?php echo $movie_save_notice; ?></span>
		<hr>
		<h3>Zanr</h3>
		<form method ="POST">
			<label for="genre_input">Zanri nimetus:</label>
			<input type="text" name="genre_input" id="genre_input">
			<br>
			<label for="genre_description_input">Zanri lühikirjeldus:</label>
			<br>
			<textarea name="genre_description_input" id="genre_description_input" rows="8" cols="80" placeholder="Zanri lühikirjeldus..."></textarea>
			<br>
			<input type="submit" name="genre_submit" value="Salvesta">
		</form>
		<span><?php echo $genre_save_notice; ?></span>
		<h3>Amet</h3>
		<form method ="POST">
			<label for="position_input">Ameti nimetus:</label>
			<input type="text" name="position_input" id="position_input">
			<br>
			<label for="position_description_input">Ameti lühikirjeldus:</label>
			<br>
			<textarea name="position_description_input" id="position_description_input" rows="8" cols="80" placeholder="Ameti lühikirjeldus..."></textarea>
			<br>
			<input type="submit" name="position_submit" value="Salvesta">
		</form>
		<span><?php echo $position_save_notice; ?></span>
		<ul>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
	</body>
</html>