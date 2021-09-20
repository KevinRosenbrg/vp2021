<?php
	$author_name = "Kevin Rosenberg";
	require_once("../../config.php");
	//echo $server_host;
	require_once("fnc_film.php");
	$films_html = null;
	$films_html = read_all_films();
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
		<h2>Eesti filmid</h2>
		<?php
		echo $films_html;
		?>
	</body>
</html>