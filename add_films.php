<?php
	$author_name = "Kevin Rosenberg";
	require_once("../../config.php");
	//echo $server_host;
	require_once("fnc_film.php");
	
	$film_store_notice = null;
	
	//kas püütakse salvestada
	if(isset($_POST["film_submit"])) {
		
		//kontrollin, et andmeid ikka sisestati
		if((!empty($_POST["title_input"])) and (!empty($_POST["year_input"])) and (!empty($_POST["genre_input"])) and (!empty($_POST["studio_input"])) and (!empty($_POST["director_input"]))) {
			
			$film_store_notice = store_film($_POST["title_input"], $_POST["year_input"], $_POST["duration_input"], $_POST["genre_input"], $_POST["studio_input"], $_POST["director_input"]);
		}
		else {
			$film_store_notice = "Osa andmeid on puudu!";
		}
	}
?>
<!DOCTYPE html>
<html lang="et">
	<head>
		<title><?php echo $author_name; ?>, veebiprogrammeerimine</title>
		<style>
			div {
				background-color: yellow;
				width: 250px;
				outline: 3px dotted;
			}
			h1 {
				text-align: center;
			}
		</style>
		<meta charset="utf-8">
	</head>
	<body>
		<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
		<div>
			<p>See leht on valminud õppetöö raames ja ei sisalda mingisugust tõsiseltvõetavat sisu!</p>
		</div>
		<p>Õppetöö toimus <a href="https://www.tlu.ee/dt">Tallinna Ülikooli Digitehnoloogiate Instituudis</a>.</p>
		<hr>
		<h2>Eesti filmide lisamine andmebaasi</h2>
		<form method ="POST">
			<label for="title_input">Filmi pealkiri</label>
			<input type="text" name="title_input" id="title_input" placeholder="Filmi pealkiri">
			<br>
			<label for="year_input">Aasta</label>
			<input type="number" name="year_input" id="year_input" min="1912">
			<br>
			<label for="duration_input">Kestus(minutid)</label>
			<input type="number" name="duration_input" id="duration_input" min="1" value="60" max="600">
			<br>
			<label for="genre_input">Zanr</label>
			<input type="text" name="genre_input" id="genre_input" placeholder="Zanr">
			<br>
			<label for="studio_input">Tootja</label>
			<input type="text" name="studio_input" id="studio_input" placeholder="Tootja">
			<br>
			<label for="director_input">Filmi režissöör</label>
			<input type="text" name="director_input" id="director_input" placeholder="Režissöör">
			<br>
			<input type="submit" name="film_submit" value="Salvesta">
		</form>
		<span><?php echo $film_store_notice; ?></span>
	</body>
</html>