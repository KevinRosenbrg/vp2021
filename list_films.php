<?php
	//alustame sessiooni
	require_once("use_session.php");
	
	require_once("../../config.php");
	require_once("fnc_time_formater.php");
	require_once("fnc_film.php");
	
	$films_html = null;
	$films_html = read_all_films();
	
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
		<h2>Eesti filmid</h2>
		<?php
		echo $films_html;
		?>
	</body>
</html>