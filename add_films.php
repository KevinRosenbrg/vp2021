<?php
	//alustame sessiooni
	require_once("use_session.php");
	
	$author_name = "Kevin Rosenberg";
	require_once("../../config.php");
	require_once("fnc_film.php");
	
	$film_store_notice = null;
	
	$where_title = null;
	$where_year = null;
	$where_genre = null;
	$where_studio = null;
	$where_director = null;
	
	$inserted_title = null;
	$inserted_year = null;
	$inserted_genre = null;
	$inserted_studio = null;
	$inserted_director = null;
	
	//kas püütakse salvestada
	if(isset($_POST["film_submit"])) {
		
		//kontrollin, et andmeid ikka sisestati
		if((!empty($_POST["title_input"])) and (!empty($_POST["year_input"])) and (!empty($_POST["genre_input"])) and (!empty($_POST["studio_input"])) and (!empty($_POST["director_input"]))) {
			
			$film_store_notice = store_film($_POST["title_input"], $_POST["year_input"], $_POST["duration_input"], $_POST["genre_input"], $_POST["studio_input"], $_POST["director_input"]);
		}
		else {
			$film_store_notice = "Osa andmeid on puudu!";
		}
		if (empty($_POST["title_input"])) {
			$where_title = "Pealkiri on puudu!";
		}
		else {
			$inserted_title = $_POST["title_input"];
		}
		if (empty($_POST["year_input"])) {
			$where_year = "Aasta on puudu!";
		}
		else {
			$inserted_year = $_POST["year_input"];
		}
		if (empty($_POST["genre_input"])) {
			$where_genre = "Žanr on puudu!";
		}
		else {
			$inserted_genre = $_POST["genre_input"];
		}
		if (empty($_POST["studio_input"])) {
			$where_studio = "Tootja on puudu!";
		}
		else {
			$inserted_studio = $_POST["studio_input"];
		}
		if (empty($_POST["director_input"])) {
			$where_director = "Režissöör on puudu!";
		}
		else {
			$inserted_director = $_POST["director_input"];
		}
	}
	
	require_once("page_header.php");
?>

		<h1><?php echo $author_name; ?>, veebiprogrammeerimine</h1>
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
		<h2>Eesti filmide lisamine andmebaasi</h2>
		<form method ="POST">
			<label for="title_input">Filmi pealkiri</label>
			<input type="text" name="title_input" id="title_input" placeholder="Filmi pealkiri" value="<?php echo $inserted_title; ?>">
			<?php echo $where_title; ?>
			<br>
			<label for="year_input">Aasta</label>
			<input type="number" name="year_input" id="year_input" min="1912" value="<?php echo $inserted_year; ?>">
			<?php echo $where_year; ?>
			<br>
			<label for="duration_input">Kestus(minutid)</label>
			<input type="number" name="duration_input" id="duration_input" min="1" value="60" max="600">
			<br>
			<label for="genre_input">Zanr</label>
			<input type="text" name="genre_input" id="genre_input" placeholder="Zanr" value="<?php echo $inserted_genre; ?>">
			<?php echo $where_genre; ?>
			<br>
			<label for="studio_input">Tootja</label>
			<input type="text" name="studio_input" id="studio_input" placeholder="Tootja" value="<?php echo $inserted_studio; ?>">
			<?php echo $where_studio; ?>
			<br>
			<label for="director_input">Filmi režissöör</label>
			<input type="text" name="director_input" id="director_input" placeholder="Režissöör" value="<?php echo $inserted_director; ?>">
			<?php echo $where_director; ?>
			<br>
			<input type="submit" name="film_submit" value="Salvesta">
		</form>
		<span><?php echo $film_store_notice; ?></span>
		<hr>
		<ul>
			<li><a href="?logout=1">Logi välja</a></li>
		</ul>
	</body>
</html>